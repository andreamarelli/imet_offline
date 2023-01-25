<?php

namespace AndreaMarelli\ImetCore\Policies;

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use \ImetUser as User;


class ImetPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks
     *
     * @param \App\Models\User|\ImetUser $user
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
     * Determine whether the user can INDEX
     * Every role can access the index route but the list will be filtered accordingly
     *
     * @param \App\Models\User|\ImetUser $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can VIEW
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function view($user, $form = null): bool
    {
        if (is_null($form)) {
            return Role::hasAnyRole($user);
        } else {
            return Role::isWdpaAllowed($form->wdpa_id, $user);
        }
    }

    /**
     * Determine whether the user can EDIT
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function edit($user, $form = null): bool
    {
        if (is_null($form)) {
            return Role::isRole(Role::ROLE_ENCODER);
        } else {
            return Role::isRole(Role::ROLE_ENCODER)
                && Role::isWdpaAllowed($form->wdpa_id, $user);
        }
    }

    /**
     * Determine whether the user can UPDATE
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function update($user, $form = null): bool
    {
        // if user can EDIT can also UPDATE
        return $this->edit($user, $form);
    }

    /**
     * Determine whether the user can CREATE
     *
     * @param \App\Models\User|\ImetUser $user
     * @return bool
     */
    public function create($user): bool
    {
        // if user can EDIT can also CREATE
        return $this->edit($user);
    }

    /**
     * Determine whether the user can DESTROY
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function destroy($user, $form = null): bool
    {
        // if user can EDIT can also DESTROY
        return $this->edit($user, $form);
    }

    /**
     * Determine whether the user can view the EXPORT button
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function export_button($user, $form = null): bool
    {
        $user = $user ?? Auth::user();
        return Role::isRole(Role::ROLE_ENCODER, $user) ||
            Role::isRole(Role::ROLE_NATIONAL_AUTHORITY, $user) ||
            Role::isRole(Role::ROLE_REGIONAL_OBSERVATORY, $user);
    }

    /**
     * Determine whether the user can EXPORT
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function export($user, $form = null): bool
    {
        $user = $user ?? Auth::user();
        return Role::isWdpaAllowed($form->wdpa_id, $user) && (
                Role::isRole(Role::ROLE_ENCODER, $user) ||
                Role::isRole(Role::ROLE_NATIONAL_AUTHORITY, $user) ||
                Role::isRole(Role::ROLE_REGIONAL_OBSERVATORY, $user)
            );
    }

    /**
     * Determine whether the user can export ALL the assessments
     *
     * @param \App\Models\User|\ImetUser $user
     * @param $form
     * @return bool
     */
    public function exportAll($user, $form = null): bool
    {
        // only ADMIN can export in batch
        return false;
    }

    /**
     * @param $user
     * @param $form
     * @return bool
     */
    public function api_assessment($user, $form = null): bool
    {
        return $this->role_national_or_observatory() &&
            Role::isWdpaAllowed($form->wdpa_id, $user);
    }

    /**
     * @param $user
     * @param $form
     * @return bool
     */
    public function api_scaling_up($user, $form = null): bool
    {
        return $this->role_national_or_observatory() && Role::isWdpaAllowed($form->wdpa_id, $user);
    }

    /**
     * @return bool
     */
    public function role_national_or_observatory(): bool
    {
        return (Role::isRole(Role::ROLE_NATIONAL_AUTHORITY) || Role::isRole(Role::ROLE_REGIONAL_OBSERVATORY));
    }

    /**
     * Determine whether the user can api views
     * @param \App\Models\User|\ImetUser $user
     * @param null $form
     * @param null $model
     * @return bool
     */
    public function api_details($user, $form = null, $model = null): bool
    {
        return Role::hasRequiredAccessLevel($model) &&
            Role::isWdpaAllowed($form->wdpa_id, $user);
    }

}
