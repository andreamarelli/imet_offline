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
        Schema::create('context_missions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('LocalVision')->nullable();
            $table->text('LocalMission')->nullable();
            $table->text('LocalObjective')->nullable();
            $table->text('LocalSource')->nullable();
            $table->string('LocalManagementPlan', 256)->nullable();
            $table->binary('LocalManagementPlan_BYTEA')->nullable();
            $table->text('InternationalVision')->nullable();
            $table->text('InternationalMission')->nullable();
            $table->text('InternationalObjective')->nullable();
            $table->text('InternationalSource')->nullable();
            $table->string('InternationalManagementPlan', 256)->nullable();
            $table->binary('InternationalManagementPlan_BYTEA')->nullable();
            $table->text('Observation')->nullable();

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
        Schema::dropIfExists('context_missions');
    }
};
