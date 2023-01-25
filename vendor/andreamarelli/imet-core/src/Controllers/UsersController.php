<?php

namespace AndreaMarelli\ImetCore\Controllers;

use AndreaMarelli\ModularForms\Models\Traits\Payload;
use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \ImetUser as User;


class UsersController extends __Controller
{
    protected static $form_class = Role::class;
    protected static $form_view_prefix = 'imet-core::users/';


    /**
     * Manage "list" route
     *
     * @param \Illuminate\Http\Request $request
     * @param $role_type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, $role_type = null)
    {
        $this->authorize('manage', static::$form_class);

        $role_type = $role_type ?? Role::ROLE_ADMINISTRATOR;
        $users = User::where('imet_role', $role_type)
            ->with(['imet_roles.country_obj', 'imet_roles.wdpa_obj'])
            ->get()
            ->map(function ($item){
                $role_isos = [];
                $role_wdpas = [];
                foreach($item['imet_roles'] as $r){
                    if($r['country']!==null){
                        $role_isos[] = $r['country'];
                    }
                    if($r['wdpa']!==null){
                        $role_wdpas[] = $r['wdpa'];
                    }
                }
                unset($item['imet_roles']);
                return [
                    'user' => $item,
                    'role_isos' => json_encode($role_isos),
                    'role_wdpas' => implode(',', $role_wdpas),
                    'changed' => false
                ];
            });

        return view(static::$form_view_prefix . 'roles', [
            'controller' => static::class,
            'role' => $role_type,
            'users_and_roles' => $users
        ]);
    }

    /**
     * Manage "search" route
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $list = $request->filled('search_key')
            ? User::searchByKey($request->input('search_key'))
            : collect();

        return response()->json([
                                    'records' => $list->toArray()
                                ]);
    }

    /**
     * Manage "update_roles" route
     *
     * @param \Illuminate\Http\Request $request
     * @return string[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update_roles(Request $request): array
    {
        $this->authorize('manage', static::$form_class);

        $records = Payload::decode($request->input('records'));
        $role_type = $request->input('role_type');

        DB::beginTransaction();

        if($role_type == Role::ROLE_ADMINISTRATOR){
            $defined_users = [];
            foreach ($records as $record){
                if($record['user']){
                    // Remove any eventual role and set user's imet_role
                    Role::where('user_id', $record['user']['id'])->delete();
                    User::find($record['user']['id'])->update(['imet_role' => $role_type]);
                    $defined_users[] = $record['user']['id'];
                }
            }
            // Set imet_role to null for any user with the given role which is not in the provided list
            if(!empty($defined_users)){
                User::where('imet_role', $role_type)
                    ->whereNotIn('id', $defined_users)
                    ->update(['imet_role' => null]);
            }
        } else {

            foreach ($records as $record){
                if($record['user'] !== null){

                    $user_id = $record['user']['id'];
                    $wdpas = explode(',', $record['role_wdpas']) ?? [];
                    $isos = json_decode($record['role_isos']) ?? [];

                    $wdpas = array_unique(array_filter($wdpas));
                    $isos = array_unique(array_filter($isos));

                    // Create/update provided roles
                    if(!empty($wdpas)){
                        foreach ($wdpas as $wdpa){
                            $attributes = [ 'user_id' => $user_id, 'wdpa' => $wdpa, 'country' => null ];
                            Role::updateOrCreate($attributes, $attributes);
                        }
                    }
                    if(!empty($isos)){
                        foreach ($isos as $iso){
                            $attributes = [ 'user_id' => $user_id, 'wdpa' => null, 'country' => $iso ];
                            Role::updateOrCreate($attributes, $attributes);
                        }
                    }

                    // Remove any extra role
                    Role::where('user_id', $user_id)
                        ->whereNull('country')
                        ->whereNotNull('wdpa')
                        ->whereNotIn('wdpa', $wdpas)
                        ->delete();

                    Role::where('user_id', $user_id)
                        ->whereNull('wdpa')
                        ->whereNotNull('country')
                        ->whereNotIn('country', $isos)
                        ->delete();

                }
            }
        }

        DB::commit();

        return [
            'status' => 'success'
        ];
    }

}
