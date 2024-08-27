<?php

namespace AndreaMarelli\ModularForms\Models\Utils;

use AndreaMarelli\ModularForms\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;


abstract class ProtectedArea extends BaseModel
{
    protected $table = null;            // to be defined
    protected $primaryKey = null;       // to be defined

    public $incrementing = false;       // required for textual primary_key

    public const LABEL = 'name';

    /**
     * Scope a query by search key
     */
    public function scopeLike(Builder $query, ?string $searchKey = null): Builder
    {
        $like_operator = $this->getConnection()->getDriverName() == 'sqlite'
            ? 'LIKE'
            : '~~*'; // PostgreSQL case insensitive

        if($searchKey!==null && $searchKey!==''){
            $query = $query->where('name', $like_operator, '%' . $searchKey . '%');
            if(is_numeric($searchKey)){
                $query =  $query->orWhere('wdpa_id', $searchKey);
            }
        }
        return $query;
    }

    /**
     * Get by WDPA id
     */
    public static function getByWdpa(string $wdpa): ProtectedArea
    {
        return static::where('wdpa_id', $wdpa)
            ->firstOrFail();
    }

}
