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
        Schema::create('context_general_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('FormID')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->text('CompleteName')->nullable();
            $table->text('UsedName')->nullable();
            $table->text('CompleteNameWDPA')->nullable();
            $table->integer('WDPA')->nullable();
            $table->string('Type', 35)->nullable();
            $table->char('Country', 3)->nullable();
            $table->integer('CreationYear')->nullable();
            $table->text('ReferenceText')->nullable();
            $table->string('Ownership', 350)->nullable();
            $table->text('Importance')->nullable();

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
        Schema::dropIfExists('context_general_info');
    }
};
