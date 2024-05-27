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
        Schema::create('imet_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->text('key_species_comment')->nullable();
            $table->text('habitats_comment')->nullable();
            $table->text('climate_change_comment')->nullable();
            $table->text('ecosystem_services_comment')->nullable();
            $table->text('threats_comment')->nullable();
            $table->text('analysis')->nullable();
            $table->text('strengths_swot')->nullable();
            $table->text('weaknesses_swot')->nullable();
            $table->text('opportunities_swot')->nullable();
            $table->text('threats_swot')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('priorities')->nullable();
            $table->text('minimum_budget')->nullable();
            $table->text('additional_funding')->nullable();
            $table->string('UpdateDate', 30)->nullable();

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
        Schema::dropIfExists('imet_report');
    }
};
