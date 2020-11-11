<?php

namespace App\Policies;

use App\Models\Role\RoleImet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class ImetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can: INDEX
     *
     * @param \App\Models\User $user
     * @param $model
     * @return bool
     */
    public function viewAny(User $user, $model = null)
    {
        return User::isAdmin($user)
            || RoleImet::isAuthorized($user);
    }

    /**
     * Determine whether the user can: VIEW
     *
     * @param \App\Models\User $user
     * @param $model
     * @return bool
     */
    public function view(User $user, $model = null)
    {
        return User::isAdmin($user)
            || RoleImet::isAuthorized($user);
    }

    /**
     * Determine whether the user can: CREATE
     *
     * @param \App\Models\User $user
     * @param $model
     * @return bool
     */
    public function create(User $user, $model = null)
    {
        return User::isAdmin($user)
            || RoleImet::isEncoder($user);
    }

    /**
     * Determine whether the user can: EDIT
     *
     * @param \App\Models\User $user
     * @param $model
     * @return bool
     */
    public function update(User $user, $model = null)
    {
        return User::isAdmin($user)
            || RoleImet::isEncoder($user);
    }

    /**
     * Determine whether the user can: DELETE
     *
     * @param \App\Models\User $user
     * @param $model
     * @return bool
     */
    public function destroy(User $user, $model = null)
    {
        return User::isAdmin($user)
            || RoleImet::isEncoder($user);
    }


}
