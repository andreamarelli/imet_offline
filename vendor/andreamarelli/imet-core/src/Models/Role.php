<?php

namespace AndreaMarelli\ImetCore\Models;

use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;


class Role extends BaseModel
{
    protected $table = 'user_roles_imet';

    protected $guarded = null;
    protected $fillable = ['user_id', 'role', 'wdpa'];

    public const SUPERVISOR = 'supervisor';
    public const READONLY = 'readonly';
    public const ENCODER = 'encoder';

    public const UPDATED_AT = 'last_update_date';
    public const UPDATED_BY = 'last_update_by';


    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class,'user_id', 'id');
    }

    /**
     * Get user info by role
     * @param $role
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    protected static function getByRole($role){
        $list =  static::select()
            ->where('role', $role)
            ->with('person')
            ->get();
        return $list->map(function($item){
            return [
                'user_id' => $item['user_id'],
                'role' => $item['role'],
                'name' => $item['person']->name,
                'organisation' => $item['person']->organisation,
            ];
        });
    }


    /**
     * Check if user is authorized
     *
     * @param $user
     * @param null $form
     * @return bool
     */
    public static function isAuthorized($user, $form = null): bool
    {
        return static::isEncoder($user)
            || static::isSupervisor($user)
            || static::isReadOnly($user);
    }

    /**
     * Check if user is SUPERVISOR
     *
     * @param $user
     * @param null $form
     * @return bool
     */
    private static function isSupervisor($user, $form = null): bool
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where('role', static::SUPERVISOR)
            ->get()
            ->isNotEmpty();
    }

    /**
     * Check if user is READONLY
     *
     * @param $user
     * @return bool
     */
    private static function isReadOnly($user): bool
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where('role', static::READONLY)
            ->get()
            ->isNotEmpty();
    }

    /**
     * Check if user is ENCODER
     *
     * @param $user
     * @return bool
     */
    public static function isEncoder($user): bool
    {
        $query = static::select()
            ->where('user_id', $user->getKey())
            ->where('role', static::ENCODER);
        return $query
            ->get()
            ->isNotEmpty();
    }

    /**
     * get user by role and WDPA
     *
     * @param int $wdpa
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    private static function getByWdpaAndRole(int $wdpa, string $role){
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

    /**
     * List Roles
     *
     * @param null $wdpa
     * @return array
     */
    public static function listRoles($wdpa = null): array
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
     * Check if the given role is valid
     *
     * @param $role
     * @return bool
     */
    public static function isValidRole($role): bool
    {
        return in_array($role, [static::SUPERVISOR, static::READONLY, static::ENCODER]);
    }

    /**
     * Grant a role to user
     *
     * @param $user_id
     * @param $role
     * @param null $wdpa
     * @return false|mixed
     * @throws \Throwable
     */
    public static function grantRole($user_id, $role, $wdpa = null)
    {
        try{
            DB::beginTransaction();
            if($role === static::SUPERVISOR || $role === static::READONLY){
                $id = static::create(['user_id' => $user_id, 'role' => $role])->getKey();
            }
            elseif ($role === static::ENCODER){
                $id = static::create(['user_id' => $user_id, 'role' => $role, 'wdpa' => $wdpa])->getKey();
            }
            DB::commit();
            return $id;
        } catch (\Exception $e){
            return false;
        }
    }

    /**
     * Revoke role to user
     *
     * @param $user_id
     * @param $role
     * @param null $wdpa
     * @return string[]
     * @throws \Exception
     */
    public static function revokeRole($user_id, $role, $wdpa = null): array
    {
        static::where('user_id', $user_id)
            ->where('role', $role)
            ->where('wdpa', $wdpa)
            ->delete();
        return [
            'status' => 'success'
        ];
    }

}
