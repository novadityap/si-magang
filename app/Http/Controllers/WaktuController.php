<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WaktuController extends Controller
{
  public function index() {
    $waktu = Waktu::all();
    return view('edit-waktu', compact('waktu'));
  }

  public function editWaktu(Waktu $waktu) {
    return response()->json([
      'success' => true,
      'data' => $waktu
    ], 200);
  }

  public function updateWaktu(Request $request, Waktu $waktu) {
    $validator = Validator::make($request->all(), [
      'buka' => ['required'],
      'tutup' => ['required'],
    ]);

    if($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validasi error',
        'errors' => $validator->errors()
      ], 422);
    }

    $validated = $validator->validated();
    $waktu->update($validated);

    return response()->json([
      'success' => true,
      'message' => 'Data berhasil diupdate'
    ], 200);
  }
}
