<?php

namespace AndreaMarelli\ImetCore\Policies;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Auth\Access\HandlesAuthorization;


class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks
     *
     * @param \App\Models\User\User|\ImetUser $user
     * @param string $ability
     * @return void|bool
     */
    public function before($user, string $ability)
    {
        // authorize any route to ADMINISTRATOR
        if (Role::isAdmin($user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can manage Roles
     *
     * @param \App\Models\User\User|\ImetUser $user
     * @return bool
     */
    public function manage($user): bool
    {
        // TODO: ROLE_REGIONAL_OBSERVATORY ?
        return false;
    }

}
