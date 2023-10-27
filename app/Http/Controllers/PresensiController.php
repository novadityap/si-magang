<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Waktu;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
  public function index() {
    $waktuBiasa = Waktu::where('hari', 'biasa')->first();
    $waktuJumat = Waktu::where('hari', 'jumat')->first();
    $waktuBukaBiasa = Carbon::parse($waktuBiasa->buka);
    $waktuTutupBiasa = Carbon::parse($waktuBiasa->tutup);
    $waktuTutupJumat = Carbon::parse($waktuJumat->tutup);
    $user = User::findOrFail(auth('web')->id());
    $presensiUserSekarang = $user->presensi->where('tanggal', '=', now()->toDateString())->first();
    
    return view('presensi', compact(
      'user', 
      'presensiUserSekarang', 
      'waktuBukaBiasa', 
      'waktuTutupBiasa',
      'waktuTutupJumat'
    ));
  }

  public function prosesPresensiDatang(Request $request) {
    $user = User::findOrFail(auth('web')->id());
    
    function cekStatus($requestJamMasuk) {
      $jamMasuk = Carbon::parse($requestJamMasuk);
      $waktuBiasa = Waktu::where('hari', 'biasa')->first();
      $waktuBukaBiasa = Carbon::parse($waktuBiasa->buka);
      $waktuTutupBiasa = Carbon::parse($waktuBiasa->tutup);
      $waktuJumat = Waktu::where('hari', 'jumat')->first();
      $waktuBukaJumat = Carbon::parse($waktuBiasa->buka);
      $waktuTutupJumat = Carbon::parse($waktuBiasa->tutup);

      if(strtolower(now()->isoFormat('dddd')) == 'jumat') {
        if($jamMasuk->between($waktuBukaJumat->copy()->subHour(1), $waktuBukaJumat)) {
          return $status = 'hadir';
        } elseif($jamMasuk->between($waktuBukaJumat, $waktuTutupJumat->copy()->subHour(1))) {
          return $status = 'terlambat';
        }
      } else {
        if($jamMasuk->between($waktuBukaBiasa->copy()->subHour(1), $waktuBukaBiasa)) {
          return $status = 'hadir';
        } elseif($jamMasuk->between($waktuBukaBiasa, $waktuTutupBiasa->copy()->subHour(1))) {
          return $status = 'terlambat';
        }
      }
    }
    
    $user->presensi()->create([
      'tanggal' => $request->tanggal,
      'jam_masuk' => $request->jam_masuk,
      'status' => cekStatus($request->jam_masuk)
    ]);

    return redirect()->back()->with('toast_success', 'Anda berhasil presensi datang.');
  }

  public function prosesPresensiPulang(Request $request) {
    $user = User::findOrFail(auth('web')->id());

    $user->presensi()->update([
      'jam_keluar' => $request->jam_keluar,
    ]);

    return redirect()->back()->with('toast_success', 'Anda berhasil presensi pulang.');
  }
}
