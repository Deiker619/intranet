<?php

namespace Database\Seeders;

use App\Models\mysql\Producto;
use App\Models\User;
use Database\Seeders\mysql\ProductSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User::factory(10)->create(); */
      
        $this->call(create_all_users_sigesp::class); //Crea todos los usuarios de la base de datos sigesp
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
