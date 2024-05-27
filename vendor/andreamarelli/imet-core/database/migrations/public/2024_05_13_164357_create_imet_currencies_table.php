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
        Schema::create('imet_currencies', function (Blueprint $table) {
            $table->text('iso')->primary();
            $table->text('name_fr')->nullable();
            $table->text('name_en')->nullable();
            $table->text('name_sp')->nullable();
            $table->text('name_pt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imet_currencies');
    }
};
