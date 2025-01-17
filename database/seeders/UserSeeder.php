<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tworzenie Administratora
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Zmień na bezpieczne hasło
            'role' => 'admin',
        ]);

        // Tworzenie Pracownika
        User::create([
            'name' => 'Pracownik',
            'email' => 'employee@example.com',
            'password' => Hash::make('password'), // Zmień na bezpieczne hasło
            'role' => 'employee',
        ]);

        // Tworzenie Klientów
        User::factory()->count(3)->create([
            'role' => 'client',
        ]);
    }
}

