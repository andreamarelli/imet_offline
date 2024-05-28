<?php

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')
            ->insert([
                'id' => 0,
                'first_name' => 'Offline',
                'last_name' => 'User',
                'imet_role' => Role::ROLE_ADMINISTRATOR,
            ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')
            ->where('id', 0)
            ->delete();
    }
};
