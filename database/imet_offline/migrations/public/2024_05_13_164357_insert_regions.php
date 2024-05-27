<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $fields = ['id', 'name', 'name_fr', 'name_sp', 'name_pt'];
        $records = [
            ['sa', 'Southern Africa', 'Southern Africa', 'Southern Africa', 'Southern Africa'],
            ['wa', 'Western Africa', 'Western Africa', 'Western Africa', 'Western Africa'],
            ['ca', 'Central Africa', 'Central Africa', 'Central Africa', 'Central Africa'],
            ['ea', 'Eastern Africa', 'Eastern Africa', 'Eastern Africa', 'Eastern Africa'],
            ['ap', 'ACP Pacific', 'ACP Pacific', 'ACP Pacific', 'ACP Pacific'],
            ['ac', 'ACP Caribbean', 'ACP Caribbean', 'ACP Caribbean', 'ACP Caribbean'],
        ];

        foreach ($records as $record) {
            DB::table('imet_regions')
                ->insert(array_combine($fields, $record));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('imet_regions')->truncate();
    }
};
