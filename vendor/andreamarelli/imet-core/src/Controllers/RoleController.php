<?php

namespace AndreaMarelli\ImetCore\Controllers;

use AndreaMarelli\ImetCore\Models\Person;
use AndreaMarelli\ImetCore\Models\Role;
use AndreaMarelli\ModularForms\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Manage "index" route
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Person::class);

        $wdpa = $request->input('wdpa', null);
        [$supervisors, $readonly, $encoders] = Role::listRoles($wdpa);

        return view(
            'admin.role.list_imet',
            [
                'controller' => static::class,
                'supervisors' => $supervisors,
                'readonly' => $readonly,
                'encoders' => $encoders
            ]
        );
    }

    /**
     * Grant a role
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Illuminate\Auth\Access\AuthorizationException|\Throwable
     */
    public function grant(Request $request)
    {
        $this->authorize('update', Person::class);

        $user_id = $request->input('user_id');
        $role    = $request->input('role');
        $wdpa    = $request->input('wdpa');
        if(Role::isValidRole($role)){
            $result = Role::grantRole($user_id, $role, $wdpa);
            if(is_numeric($result)){
                return static::sendAPIResponse(['id' => $result]);
            } else {
                static::sendAPIError(500, 'error in executing request');
            }
        } else {
            static::sendAPIError(400,'provided role not valid');
        }
        return;
    }

    /**
     * Revoke a role
     *
     * @param \Illuminate\Http\Request $request
     * @return string[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function revoke(Request $request): array
    {
        $this->authorize('update', Person::class);

        $user_id = $request->input('user_id');
        $role    = $request->input('role');
        $wdpa    = $request->input('wdpa');
        return Role::revokeRole($user_id, $role, $wdpa);
    }
}
