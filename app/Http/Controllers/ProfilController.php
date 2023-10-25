<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Superuser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules\Password;


class ProfilController extends Controller
{
  public function editProfil($id)
  {
    $superuserData = Superuser::findOrFail($id);
    $userData = User::findOrFail($id);

    if (Gate::forUser(auth('superuser')->user())->allows('editProfilSuperuser', $superuserData)) {
      $userLogin = $superuserData;
      return view('profil', compact('userLogin'));
    } elseif (Gate::forUser(auth('web')->user())->allows('editProfil', $userData)) {
      $userLogin = $userData;
      return view('profil', compact('userLogin'));
    } else {
      abort(403);
    }
  }

  public function updateProfil(Request $request, $id)
  {
    if (auth('web')->check() && auth('web')->id() == $id) {
      $user = User::findOrFail($id);

      $validated = $request->validate([
        'username' => ['required', 'min:3'],
        'email' => ['required', 'min:3', Rule::unique('user')->ignore($user->id), 'email'],
        'asal_sekolah' => ['required'],
        'alamat' => ['required']
      ]);

      $user->update($validated);
      return redirect()->back()->with('toast_success', 'Profil anda berhasil diupdate');
    } elseif (auth('superuser')->check() && auth('superuser')->id() == $id) {
      $superuser = Superuser::findOrFail($id);

      $validated = $request->validate([
        'username' => ['required', 'min:3'],
        'email' => ['required', 'min:3', Rule::unique('superuser')->ignore($superuser->id), 'email'],
      ]);

      $superuser->update($validated);
      return redirect()->back()->with('toast_success', 'Profil anda berhasil diupdate');
    } else {
      abort(403);
    }
  }

  public function updatePassword(Request $request, $id)
  {
    $validated = $request->validate([
      'password_lama' => ['required', 'current_password'],
      'password_baru' => ['required', Password::min(8)],
      'password_konfirmasi' => ['required', 'same:password_baru']
    ]);

    if (auth('web')->check() && auth('web')->id() == $id) {
      $user = User::findOrFail($id);
      $user->update([
        'password' => Hash::make($validated['password_konfirmasi'])
      ]);

      return redirect()->back()->with('toast_success', 'Password berhasil diubah.');
    } elseif (auth('superuser')->check() && auth('superuser')->id() == $id) {
      $superuser = Superuser::findOrFail($id);
      $superuser->update([
        'password' => Hash::make($validated['password_konfirmasi'])
      ]);

      return redirect()->back()->with('toast_success', 'Password berhasil diubah.');
    } else {
      abort(403);
    }
  }

  public function hapusProfil(Request $request, $id)
  {
    if (auth('web')->check() && auth('web')->id() == $id) {
      auth('web')->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      User::where('id', $id)->delete();
    } elseif(auth('superuser')->check() && auth('superuser')->id() == $id) {
      auth('superuser')->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      Superuser::where('id', $id)->delete();
    } else {
      abort(403);
    }
  }
}
