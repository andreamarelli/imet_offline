<?php

namespace AndreaMarelli\ModularForms\Models\User;

use AndreaMarelli\ModularForms\Models\Form;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Person
 *
 *
 * @property string $name
 * @property string $Name
 * @mixin \Illuminate\Database\Eloquent\Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @package AndreaMarelli\ModularForms\Models\User
 */
class Person extends Form
{
    public static $modules = [];

    protected $table = 'persons';
    protected $guarded = [];
    protected $appends = ['name'];

    public $sortable = ['last_name'];

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
    public function getNameAttribute(): string
    {
        return $this->attributes['last_name'].' '.$this->attributes['first_name'];
    }

    /**
     * Accessor to name/id pair array
     *
     * @return array
     */
    public function getNamePairAttribute(): array
    {
        return ['id' => $this->getKey(), 'name' =>$this->Name];
    }

    /**
     * Relation to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get all last_name initials
     *
     * @return mixed
     */
    public static function getInitials() {
        return parent::getInitialLetters('last_name');
    }

    /**
     * Get an array with id and name
     *
     * @param $id
     * @return array
     */
    public static function getIdNamePair($id): array
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
    public function update(array $attributes = [], array $options = []): bool
    {
        // Force update of "email" also in User model
        if(array_key_exists('email', $attributes)){
            User::find($this->getKey())->update(['email' => $attributes['email']]);
        }

        return parent::update($attributes, $options);
    }

    /**
     * Search by key
     *
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
