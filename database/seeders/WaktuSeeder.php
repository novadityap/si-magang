<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      \App\Models\Waktu::create([
        'hari' => 'biasa',
        'buka' => now()->createFromTime(7, 0, 0),
        'tutup' => now()->createFromTime(15, 30, 0)
      ]);

      \App\Models\Waktu::create([
        'hari' => 'jumat',
        'buka' => now()->createFromTime(7, 0, 0),
        'tutup' => now()->createFromTime(14, 00, 0)
      ]);
    }
}
