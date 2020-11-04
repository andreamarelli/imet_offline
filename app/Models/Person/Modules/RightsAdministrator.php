<?php

namespace App\Models\Person\Modules;


use App\Models\UserRight;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RightsAdministrator extends _Rights
{

    protected $appends = ['is_admin'];

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('form/rights.administrator');
        $this->module_fields = [
            [
                'name' => 'role',
                'type' => 'text',
                'label' => trans('form/rights.administrator'),
            ],
        ];

        $this->module_info = trans('form/rights.administrator_info');
        $this->module_info_type = 'plain';

        parent::__construct($attributes);
    }

    public function getIsAdminAttribute()
    {
        return User::isAdmin(User::find($this->attributes['user_id']));
    }

    public static function getModule($form_id = null)
    {
        $model = new static();
        $model::$foreign_key = $model::$foreign_key ?? $model->primaryKey;
        $fields = $model::getModuleFieldsNames(['KEYS', 'TIMESTAMPS']);
        if($form_id!==null){
            return $model->select($fields)
                ->where($model::$foreign_key, $form_id)
                ->where('role', UserRight::ROLE_ADMIN)
                ->get();
        } else {
            return Collection::make();
        }
    }

    public static function getModuleRecords($form_id, $collection = null){
        $return = parent::getModuleRecords($form_id, $collection);
        $is_admin = User::isAdmin(User::find($form_id));
        foreach ($return['records'] as $index=>$record){
            $return['records'][$index]['is_admin'] = $is_admin;
        }
        return $return;
    }

    public static function updateModule(Request $request)
    {

        $records = json_decode($request->input('records_json'), True);
        $is_admin = $records[0]['is_admin']===true || $records[0]['is_admin']==='true';
        $user_id = $records[0]['user_id'];

        if($is_admin){
            UserRight::revokeAll($user_id);
            UserRight::grantAdmin($user_id);
        } else {
            UserRight::revokeAdmin($user_id);
        }

        return static::successResponse($user_id);
    }

}