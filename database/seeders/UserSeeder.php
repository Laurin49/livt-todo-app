<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      User::create([
        'name' => 'S.Schonlau',
        'email' => 'schonlau@hsv.de',
        'email_verified_at' => now(),
        'password' => bcrypt('hsv1887tv')
      ]);
    }
}
