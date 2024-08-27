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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('proxy_host')->nullable();
            $table->string('proxy_port')->nullable();
            $table->string('proxy_user')->nullable();
            $table->string('proxy_password')->nullable();
            $table->timestamps();
        });

        // Insert empty record
        DB::table('settings')->insert(['id' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
