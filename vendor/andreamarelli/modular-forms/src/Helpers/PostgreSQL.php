<?php

namespace AndreaMarelli\ModularForms\Helpers;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostgreSQL
{
    /**
     * Return the database column names
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getAllColumns(): Collection
    {
        return DB::table('information_schema.columns')
            ->select(['table_name', 'table_schema', 'column_name'])
            ->where('table_schema', '<>', 'pg_catalog')
            ->where('table_schema', '<>', 'information_schema')
            ->orderBy('table_schema')
            ->orderBy('table_name')
            ->orderBy('column_name')
            ->get();
    }

    /**
     * Search teh database for specific column names
     *
     * @param $search
     * @param string $operator
     * @return \Illuminate\Support\Collection
     */
    public static function searchColumns($search, string $operator = '='): Collection
    {
        return DB::table('information_schema.columns')
            ->select(['table_name', 'table_schema', 'column_name'])
            ->where('table_schema', '<>', 'pg_catalog')
            ->where('table_schema', '<>', 'information_schema')
            ->where('column_name', $operator, $search)
            ->orderBy('table_schema')
            ->orderBy('table_name')
            ->orderBy('column_name')
            ->get();
    }

}
