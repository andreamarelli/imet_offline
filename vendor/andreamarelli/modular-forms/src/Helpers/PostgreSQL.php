<?php

namespace AndreaMarelli\ModularForms\Helpers;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostgreSQL
{
    /**
     * Return the list of columns for the given table
     */
    public static function getColumns($table): array
    {
        $schema = 'public';
        if(Str::contains($table, '.')){
            [$schema, $table] = explode('.', $table);
        }
        return DB::table('information_schema.columns')
            ->select(['column_name'])
            ->where('table_schema', '<>', 'pg_catalog')
            ->where('table_schema', '<>', 'information_schema')
            ->where('table_schema', $schema)
            ->where('table_name', $table)
            ->get()
            ->pluck('column_name')
            ->toArray();
    }

    /**
     * Return the database column names
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
     * Search the database for specific column names
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

    /**
     * Return the list of tables for the given schema
     */
    public static function getTablesBySchema($schema): array
    {
        return DB::table('information_schema.columns')
            ->select('table_name')
            ->where('table_schema', $schema)
            ->get()
            ->pluck('table_name')
            ->unique()
            ->toArray();
    }
}
