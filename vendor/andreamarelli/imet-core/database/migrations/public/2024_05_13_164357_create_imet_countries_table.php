<?php

use AndreaMarelli\ImetCore\Helpers\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = Database::COMMON_CONNECTION;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imet_countries', function (Blueprint $table) {
            $table->text('iso2')->nullable();
            $table->text('iso3')->primary();
            $table->integer('iso')->nullable();
            $table->text('name_fr')->nullable();
            $table->text('name_en')->nullable();
            $table->text('name_sp')->nullable();
            $table->text('name_pt')->nullable();
            $table->string('region_id', 2)->nullable();

            $table->foreign(['region_id'], 'fk_region_id')
                ->references(['id'])
                ->on('imet_regions')
                ->onUpdate('no action')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imet_countries');
    }
};
