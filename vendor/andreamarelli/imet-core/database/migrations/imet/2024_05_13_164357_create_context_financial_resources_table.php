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
        Schema::create('context_financial_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->char('Currency', 3)->nullable();
            $table->decimal('ReferenceYear')->nullable();
            $table->decimal('ManagementFinancialPlanCosts')->nullable();
            $table->decimal('OperationalWorkPlanCosts')->nullable();
            $table->decimal('TotalBudget')->nullable();
            $table->decimal('AvailableTotalBudget')->nullable();
            $table->decimal('AvailableOperatingTotalBudget')->nullable();
            $table->decimal('AvailableInvestmentTotalBudget')->nullable();

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
        Schema::dropIfExists('context_financial_resources');
    }
};
