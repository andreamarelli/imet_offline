<?php

namespace AndreaMarelli\ModularForms\Models\User;

use AndreaMarelli\ModularForms\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;


/**
 * Class UserRight
 *
 * @property string $user_id
 * @property string $role
 * @property string $scope
 * @property string $access
 * @package AndreaMarelli\ModularForms\Models\User
 */
class UserRight extends BaseModel
{
    protected $table = 'user_rights';

    public const CREATED_AT = 'last_update_date';
    public const UPDATED_AT = 'last_update_date';
    public const UPDATED_BY = 'last_update_by';

    public const ROLE_ADMIN = 'administrator';


    protected $fillable = [
        'user_id'
    ];

    /**
     * Relation to person
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class,'user_id', 'id');
    }

    /**
     * Grant administrator permission to user
     *
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
     *
     * @param $user_id
     * @throws \Exception
     */
    public static function revokeAdmin($user_id)
    {
        static::where('user_id', $user_id)
            ->where('role', static::ROLE_ADMIN)
            ->delete();
    }

    /**
     * Grant a specific permission to user
     *
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
     *
     * @param $user_id
     * @param $scope
     * @throws \Exception
     */
    public static function revokeAccess($user_id, $scope)
    {
        static::where('user_id', $user_id)
            ->where('scope', $scope)
            ->delete();
    }

    /**
     * Revoke ALL to user
     *
     * @param $user_id
     * @throws \Exception
     */
    public static function revokeAll($user_id)
    {
        static::where('user_id', $user_id)
            ->delete();
    }

    /**
     * Remove empty records
     *
     * @throws \Exception
     */
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
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = []): bool
    {
        $this->{static::UPDATED_BY} =  Auth::id();
        if($this->isDirty()){
            $this->{static::UPDATED_AT} =  Carbon::now()->format('Y-m-d H:i:s');
        }
        return parent::save($options);
    }

}
