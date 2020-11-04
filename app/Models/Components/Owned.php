<?php

namespace App\Models\Components;

trait Owned {

    /**
     * Scope a query to get owned items (created by the given user)
     * @param $query
     * @param $owner_id
     * @return mixed
     */
    public static function scopeWhereOwned($query, $owner_id)
    {
        return $query->where(static::CREATED_BY, $owner_id);
    }

    /**
     * Verify is given user is the owner (who created it)
     * @param $owner_id
     * @return bool
     */
    public function isOwner($owner_id)
    {
        return $this->{static::CREATED_BY} == $owner_id;
    }

}