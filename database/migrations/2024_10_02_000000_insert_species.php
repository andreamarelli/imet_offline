<?php

use AndreaMarelli\ImetCore\Models\Animal;
use App\Helpers\SpeciesUpdater;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // get contents of a file into a string
        $filename = database_path(SpeciesUpdater::CSV_MIGRATION_PATH);

        // Open and read the CSV file
        $data = [];
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = array_combine($header, $row);
        }

        // Split the data into chunks
        $data = array_chunk($data, 100);

        // Upsert data into the database
        foreach ($data as $chunk) {
            Animal::upsert($chunk, ['order', 'family', 'genus', 'species'], SpeciesUpdater::MIGRATION_ATTRIBUTES);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('imet_pas')->truncate();
    }
};
