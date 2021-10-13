<?php

namespace AndreaMarelli\ImetCore\Policies;

use AndreaMarelli\ImetCore\Models\Role;
use AndreaMarelli\ModularForms\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class ImetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can: INDEX
     *
     * @param \AndreaMarelli\ModularForms\Models\User\User $user
     * @param $model
     * @return bool
     */
    public function viewAny(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isAuthorized($user);
    }

    /**
     * Determine whether the user can: VIEW
     *
     * @param \AndreaMarelli\ModularForms\Models\User\User $user
     * @param $model
     * @return bool
     */
    public function view(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isAuthorized($user);
    }

    /**
     * Determine whether the user can: CREATE
     *
     * @param \AndreaMarelli\ModularForms\Models\User\User $user
     * @param $model
     * @return bool
     */
    public function create(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isEncoder($user);
    }

    /**
     * Determine whether the user can: EDIT
     *
     * @param \AndreaMarelli\ModularForms\Models\User\User $user
     * @param $model
     * @return bool
     */
    public function update(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isEncoder($user);
    }

    /**
     * Determine whether the user can: DELETE
     *
     * @param \AndreaMarelli\ModularForms\Models\User\User $user
     * @param $model
     * @return bool
     */
    public function destroy(User $user, $model = null): bool
    {
        return User::isAdmin($user)
            || Role::isEncoder($user);
    }


}
