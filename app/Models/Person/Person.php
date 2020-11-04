<?php

namespace App\Models\Person;

use App\Models\Components\Form;
use App\Models\Person\Modules\Responsibilities;
use App\User;


class Person extends Form
{
    public static $modules = [
        'general_info' => [
            Modules\GeneralInfo::class,
            Modules\Email::class,
            Modules\Contacts::class
        ],
        'auth' => [
            Modules\Email::class,
            Modules\Password::class,
        ],
        'role_ofac' => [
            Modules\RoleOFAC::class,
        ],
        'rights' => [
            Modules\RightsAdministrator::class,
            Modules\RightsSpecific::class,
            Modules\RightsIndicators::class,
        ],
        'project_owner' => [
            Modules\ProjectOwner::class,
        ]
    ];

    protected $table = 'persons';
    protected $guarded = [];
    protected $appends = ['name'];

    public $sortable = ['last_name'];

    public const ROLES_OFAC = [
        'regional' => [
            "Cellule régionale",
            "Membre du consortium",
            "Partenaire OFAC",
            "Partenaire PFBC",
            "Communauté scientifique"
        ],
        'national' => [
            "Correspondant principal national OFAC",
            "Personne relais national OFAC",
            "Autre acteur national OFAC"
        ]
    ];

    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'country' => 'required',
        'email' => 'email|unique:persons',
    ];

    /**
     * Append "name" to attributes list for better access
     *
     * @return mixed
     */
    public function getNameAttribute()
    {
        return $this->attributes['last_name'].' '.$this->attributes['first_name'];
    }

    /**
     * Accessor to name/id pair array
     *
     * @return array
     */
    public function getNamePairAttribute()
    {
        return ['id' => $this->getKey(), 'name' =>$this->Name];
    }

    /**
     * Relation to User
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Relation to Responsibilities
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responsibilities()
    {
        return $this->hasMany(Responsibilities::class);
    }

    /**
     * Get people by OFAC role
     *
     * @param $role
     * @param string $country
     * @return mixed
     */
    public static function getByRoleOFAC($role, $country='')
    {
        $staff = Person::where('role_ofac', 'ilike', '%'.$role.'%');
        if($country!=''){
            $staff = $staff->where('country', '=', $country);
        }
        return $staff->orderBy('last_name')->get();
    }

    public static function getInitials() {
        return parent::getInitialLetters('last_name');
    }

    /**
     * Get an array with id and name
     * @param $id
     * @return array
     */
    public static function getIdNamePair($id)
    {
        if($id!==null){
            return ['id'=>$id, 'name'=>static::find($id)->Name];
        }
        return ['id'=>$id, 'name'=>''];
    }

    /**
     * update() override
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        // Force update of "email" also in User model
        if(array_key_exists('email', $attributes)){
            User::find($this->getKey())->update(['email' => $attributes['email']]);
        }

        return parent::update($attributes, $options);
    }

    /**
     * Search by key
     * @param $search_key
     * @return mixed
     */
    public static function searchByKey($search_key)
    {
        return static::where('first_name', '~~*', '%' . $search_key . '%')
            ->orWhere('last_name', '~~*', '%' . $search_key . '%')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }


}