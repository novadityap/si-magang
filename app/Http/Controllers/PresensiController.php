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
    $waktu = Waktu::findOrFail(1);
    $user = User::findOrFail(auth('web')->id());
    $presensiUserSekarang = $user->presensi->where('tanggal', '=', now()->toDateString())->first();
    $jamPresensiTutup = Carbon::parse($waktu->tutup);

    return view('presensi', compact('user', 'presensiUserSekarang', 'jamPresensiTutup'));
  }

  public function prosesPresensiDatang(Request $request) {
    $user = User::findOrFail(auth('web')->id());
    
    function cekStatus($requestJamMasuk) {
      $waktu = Waktu::findOrFail(1);
      $jamPresensiBuka = Carbon::parse($waktu->buka);
      $jamPresensiTutup = Carbon::parse($waktu->tutup);
      $jamMasuk = Carbon::parse($requestJamMasuk);

      // jam masuk antara jam 6 - 7
      if($jamMasuk <= $jamPresensiBuka->subHour(1)) {
        return $status = 'hadir';
      } elseif($jamMasuk->between($jamPresensiBuka, $jamPresensiTutup)) {
        return $status = 'terlambat';
      } else {
        return $status = null;
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
