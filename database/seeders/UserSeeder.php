<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      \App\Models\User::create([
        'username' => 'nova aditya',
        'email' => 'nova@email.com',
        'password' => Hash::make('user12345'),
        'asal_sekolah' => 'universitas semarang',
        'alamat' => 'semarang',
      ]);

      \App\Models\User::create([
        'username' => 'aditya pratama',
        'email' => 'aditya@email.com',
        'password' => Hash::make('user12345'),
        'asal_sekolah' => 'universitas semarang',
        'alamat' => 'semarang',
      ]);
    }
}
