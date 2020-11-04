<?php

namespace App\Models\Role;


use App\Http\Controllers\Components\API;

class RoleRegional extends _Role
{
    use API;

    protected $table = 'user_roles_regional';

    protected $guarded = null;
    protected $fillable = ['user_id', 'role'];

    public const EXECUTIVE_SECRETARY = 'executive_secretary';
    public const EXPERT = 'expert';
    public const ENCODER = 'encoder';

    public static function isAuthorized($user)
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where(function ($query){
                $query
                    ->where('role', static::EXECUTIVE_SECRETARY)
                    ->orWhere('role', static::EXPERT)
                    ->orWhere('role', static::ENCODER);
            })
            ->get()
            ->isNotEmpty();
    }

    public static function listRoles()
    {
        return [
            static::getByRole(static::EXECUTIVE_SECRETARY)->first(),
            static::getByRole(static::EXPERT)->first(),
            static::getByRole(static::ENCODER)->toArray() ?: [null]
        ];
    }

    /**
     * Grant a role to user
     *
     * @param $user_id
     * @param $role
     * @return \Illuminate\Http\JsonResponse|void
     */
    public static function grantRole($user_id, $role)
    {
        try{
            if (in_array($role, [
                static::EXECUTIVE_SECRETARY, static::EXPERT, static::ENCODER
            ])){

                \DB::beginTransaction();
                if($role === static::EXECUTIVE_SECRETARY || $role === static::EXPERT){
                    static::where('role', $role) ->delete();    // remove current
                }
                $id = static::create(['user_id' => $user_id, 'role' => $role])->getKey();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public static function revokeRole($user_id, $role)
    {
        static::where('user_id', $user_id)
            ->where('role', $role)
            ->delete();
        return self::sendAPIResponse([]);
    }


}