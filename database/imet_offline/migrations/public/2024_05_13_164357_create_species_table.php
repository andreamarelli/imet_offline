<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('species', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kingdom', 100)->nullable();
            $table->string('phylum', 100)->nullable();
            $table->string('class', 100)->nullable();
            $table->string('order', 100)->nullable();
            $table->string('family', 100)->nullable();
            $table->string('genus', 250)->nullable();
            $table->string('species', 250)->nullable();
            $table->string('common_name_fr', 500)->nullable();
            $table->string('common_name_en', 500)->nullable();
            $table->string('common_name_sp', 500)->nullable();
            $table->integer('iucn_redlist_id')->nullable();
            $table->string('iucn_redlist_category', 5)->nullable();
            $table->json('country_distribution')->nullable();
            $table->integer('last_update_by')->nullable();
            $table->string('last_update_date', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
