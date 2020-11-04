<?php

namespace App\Models\Species;

use App\Models\Components\EntityModel;

class Plant extends EntityModel
{

    protected $table = 'KnowledgeBase.Essences';
    protected $primaryKey = 'EssenceID';

    public const LABEL = 'Name';
    public const CREATED_AT = 'CreateDate';
    public const UPDATED_AT = 'ModifyDate';
    public const UPDATED_BY = 'ModifiedBy';

    /**
     * Relation to Commecial Names
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commercial_names()
    {
        return $this->hasMany(PlantCommercialName::class, $this->primaryKey);
    }

    /**
     * Relation to Commecial Names
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scientific_names()
    {
        return $this->hasMany(PlantScientificName::class, $this->primaryKey);
    }

    /**
     * Search by key
     *
     * @param $ids
     * @param $search_key
     * @return mixed
     */
    public static function searchByKeyAndIds($ids, $search_key)
    {
        return static::whereIn('EssenceID', $ids)
            ->orWhere('Name', '~~*', '%' . $search_key . '%')
            ->orderBy('Name')
            ->with('commercial_names')
            ->with('scientific_names')
            ->get();
    }
}
