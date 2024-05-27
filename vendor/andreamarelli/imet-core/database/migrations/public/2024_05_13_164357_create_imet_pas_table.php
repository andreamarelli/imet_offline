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
        Schema::create('imet_pas', function (Blueprint $table) {
            $table->text('global_id')->primary();
            $table->text('country')->nullable();
            $table->integer('wdpa_id')->nullable();
            $table->text('name')->nullable();
            $table->text('iucn_category')->nullable();
            $table->text('creation_date')->nullable();
            $table->decimal('perimeter')->nullable();
            $table->decimal('area')->nullable();
            $table->decimal('shape_index')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imet_pas');
    }
};
