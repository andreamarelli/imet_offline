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
        Schema::create('eval_key_elements_impact', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('KeyElement')->nullable();
            $table->decimal('StatusSH')->nullable();
            $table->decimal('TrendSH')->nullable();
            $table->decimal('StatusER')->nullable();
            $table->decimal('TrendER')->nullable();
            $table->decimal('EffectSH')->nullable();
            $table->decimal('EffectER')->nullable();
            $table->string('ReliabilitySH', 30)->nullable();
            $table->string('ReliabilityER', 30)->nullable();
            $table->text('CommentsSH')->nullable();
            $table->text('CommentsER')->nullable();
            $table->string('group_key', 50)->nullable();

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
        Schema::dropIfExists('eval_key_elements_impact');
    }
};
