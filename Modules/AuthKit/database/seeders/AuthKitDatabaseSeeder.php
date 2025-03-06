<?php

namespace Modules\AuthKit\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AuthKit\Models\User;

class AuthKitDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
    }
}
