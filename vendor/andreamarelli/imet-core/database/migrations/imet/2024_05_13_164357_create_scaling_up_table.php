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
        Schema::create('scaling_up', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wdpas', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scaling_up');
    }
};
