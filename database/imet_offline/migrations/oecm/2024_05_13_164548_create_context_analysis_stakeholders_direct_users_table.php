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
        Schema::create('context_analysis_stakeholders_direct_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('Stakeholder')->nullable();
            $table->text('Element')->nullable();
            $table->decimal('Dependence')->nullable();
            $table->string('Access', 50)->nullable();
            $table->boolean('Rivalry')->nullable();
            $table->decimal('Quality')->nullable();
            $table->decimal('Quantity')->nullable();
            $table->text('Threats')->nullable();
            $table->text('Comments')->nullable();
            $table->string('group_key', 50)->nullable();
            $table->boolean('Illegal')->nullable();
            $table->text('Description')->nullable();

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
        Schema::dropIfExists('context_analysis_stakeholders_direct_users');
    }
};
