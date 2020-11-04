<?php

namespace App\Models;

use App\Library\Utils\Type\Chars;
use App\Models\Components\EntityModel;
use App\Models\Person\Person;
use Carbon\Carbon;


class UserRight extends EntityModel
{
    protected $table = 'user_rights';

    public const CREATED_AT = 'last_update_date';
    public const UPDATED_AT = 'last_update_date';
    public const UPDATED_BY = 'last_update_by';

    public const ROLE_ADMIN = 'administrator';
    public const ROLE_KNOWLEDGE_BASE_EDITOR = 'knowledge-base_editor';


    protected $fillable = [
        'user_id'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class,'user_id', 'id');
    }

    /**
     * Grant administrator permission to user
     * @param $user_id
     */
    public static function grantAdmin($user_id)
    {
        $user_right = new static();
        $user_right->user_id = $user_id;
        $user_right->role = static::ROLE_ADMIN;
        $user_right->save();
    }

    /**
     * Revoke administrator permission to user
     * @param $user_id
     */
    public static function revokeAdmin($user_id)
    {
        static::where('user_id', $user_id)
            ->where('role', static::ROLE_ADMIN)
            ->delete();
    }

    /**
     * Grant a specific permission to user
     * @param $user_id
     * @param $scope
     */
    public static function grantAccess($user_id, $scope)
    {
        $user_right = new static();
        $user_right->user_id = $user_id;
        $user_right->scope = $scope;
        $user_right->access = true;
        $user_right->save();
    }

    /**
     * Revoke specific permission to user
     * @param $user_id
     * @param $scope
     * @param string $permission
     * @throws \Exception
     */
    public static function revokeAccess($user_id, $scope, $permission='access')
    {
        static::where('user_id', $user_id)
            ->where('scope', $scope)
            ->delete();
    }


    /**
     * Revoke ALL to user
     * @param $user_id
     */
    public static function revokeAll($user_id)
    {
        static::where('user_id', $user_id)
            ->delete();
    }

    /**
     * Update a specific indicator permission to user
     * @param $record
     */
    public static function updateIndicator($record)
    {
        $user_right = empty($record['id'])
            ? new static()
            : static::find($record['id']);

        $user_right->user_id    = $record['user_id'];
        $user_right->scope      = $record['scope'];
        $user_right->country    = isset($record['country']) ? $record['country'] : null;
        $user_right->site       = $record['site'];
        $user_right->encode     = isset($record['encode']) && $record['encode']===true ? true : null;
        $user_right->modify     = isset($record['modify']) && $record['modify']===true ? true : null;
        $user_right->validate   = isset($record['validate']) && $record['validate']===true ? true : null;
        $user_right->delete     = isset($record['delete']) && $record['delete']===true ? true : null;

        if($user_right->isDirty()){
            $user_right->save();
        }
    }

    public static function clean(){
        static::where([
            'access' => null,
            'encode' => null,
            'modify' => null,
            'validate' => null,
            'delete' => null
        ])->delete();
    }

    /**
     * save() override
     * @param array $options
     * @return bool
     */
    public function save(array $options = []) {

        $this->{static::UPDATED_BY} =  \Auth::user()->getKey();
        if($this->isDirty()){
            $this->{static::UPDATED_AT} =  Carbon::now()->format('Y-m-d H:i:s');
        }

        return parent::save($options);
    }

}