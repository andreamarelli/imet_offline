<?php

use AndreaMarelli\ImetCore\Helpers\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = Database::OECM_CONNECTION;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imet_report', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->text('analysis')->nullable();
            $table->text('key_elements_comment')->nullable();
            $table->text('strengths_swot')->nullable();
            $table->text('weaknesses_swot')->nullable();
            $table->text('opportunities_swot')->nullable();
            $table->text('threats_swot')->nullable();
            $table->text('priorities')->nullable();
            $table->text('minimum_budget')->nullable();
            $table->text('additional_funding')->nullable();
            $table->text('previous_state')->nullable();
            $table->text('driving_forces')->nullable();
            $table->text('impacts')->nullable();
            $table->text('proposed_short')->nullable();
            $table->text('responses')->nullable();
            $table->text('proposed_long')->nullable();
            $table->text('long_term')->nullable();
            $table->text('outcome')->nullable();
            $table->boolean('outcome_year1')->nullable()->default(false);
            $table->boolean('outcome_year2')->nullable()->default(false);
            $table->boolean('outcome_year3')->nullable()->default(false);
            $table->boolean('outcome_year4')->nullable()->default(false);
            $table->boolean('outcome_year5')->nullable()->default(false);
            $table->text('annual_targets')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->string('group_key', 50)->nullable();
            $table->text('annual_targets1')->nullable();
            $table->text('annual_targets1_activity1')->nullable();
            $table->boolean('annual_targets1_activity1_year1')->nullable()->default(false);
            $table->boolean('annual_targets1_activity1_year2')->nullable()->default(false);
            $table->boolean('annual_targets1_activity1_year3')->nullable()->default(false);
            $table->boolean('annual_targets1_activity1_year4')->nullable()->default(false);
            $table->boolean('annual_targets1_activity1_year5')->nullable()->default(false);
            $table->text('annual_targets1_activity2')->nullable();
            $table->boolean('annual_targets1_activity2_year1')->nullable()->default(false);
            $table->boolean('annual_targets1_activity2_year2')->nullable()->default(false);
            $table->boolean('annual_targets1_activity2_year3')->nullable()->default(false);
            $table->boolean('annual_targets1_activity2_year4')->nullable()->default(false);
            $table->boolean('annual_targets1_activity2_year5')->nullable()->default(false);
            $table->text('outcome2')->nullable();
            $table->boolean('outcome2_year1')->nullable()->default(false);
            $table->boolean('outcome2_year2')->nullable()->default(false);
            $table->boolean('outcome2_year3')->nullable()->default(false);
            $table->boolean('outcome2_year4')->nullable()->default(false);
            $table->boolean('outcome2_year5')->nullable()->default(false);
            $table->text('annual_targets2')->nullable();
            $table->text('annual_targets2_activity1')->nullable();
            $table->boolean('annual_targets2_activity1_year1')->nullable()->default(false);
            $table->boolean('annual_targets2_activity1_year2')->nullable()->default(false);
            $table->boolean('annual_targets2_activity1_year3')->nullable()->default(false);
            $table->boolean('annual_targets2_activity1_year4')->nullable()->default(false);
            $table->boolean('annual_targets2_activity1_year5')->nullable()->default(false);
            $table->text('annual_targets2_activity2')->nullable();
            $table->boolean('annual_targets2_activity2_year1')->nullable()->default(false);
            $table->boolean('annual_targets2_activity2_year2')->nullable()->default(false);
            $table->boolean('annual_targets2_activity2_year3')->nullable()->default(false);
            $table->boolean('annual_targets2_activity2_year4')->nullable()->default(false);
            $table->boolean('annual_targets2_activity2_year5')->nullable()->default(false);
            $table->text('annual_targets2_activity3')->nullable();
            $table->boolean('annual_targets2_activity3_year1')->nullable()->default(false);
            $table->boolean('annual_targets2_activity3_year2')->nullable()->default(false);
            $table->boolean('annual_targets2_activity3_year3')->nullable()->default(false);
            $table->boolean('annual_targets2_activity3_year4')->nullable()->default(false);
            $table->boolean('annual_targets2_activity3_year5')->nullable()->default(false);
            $table->text('annual_targets2_activity4')->nullable();
            $table->boolean('annual_targets2_activity4_year1')->nullable()->default(false);
            $table->boolean('annual_targets2_activity4_year2')->nullable()->default(false);
            $table->boolean('annual_targets2_activity4_year3')->nullable()->default(false);
            $table->boolean('annual_targets2_activity4_year4')->nullable()->default(false);
            $table->boolean('annual_targets2_activity4_year5')->nullable()->default(false);
            $table->text('annual_targets2_activity5')->nullable();
            $table->boolean('annual_targets2_activity5_year1')->nullable()->default(false);
            $table->boolean('annual_targets2_activity5_year2')->nullable()->default(false);
            $table->boolean('annual_targets2_activity5_year3')->nullable()->default(false);
            $table->boolean('annual_targets2_activity5_year4')->nullable()->default(false);
            $table->boolean('annual_targets2_activity5_year5')->nullable()->default(false);
            $table->text('annual_targets1_activity3')->nullable();
            $table->boolean('annual_targets1_activity3_year1')->nullable()->default(false);
            $table->boolean('annual_targets1_activity3_year2')->nullable()->default(false);
            $table->boolean('annual_targets1_activity3_year3')->nullable()->default(false);
            $table->boolean('annual_targets1_activity3_year4')->nullable()->default(false);
            $table->boolean('annual_targets1_activity3_year5')->nullable()->default(false);
            $table->text('annual_targets1_activity4')->nullable();
            $table->boolean('annual_targets1_activity4_year1')->nullable()->default(false);
            $table->boolean('annual_targets1_activity4_year2')->nullable()->default(false);
            $table->boolean('annual_targets1_activity4_year3')->nullable()->default(false);
            $table->boolean('annual_targets1_activity4_year4')->nullable()->default(false);
            $table->boolean('annual_targets1_activity4_year5')->nullable()->default(false);
            $table->text('annual_targets1_activity5')->nullable();
            $table->boolean('annual_targets1_activity5_year1')->nullable()->default(false);
            $table->boolean('annual_targets1_activity5_year2')->nullable()->default(false);
            $table->boolean('annual_targets1_activity5_year3')->nullable()->default(false);
            $table->boolean('annual_targets1_activity5_year4')->nullable()->default(false);
            $table->boolean('annual_targets1_activity5_year5')->nullable()->default(false);
            $table->json('objectives')->nullable()->default('{}');

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
