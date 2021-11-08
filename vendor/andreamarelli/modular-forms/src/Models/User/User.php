<?php

namespace AndreaMarelli\ModularForms\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


/**
 * Class User
 *
 * @property \AndreaMarelli\ModularForms\Models\User\Person $person
 * @mixin \Illuminate\Database\Eloquent\Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @package AndreaMarelli\ModularForms\Models\User
 */
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
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Relation to UserRight
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rights(): HasMany
    {
        return $this->hasMany(UserRight::class);
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
     *
     * @param $user
     * @return bool
     */
    public static function isAdmin($user = null): bool
    {
        $user = $user ?? Auth::user();
        if($user!==null){
            foreach ($user->rights as $right){
                if(strtolower($right->role)===UserRight::ROLE_ADMIN){
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * Check if user has permission to access to the given scope
     *
     * @param $scope
     * @return bool
     */
    public function hasAccess($scope): bool
    {
        if(User::isAdmin($this)){
            return true;
        }

        $scope = is_array($scope) ? $scope : array($scope);
        foreach ($this->rights as $right){
            if(in_array($right->scope, $scope) && $right->access=1){
                return true;
            }
        }
        return false;
    }


}
