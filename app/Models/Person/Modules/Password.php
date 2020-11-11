<?php

namespace App\Models\Person\Modules;

use App\Models\Components\EntityModel;
use App\Models\Components\Module;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;


class Password extends Module
{

    protected $table = 'users';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('auth.password');
        $this->module_fields =[];

        parent::__construct($attributes);
    }
    public static function updateModule(Request $request)
    {
        // ### get request ###
        $record = json_decode($request->input('records_json'), true)[0];
        $user_id = $record['id'];
        unset($record[static::UPDATED_AT], $record[static::UPDATED_BY]);

        // ### Validate data ###
        $validator = Validator::make($record,
            ['new_password' => User::password_rule]
        );
        if($validator->fails()){
            return static::validationErrorResponse(['new_password' => [User::password_rule_msg]]);
        }

        $user = User::find($user_id);
        $user->password = Hash::make($record['new_password']);
        $user->save();

        return [
            'status' => 'success',
            'records' => static::getModule($user_id)
        ];
    }


}
