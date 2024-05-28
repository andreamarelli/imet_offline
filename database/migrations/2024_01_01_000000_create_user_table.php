<?php

use AndreaMarelli\ImetCore\Helpers\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = Database::COMMON_CONNECTION;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password', 60)->nullable();
            $table->text('remember_token')->nullable();
            $table->integer('last_update_by')->nullable();
            $table->string('last_update_date')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('first_name', 75)->nullable();
            $table->string('last_name', 75)->nullable();
            $table->string('organisation', 125)->nullable();
            $table->string('function', 75)->nullable();
            $table->char('country', 3)->nullable();
            $table->string('imet_role', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
