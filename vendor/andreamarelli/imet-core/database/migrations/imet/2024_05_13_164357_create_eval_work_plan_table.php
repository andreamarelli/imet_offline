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
        Schema::create('eval_work_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->decimal('PercentageLevel')->nullable();
            $table->text('Comments')->nullable();
            $table->decimal('PlanExistenceScore')->nullable();
            $table->decimal('PlanApplicationScore')->nullable();
            $table->boolean('PlanExistence')->nullable();
            $table->boolean('PlanUptoDate')->nullable();
            $table->boolean('PlanApproved')->nullable();
            $table->boolean('PlanImplemented')->nullable();
            $table->decimal('VisionAdequacy')->nullable();
            $table->decimal('PlanAdequacyScore')->nullable();

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
        Schema::dropIfExists('eval_work_plan');
    }
};
