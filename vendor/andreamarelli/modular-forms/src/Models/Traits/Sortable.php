<?php

namespace AndreaMarelli\ModularForms\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;

trait Sortable {

    use \Kyslik\ColumnSortable\Sortable{
        \Kyslik\ColumnSortable\Sortable::scopeSortable as parentScopeSortable;
    }

    protected static $sortBy = null;
    protected static $sortDirection = null;


    /**
     * Override: force all columns as sortable
     *
     * @param $query
     * @param null $defaultSortParameters
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Kyslik\ColumnSortable\Exceptions\ColumnSortableException
     */
    public function scopeSortable($query, $defaultSortParameters = null): Builder
    {
        $defaultSort = static::$sortBy ?: $this->getKeyName();
        $defaultDirection = static::$sortDirection ?: Config::get('columnsortable.default_direction', 'asc');

        if(!Request::filled('sort')){
            Request::merge([
                'sort' => $defaultSort,
                'direction' => $defaultDirection
            ]);
        }

        if(empty($this->sortable) && Request::filled('sort')){
            $this->sortable = Arr::wrap(Request::input('sort'));
        }

        return $this->parentScopeSortable($query, $defaultSortParameters);
    }
}
