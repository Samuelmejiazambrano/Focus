<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Santos',
            'email' => 'santos@email.com', // Cambia este email si es necesario
            'password' => bcrypt('hol123'), // Encriptar la contraseña
        ]);
    }
}
