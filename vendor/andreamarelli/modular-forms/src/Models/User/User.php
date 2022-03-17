<?php

namespace AndreaMarelli\ModularForms\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 *
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


}
