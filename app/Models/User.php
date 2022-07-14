<?php

namespace App\Models;

use \AndreaMarelli\ModularForms\Models\User\User as baseUser;

/**
 * @property string first_name
 * @property string last_name
 * @property string organisation
 * @property string function
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
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * Retrieve user's personal info
     *
     * @return array
     */
    public function getInfo(): array
    {
        return [
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "organisation" => $this->organisation,
            "function" => $this->function
        ];
    }

}
