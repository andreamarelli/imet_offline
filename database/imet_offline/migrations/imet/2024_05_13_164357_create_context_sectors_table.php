<?php

use AndreaMarelli\ImetCore\Helpers\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = Database::IMET_CONNECTION;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('context_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->string('Name', 250)->nullable();
            $table->text('Objectives')->nullable();
            $table->text('Restrictions')->nullable();
            $table->text('Source')->nullable();
            $table->text('Observations')->nullable();
            $table->text('SectorMap')->nullable();
            $table->binary('SectorMap_BYTEA')->nullable();
            $table->decimal('UnderControlArea')->nullable();
            $table->decimal('UnderControlPatrolKm')->nullable();
            $table->decimal('UnderControlPatrolManDay')->nullable();
            $table->string('TerrestrialOrMarine', 50)->nullable();

            $table->foreign(['FormID'], 'FormID_fk')
                ->references(['FormID'])
                ->on('imet_form')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('context_sectors');
    }
};
