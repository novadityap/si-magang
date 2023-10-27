<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Superuser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Psy\Sudo;

class UserController extends Controller
{
  public function index(Request $request) {
    if($request->ajax()) {
      $superuser = Superuser::all();
      $user = User::all();
      $result = $superuser->concat($user);

      return DataTables::of($result)
        ->addIndexColumn()
        ->addColumn('aksi', function($data) {
          if(!isset($data->asal_sekolah)) {
            $btn = "<button id='btn-edit-superuser' class='btn btn-warning btn-sm' data-id='$data->id' data-bs-toggle='modal' data-bs-target='#modal-edit-superuser'><i class='bi bi-pencil-square' data-id='$data->id' ></i></button>";
            return $btn;
          } else {
            $btn = "<button id='btn-edit-user' class='btn btn-warning btn-sm' data-id='$data->id' data-bs-toggle='modal' data-bs-target='#modal-edit-user'><i class='bi bi-pencil-square' data-id='$data->id'></i></button>";
            $btn .= " <button id='btn-hapus-user' class='btn btn-danger btn-sm' data-id='$data->id'><i class='bi bi-trash3' data-id='$data->id'></i></button>";
            return $btn;
          }
          
        })
        ->rawColumns(['aksi'])
        ->toJson();
    }

    return view('user');
  }

  public function tambahUser(Request $request) {
    $validator = Validator::make($request->all(), [
      'username' => ['required', 'min:3', 'max:255'],
      'email' => ['required', 'min:3', 'unique:user', 'email'], 
      'password' => ['required', Password::min(8)],
      'asal_sekolah' => ['required'],
      'alamat' => ['required']
    ]);

    if($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validasi error',
        'errors' => $validator->errors() 
      ], 422);
    }

    $validated = $validator->validated();
    $user = User::create($validated);

    return response()->json([
      'success' => true,
      'message' => "Data user $user->username berhasil ditambahkan",
    ], 201);
  }

  public function tambahSuperuser(Request $request) {
    $validator = Validator::make($request->all(), [
      'username' => ['required', 'min:3', 'max:255'],
      'email' => ['required', 'min:3', 'unique:user', 'email'], 
      'password' => ['required', Password::min(8)],
    ]);

    if($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validasi error',
        'errors' => $validator->errors() 
      ], 422);
    }

    $validated = $validator->validated();
    $superuser = Superuser::create($validated);
   
    return response()->json([
      'success' => true,
      'message' => "Data user $superuser->username berhasil ditambahkan",
    ], 201);
  }

  public function editUser(User $user) {
    return response()->json([
      'success' => true,
      'data' => $user
    ], 200);
  }

  public function editSuperuser(Superuser $superuser) {
    return response()->json([
      'success' => true,
      'data' => $superuser
    ], 200);
  }

  public function updateUser(Request $request, User $user) {
    $validator = Validator::make($request->all(), [
      'username' => ['required', 'min:3', 'max:255'],
      'email' => ['required', 'min:3', Rule::unique('user')->ignore($user->id), 'email'],
      'password' => ['required', Password::min(8)],
      'asal_sekolah' => ['required'],
      'alamat' => ['required']
    ]);

    if($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validasi error',
        'errors' => $validator->errors()
      ], 422);
    }
    $validated = $validator->validated();
    $user->update($validated);

    return response()->json([
      'success' => true,
      'message' => "Data user $user->username berhasil diupdate",
    ], 200);
  }

  public function updateSuperuser(Request $request, Superuser $superuser) {
    $validator = Validator::make($request->all(), [
      'username' => ['required', 'min:3'],
      'email' => ['required', 'min:3', Rule::unique('user')->ignore($superuser->id), 'email'],
      'password' => ['required', Password::min(8)],
    ]);

    if($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => 'Validasi error',
        'errors' => $validator->errors()
      ], 422);
    }

    $validated = $validator->validated();
    $superuser->update($validated);

    return response()->json([
      'success' => true,
      'message' => "Data user $superuser->username berhasil diupdate",
    ], 200);
  }

  public function hapusUser(User $user) {
    $user->delete();

    return response()->json([
      'success' => true,
      'message' => "Data user $user->username berhasil dihapus"
    ], 200);
  }
}
