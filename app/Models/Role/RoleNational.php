<?php

namespace App\Models\Role;


use App\Http\Controllers\Components\API;
use App\Models\Country;
use App\Models\User;

class RoleNational extends _Role
{
    use API;

    protected $table = 'user_roles_national';
    public const scopes = ['N1', 'N2', 'N3', 'N4', 'N5'];

    protected $guarded = null;
    protected $fillable = ['user_id', 'role', 'country', 'scope'];

    public const COORDINATOR = 'coordinator';
    public const TECH_ASSISTANT = 'tech_assistant';
    public const ENCODER = 'encoder';

    //public const LAST_EDITABLE_YEAR = 2017;

    public static function isAuthorized($user, $form = null, $scope = null)
    {
        // For a specific form
        if($form!==null){
            return
                //$form->annee>=static::LAST_EDITABLE_YEAR &&
                (static::isCoordinator($user, $form)
                    || static::isTechAssistant($user, $form)
                    || static::isEncoder($user, $form)
                );
        }
        // Has at least one authorization (any level). Used for index and create.
        elseif($scope!==null) {
            return
                static::isCoordinator($user)
                || static::select()
                ->where('user_id', $user->getKey())
                ->where('scope', $scope)
                ->get()
                ->isNotEmpty();
        }
        return false;
    }

    public static function hasAnyAuthorization($user)
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->get()
            ->isNotEmpty();
    }

    public static function isCoordinator($user, $form = null)
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
            ->where('scope', $form::FORM_CODE)
            ->where('role', static::TECH_ASSISTANT)
            ->get()
            ->isNotEmpty();
    }

    private static function isEncoder($user, $form)
    {
        return static::select()
            ->where('user_id', $user->getKey())
            ->where('country', $form->country)
            ->where('scope', $form::FORM_CODE)
            ->where('role', static::ENCODER)
            ->get()
            ->isNotEmpty();
    }

    public static function allowedCountries($user, $scope)
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
                    ->where('scope', $scope)
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
                'scope' => $item['scope'],
                'country' => $item['country'],
                'role' => $item['role'],
                'name' => $item['person']->name,
                'organisation' => $item['person']->organisation,
            ];
        });
    }

    public static function listRoles($country)
    {
        $coordinator = null;
        $tech_assistants = array_combine(static::scopes, array_fill(0, 5, null));
        $encoders = array_combine(static::scopes, array_fill(0, 5, array_fill(0, 1, null)));

        if($country!==null) {
            // coordinator
            $coordinator = static::getByCountryAndRole($country, static::COORDINATOR)->first();
            // tech_assistants
            foreach (static::getByCountryAndRole($country, static::TECH_ASSISTANT)->toArray() as $index => $tech) {
                $tech_assistants[$tech['scope']] = $tech;
            }
            // encoders
            foreach (static::getByCountryAndRole($country, static::ENCODER)->toArray() as $index => $enc) {
                if($encoders[$enc['scope']][0]===null){
                    $encoders[$enc['scope']][0] = $enc;
                } else {
                    array_unshift($encoders[$enc['scope']], $enc);
                }
            }
        }

        return [
            $coordinator, $tech_assistants, $encoders
        ];
    }

    /**
     * Grant a role to user
     *
     * @param $user_id
     * @param $role
     * @param $country
     * @param null $scope
     * @return \Illuminate\Http\JsonResponse|void
     */
    public static function grantRole($user_id, $role, $country, $scope = null)
    {
        try{
            if (in_array($role, [static::COORDINATOR, static::TECH_ASSISTANT, static::ENCODER])){
                \DB::beginTransaction();

                if($role === static::COORDINATOR){
                    static::where('role', $role)
                        ->where('country', $country)
                        ->delete();    // remove current
                    $id = static::create(['user_id' => $user_id, 'role' => $role, 'country' => $country])->getKey();
                }
                else if ($role === static::TECH_ASSISTANT){
                    static::where('role', $role)
                        ->where('country', $country)
                        ->where('scope', strtoupper($scope))
                        ->delete();    // remove current
                    $id = static::create(['user_id' => $user_id, 'role' => $role, 'country' => $country, 'scope' => strtoupper($scope)])->getKey();
                }
                else if ($role === static::ENCODER){
                    $id = static::create(['user_id' => $user_id, 'role' => $role, 'country' => $country, 'scope' => strtoupper($scope)])->getKey();
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
     * @param $country
     * @param null $scope
     * @return string[]
     */
    public static function revokeRole($user_id, $role, $country, $scope = null)
    {
        static::where('user_id', $user_id)
            ->where('role', $role)
            ->where('country', $country)
            ->where('scope', $scope!==null ? strtoupper($scope) : null)
            ->delete();
        return [
            'status' => 'success'
        ];
    }

}
