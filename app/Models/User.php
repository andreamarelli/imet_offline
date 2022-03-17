<?php

namespace App\Models;

use \AndreaMarelli\ModularForms\Models\User\User as baseUser;

/**
 * @property string first_name
 * @property string last_name
 */
class User extends baseUser
{
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'organisation',
        'function',
        'country'
    ];

    /**
     * Retrieve the name of the user
     * @return mixed
     */
    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
