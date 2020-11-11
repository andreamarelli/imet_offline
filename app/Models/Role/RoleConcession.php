<?php

namespace App\Models\Role;


use App\Http\Controllers\Components\API;
use App\Models\Country;
use App\Models\User;

class RoleConcession extends _Role
{
    use API;

    protected $table = 'user_roles_concessions';

    protected $guarded = null;
    protected $fillable = ['user_id', 'role', 'country'];

    public const COORDINATOR = 'coordinator';
    public const TECH_ASSISTANT = 'tech_assistant';
    public const ENCODER = 'encoder';

    public static function isAuthorized($user, $form = null)
    {
        // For a specific form
        if($form!==null){
            return
                static::isCoordinator($user, $form) ||
                static::isTechAssistant($user, $form) ||
                static::isEncoder($user, $form);
        }
        // Has at least one authorization (any level). Used for index and create.
        else {
            return
                static::isCoordinator($user)
                || static::select()
                    ->where('user_id', $user->getKey())
                    ->get()
                    ->isNotEmpty();
        }
    }

    private static function isCoordinator($user, $form = null)
    {
        $query = static::select()
            ->where('user_id', $user->getKey())
            ->where('role', static::COORDINATOR);
        if($form!==null) {
            $query = $query->where('country', $form->country);
        }
        return $query
            ->get()
            ->isNotEmpty();
    }

    private static function isTechAssistant($user, $form)
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where('country', $form->country)
             // TODO:: site
            ->where('role', static::TECH_ASSISTANT)
            ->get()
            ->isNotEmpty();
    }

    private static function isEncoder($user, $form)
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where('country', $form->country)
            // TODO:: site
            ->where('role', static::ENCODER)
            ->get()
            ->isNotEmpty();
    }

    public static function allowedCountries($user)
    {
        if(User::isAdmin($user)){
            return Country::getOFAC()
                ->pluck('iso3');
        } else {

            return array_merge(
                static::select()
                    ->where('user_id', $user->getKey())
                    ->where('role', static::COORDINATOR)
                    ->get()
                    ->pluck('country')->toArray(),
                static::select()
                    ->where('user_id', $user->getKey())
                    ->get()
                    ->pluck('country')->toArray()
            );
        }
    }

    private static function getByCountryAndRole($country, $role){
        $list = static::select()
            ->where('country', $country)
            ->where('role', $role)
            ->with('person')
            ->get();
        return $list->map(function ($item) {
            return [
                'user_id' => $item['user_id'],
                'country' => $item['country'],
                'role' => $item['role'],
                'name' => $item['person']->name,
                'organisation' => $item['person']->organisation,
            ];
        });

    }

    public static function listRoles($country)
    {
        $coordinator = $tech_assistant = $encoders = null;

        if($country!==null) {
            $coordinator = static::getByCountryAndRole($country, static::COORDINATOR)->toArray();
            $tech_assistant = static::getByCountryAndRole($country, static::TECH_ASSISTANT)->toArray();
            $encoders = static::getByCountryAndRole($country, static::ENCODER)->toArray();
        }

        return [
            $coordinator,
            $tech_assistant,
            $encoders ?: [null]
        ];
    }

    /**
     * Grant a role to user
     *
     * @param $user_id
     * @param $role
     * @param $country
     * @return \Illuminate\Http\JsonResponse|void
     */
    public static function grantRole($user_id, $role, $country)
    {
        try{
            if (in_array($role, [
                static::COORDINATOR, static::TECH_ASSISTANT, static::ENCODER
            ])){

                \DB::beginTransaction();
                if($role === static::COORDINATOR || $role === static::TECH_ASSISTANT){
                    static::where('role', $role)
                        ->where('country', $country)
                        ->delete();    // remove current
                }
                $id = static::create(['user_id' => $user_id, 'role' => $role, 'country' => $country])->getKey();
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
     * @param $country
     * @return string[]
     */
    public static function revokeRole($user_id, $role, $country)
    {
        static::where('user_id', $user_id)
            ->where('role', $role)
            ->where('country', $country)
            ->delete();
        return [
            'status' => 'success'
        ];
    }


}
