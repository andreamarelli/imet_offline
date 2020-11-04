<?php

namespace App\Models\Role;


use App\Http\Controllers\Components\API;

class RoleImet extends _Role
{
    use API;

    protected $table = 'user_roles_imet';

    protected $guarded = null;
    protected $fillable = ['user_id', 'role', 'wdpa'];

    public const SUPERVISOR = 'supervisor';
    public const READONLY = 'readonly';
    public const ENCODER = 'encoder';

    public static function isAuthorized($user, $form = null)
    {
        return static::isEncoder($user)
            || static::isSupervisor($user)
            || static::isReadOnly($user);
    }

    private static function isSupervisor($user, $form = null)
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where('role', static::SUPERVISOR)
            ->get()
            ->isNotEmpty();
    }

    private static function isReadOnly($user)
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where('role', static::READONLY)
            ->get()
            ->isNotEmpty();
    }

    public static function isEncoder($user)
    {
        $query = static::select()
            ->where('user_id', $user->getKey())
            ->where('role', static::ENCODER);
        return $query
            ->get()
            ->isNotEmpty();
    }

    private static function getByWdpaAndRole($wdpa, $role){
        $list = static::select()
            ->where('wdpa', $wdpa)
            ->where('role', $role)
            ->with('person')
            ->get();
        return $list->map(function ($item) {
            return [
                'user_id' => $item['user_id'],
                'scope' => $item['scope'],
                'wdpa' => $item['wdpa'],
                'role' => $item['role'],
                'name' => $item['person']->name,
                'organisation' => $item['person']->organisation,
            ];
        });
    }

    public static function listRoles($wdpa = null)
    {
        $supervisors = static::getByRole(static::SUPERVISOR)->toArray();
        $readonly = static::getByRole(static::READONLY)->toArray();
        $encoders = null;

        if($wdpa!==null) {
            $encoders = static::getByWdpaAndRole($wdpa, static::ENCODER)->toArray();
        }

        return [
            $supervisors ?: [null],
            $readonly ?: [null],
            $encoders ?: [null],
        ];
    }

    /**
     * Grant a role to user
     *
     * @param $user_id
     * @param $role
     * @param null $wdpa
     * @return \Illuminate\Http\JsonResponse|void
     */
    public static function grantRole($user_id, $role, $wdpa = null)
    {
        try{
            if($role === static::SUPERVISOR || $role === static::READONLY || $role === static::ENCODER){

                \DB::beginTransaction();
                if($role === static::SUPERVISOR || $role === static::READONLY){
                    $id = static::create(['user_id' => $user_id, 'role' => $role])->getKey();
                }
                elseif ($role === static::ENCODER){
                    $id = static::create(['user_id' => $user_id, 'role' => $role, 'wdpa' => $wdpa])->getKey();
                }
                \DB::commit();

                return API::sendAPIResponse(['id' => $id]);

            } else {
                API::sendAPIError(400,'provided role not valid');
            }
        } catch (\Exception $e){
            API::sendAPIError(500, 'error in executing request');
        }
    }

    /**
     * Revoke role to user
     *
     * @param $user_id
     * @param $role
     * @param null $wdpa
     * @return \Illuminate\Http\JsonResponse
     */
    public static function revokeRole($user_id, $role, $wdpa = null)
    {
        static::where('user_id', $user_id)
            ->where('role', $role)
            ->where('wdpa', $wdpa)
            ->delete();
        return self::sendAPIResponse([]);
    }

}