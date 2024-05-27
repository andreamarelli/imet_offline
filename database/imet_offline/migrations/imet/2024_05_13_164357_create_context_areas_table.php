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
        Schema::create('context_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->decimal('AdministrativeArea')->nullable();
            $table->decimal('GISArea')->nullable();
            $table->decimal('BoundaryLength')->nullable();
            $table->decimal('TerrestrialArea')->nullable();
            $table->decimal('MarineArea')->nullable();
            $table->decimal('PercentageNationalNetwork')->nullable();
            $table->decimal('PercentageEcoregion')->nullable();
            $table->decimal('PercentageTransnationalNetwork')->nullable();
            $table->decimal('PercentageLandscapeNetwork')->nullable();
            $table->string('Index', 25)->nullable();
            $table->text('Observations')->nullable();
            $table->decimal('WDPAArea')->nullable();

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
        Schema::dropIfExists('context_areas');
    }
};
