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
        Schema::create('imet_form', function (Blueprint $table) {
            $table->increments('FormID');
            $table->integer('Year')->nullable();
            $table->integer('UpdateBy')->nullable();
            $table->string('UpdateDate', 30)->nullable();
            $table->char('language', 2)->nullable();
            $table->char('version', 4)->nullable();
            $table->char('Country', 3)->nullable();
            $table->string('validation', 25)->nullable();
            $table->integer('wdpa_id')->nullable();
            $table->text('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imet_form');
    }
};
