<?php

namespace AndreaMarelli\ImetCore\Models\User;

use AndreaMarelli\ImetCore\Models\Country;
use \AndreaMarelli\ModularForms\Models\User\User as BaseUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * Class User
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $imet_role
 * @mixin \Illuminate\Database\Eloquent\Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends BaseUser
{
    /**
     * Override: set the fillable attributes
     * @var string[]
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'first_name',
        'last_name',
        'organisation',
        'function',
        'country',
        'imet_role'
    ];

    protected $appends = ['name'];

    /**
     * Relation to Role
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imet_roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Relation to Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'iso3', 'country');
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Override: Retrieve the name of the user
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name ;
    }

    /**
     * Retrieve user's personal info (requires to be overridden)
     * @return array
     */
    public function getInfo(): array
    {
        return $this->only([
            'first_name',
            'last_name',
            'organisation',
            'country'
        ]);
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
            ->with('country')
            ->get();
    }

}
