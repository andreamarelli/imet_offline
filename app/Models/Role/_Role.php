<?php

namespace App\Models\Role;

use App\Models\Components\EntityModel;
use App\Models\Person\Person;


abstract class _Role extends EntityModel
{
    public const UPDATED_AT = 'last_update_date';
    public const UPDATED_BY = 'last_update_by';

    public function person()
    {
        return $this->belongsTo(Person::class,'user_id', 'id');
    }

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

}