<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuBulanLalu = Carbon::now()->subMonth();

        for ($i = 0; $i < 25; $i++) {
            $presensi = new \App\Models\Presensi;
            $presensi->id_user = fake()->numberBetween(1, 2);
            $presensi->tanggal = fake()->dateTimeBetween($satuBulanLalu, 'now');
            $presensi->jam_masuk = fake()->time('H:i:s');
            $presensi->save();
        }
    }
}
