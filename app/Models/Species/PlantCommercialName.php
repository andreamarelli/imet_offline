<?php

namespace App\Models\Species;

use App\Models\Components\EntityModel;


class PlantCommercialName extends EntityModel
{

    protected $table = 'KnowledgeBase.EssenceCommercialNames';

    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public const UPDATED_BY = null;

    /**
     * Relation to Essence
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function essence()
    {
        return $this->belongsTo(Plant::class, 'EssenceID');
    }

    /**
     * Search by key
     * @param $search_key
     * @return mixed
     */
    public static function searchByKey($search_key)
    {
        return static::where('Name', '~~*', '%' . $search_key . '%')
            ->orderBy('Name')
            ->get();
    }

}
