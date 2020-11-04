<?php

namespace App\Models\Person\Modules;

use App\Models\Components\EntityModel;
use App\Models\Components\Module;
use App\Models\Person\Person;
use App\Models\UserRight;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class _Rights extends Module
{
    protected $table = 'user_rights';
    public static $permissions = null;
    public static $foreign_key = 'user_id';

    /**
     * override getModule(): add condition on select
     * @param null $form_id
     * @return \Illuminate\Support\Collection
     */
    public static function getModule($form_id = null)
    {
        $model = new static();
        $model::$foreign_key = $model::$foreign_key ?? $model->primaryKey;
        $fields = $model::getModuleFieldsNames(['KEYS', 'TIMESTAMPS']);
        if($form_id!==null){
            return $model->select($fields)
                ->where($model::$foreign_key, $form_id)
                ->whereIn('scope', $model::$permissions)
                ->orderBy('scope')
                ->get();
        } else {
            return Collection::make();
        }
    }

    public static function updateModule(Request $request)
    {
        $records = json_decode($request->input('records_json'), true);
        $user_id = $request->input('form_id', null);
        foreach($records as $record){
            if($record['access']===true && !isset($record['id'])){
                UserRight::grantAccess($record['user_id'], $record['scope']);
            } elseif($record['access']===false && isset($record['id'])){
                UserRight::revokeAccess($record['user_id'], $record['scope']);
            }
        }
        return static::successResponse($user_id);
    }

    /**
     * Relation to Person
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}