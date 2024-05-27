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
        Schema::create('context_non_sustainable_usage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('HabitatParameter')->nullable();
            $table->decimal('HistoricalArea')->nullable();
            $table->string('Trend', 30)->nullable();
            $table->string('Reliability', 30)->nullable();
            $table->text('Sectors')->nullable();
            $table->decimal('PreviousEstimationArea')->nullable();
            $table->decimal('CurrentEstimationArea')->nullable();
            $table->string('HistoricalAreaData', 50)->nullable();
            $table->string('PreviousEstimationAreaData', 50)->nullable();

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
        Schema::dropIfExists('context_non_sustainable_usage');
    }
};
