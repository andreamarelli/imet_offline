<?php

namespace App\Models\Person\Modules;

use App\Models\Components\Module;
use App\Models\Person\Person;
use App\Models\User;


class ProjectOwner extends Module
{

    protected $table = 'Projects.ProjectOwners';
    public static $foreign_key = 'UserID';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'TABLE';
        $this->module_title = trans('entities.staff.project_owner');
        $this->module_fields = [
            [
                'name' => 'ProjectID',
                'type' => 'dropdown_entity-Project',
                'label' => trans_choice('form/project.project', 2),
            ],
        ];

        parent::__construct($attributes);
    }

    public static function getByOwnerArray($user_id)
    {
         return static::select('ProjectID')
            ->where('UserID', $user_id)
            ->get()
            ->pluck('ProjectID')
            ->toArray();
    }
    public static function getOwners($project_id)
    {
        return static::select('UserID')
            ->where('ProjectID', $project_id)
            ->get()
            ->pluck('UserID')
            ->toArray();
    }

    public static function ownProjects()
    {
        if(User::isAdmin(\Auth::user())){
            $count =  static::select('ProjectID')
                ->count();
        } else {
            $count =  static::select('ProjectID')
                ->where('UserID', \Auth::id())
                ->count();
        }
        return $count>0;
    }

    /**
     * Set a project's owner
     * @param $project_id
     * @param $user_id
     */
    public static function setOwner($project_id, $user_id)
    {
        $owner = new static();
        $owner->ProjectID = $project_id;
        $owner->UserID = $user_id;
        $owner->save();
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
