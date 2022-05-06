<?php

namespace AndreaMarelli\ModularForms\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 *
 * @property string $name
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

    protected $fillable = [
        'email',
        'password',
        'id'
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
     * Retrieve the name of the user
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * Retrieve user's personal info (requires to be overridden)
     * @return array
     */
    public function getInfo(): array
    {
        return [
            "first_name" => null,
            "last_name" => null,
            "organisation" => null,
            "function" => null,
        ];
    }


}
