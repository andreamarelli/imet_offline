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
        Schema::create('context_governance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->string('GovernanceModel', 250)->nullable();
            $table->text('AdditionalInfo')->nullable();
            $table->string('ManagementUnique', 125)->nullable();
            $table->text('ManagementName')->nullable();
            $table->string('ManagementType', 250)->nullable();
            $table->string('DateOfCreation', 125)->nullable();
            $table->boolean('OfficialRecognition')->nullable();
            $table->text('SupervisoryInstitution')->nullable();
            $table->string('SubGovernanceModel', 250)->nullable();
            $table->integer('MemberRepresentativenessLevel')->nullable();
            $table->text('AdditionalInformation')->nullable();

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
        Schema::dropIfExists('context_governance');
    }
};
