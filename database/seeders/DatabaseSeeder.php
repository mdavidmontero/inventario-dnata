<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mateo',
            'email' => 'mateo@correo.com',
            'password' => bcrypt('password'),
        ]);
        $this->call([
            CategorySeeder::class,
        ]);

        Product::factory(100)->create();
    }
}
