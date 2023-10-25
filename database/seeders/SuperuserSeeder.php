<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      \App\Models\Superuser::create([
        'username' => 'kabalai',
        'email' => 'kabalai@email.com',
        'password' => Hash::make('admin12345'),
      ]);

      \App\Models\Superuser::create([
        'username' => 'kasubagtu',
        'email' => 'kasubagtu@email.com',
        'password' => Hash::make('admin12345'),
      ]);
    }
}
