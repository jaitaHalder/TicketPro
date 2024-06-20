<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Md. Chanchal Biswas',
             'email' => 'admin@gmail.com',
             'password' => Hash::make("12345")
         ]);

         $this->call(SettingSeeder::class);
    }
}
