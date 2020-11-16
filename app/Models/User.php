<?php

namespace App\Models;

use App\Http\Controllers;
use App\Library\Utils\Type\Chars;
use App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Routing\Route;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const CREATED_AT = 'last_update_date';
    public const UPDATED_AT = 'last_update_date';
    public const UPDATED_BY = 'last_update_by';

    public const password_rule = 'required|min:10|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d$@$!%*#?&_]+$/|confirmed';
    public const password_rule_msg =
        'Le format du mot de passe est invalide.<br /><br />
        <ul>
            <li>doit entrer au moins 10 caractères</li>
            <li>doit contenir au moins un caractère en minuscule</li>
            <li>doit contenir au moins un caractère en majuscule</li>
            <li>doit contenir au moins un chiffre</li>
            <li>peut contenir une caractère spécial (@$!%*#?&_)</li>
            <li>ne peut contenir d\'espaces</li>
        </ul>';

    protected $fillable = [
        'email',
        'password',
        'id',
        'person_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relation to Person
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Models\Person\Person::class);
    }

    /**
     * Relation to UserRight
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rights()
    {
        return $this->hasMany(Models\UserRight::class);
    }

    /**
     * Relation to UserRight
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles_national()
    {
        return $this->hasMany(Models\Role\RoleNational::class);
    }

    /**
     * Relation to UserRight
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles_regional()
    {
        return $this->hasMany(Models\Role\RoleRegional::class);
    }

    /**
     * Retrieve the name of the user
     * @return mixed
     */
    public function getName()
    {
        return $this->person->name;
    }

    /**
     * Check whether user is an administrator
     * @param $user
     * @return bool
     */
    public static function isAdmin($user = null)
    {
        $user = $user ?? \Auth::user();
        if($user!==null){
            foreach ($user->rights as $right){
                if(strtolower($right->role)===Models\UserRight::ROLE_ADMIN){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Check if user has permission to access to the given domain
     * @param $domains
     * @return bool
     */
    public function hasAccess($domains)
    {
        if(User::isAdmin($this)){
            return true;
        }

        $domains = is_array($domains) ? $domains : array($domains);
        $allowed = false;

        // Rights
        foreach ($this->rights as $right){
            if(in_array($right->scope, $domains) && $right->access=1){
                $allowed = true;
            }
        }

        return $allowed;
    }


    /**
     * Check if user has permission to access to the given route
     * @param Route $route
     * @return bool
     */
    public function hasAccessToRoute(Route $route)
    {
        if(static::isAdmin($this)){
            return true;
        }

        $user_id = (string) $this->getKey();

        if($route->getPrefix()=='/admin' || \Str::startsWith($route->getPrefix(), 'admin/')){

            $item = $route->parameter('item', null);
            $requested_route = $route->getController();

            // Project: Allow only owned by user (all for administrators)
            if($requested_route instanceof Controllers\Project\ProjectController){
                $item = ($item!=null and is_numeric($item)) ? Models\Project\Project::find($item) : $item;
                if($item!=null
                    && !$this->hasAccess('projects')
                    && !$item->isOwner($user_id)){
                    return false;
                }
                return true;
            }

            // Training: Allow only owned by user (all for administrators)
            if($requested_route instanceof Controllers\TrainingController){
                $item = ($item!=null and is_numeric($item)) ? Models\Training\Training::find($item) : $item;
                if($item!=null
                    && !$this->hasAccess('trainings')
                    && !$item->isOwner($user_id)){
                    return false;
                }
                return true;
            }

            // Expert: Allow only own profile (all for administrators)
            if($requested_route instanceof Controllers\ExpertController){
                $item = ($item!=null and is_numeric($item)) ? Models\Expert\Expert::find($item) : $item;
                if($item!=null
                    && !$this->hasAccess('experts')
                    && !$item->isOwner()){
                    return false;
                }
                return true;
            }

            // KnowledgeBase entities: Allow if has access permission
            if($requested_route instanceof Controllers\ProtectedAreaController){
                return ($this->hasAccess('protected_area'));
            }
            if($requested_route instanceof Controllers\ConcessionController){
                return ($this->hasAccess('concession'));
            }
            if($requested_route instanceof Controllers\TransformationPlantController){
                return ($this->hasAccess('transformation_plant'));
            }
            if($requested_route instanceof Controllers\InstitutionController){
                if($route->getActionMethod()==="store_entity"){
                    return true;
                }
                return $this->hasAccess('institution');
            }
            if($requested_route instanceof Controllers\NewsController){
                return $this->hasAccess('news');
            }
            if($requested_route instanceof Controllers\CatalogueController){
                return $this->hasAccess('catalogue');
            }

        }

        return false;
    }

}
