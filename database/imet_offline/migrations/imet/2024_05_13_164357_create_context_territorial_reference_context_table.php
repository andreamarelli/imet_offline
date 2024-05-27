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
        Schema::create('context_territorial_reference_context', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->decimal('FunctionalKm2')->nullable();
            $table->decimal('FunctionalPopulation')->nullable();
            $table->text('EcologicalAspects')->nullable();
            $table->decimal('BenefitKm2')->nullable();
            $table->decimal('FunctionalAreaPopulation')->nullable();
            $table->text('BenefitSocioEconomicAspects')->nullable();
            $table->text('SpillOverEffect')->nullable();
            $table->boolean('NoTakeArea')->nullable();
            $table->boolean('FunctionalHasNoTakeArea')->nullable();
            $table->decimal('FunctionalKm')->nullable();
            $table->decimal('BenefitKm')->nullable();
            $table->decimal('BenefitPopulation')->nullable();
            $table->decimal('SpillOverKm2')->nullable();
            $table->decimal('SpillOverKm')->nullable();
            $table->decimal('SpillOverEvalPredatory0_500')->nullable();
            $table->decimal('SpillOverEvalPredatory500_1000')->nullable();
            $table->decimal('SpillOverEvalPredatory200_3000')->nullable();
            $table->decimal('SpillOverEvalComposition0_500')->nullable();
            $table->decimal('SpillOverEvalComposition500_1000')->nullable();
            $table->decimal('SpillOverEvalComposition200_3000')->nullable();
            $table->decimal('SpillOverEvalDistance0_500')->nullable();
            $table->decimal('SpillOverEvalDistance500_1000')->nullable();
            $table->decimal('SpillOverEvalDistance200_3000')->nullable();

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
        Schema::dropIfExists('context_territorial_reference_context');
    }
};
