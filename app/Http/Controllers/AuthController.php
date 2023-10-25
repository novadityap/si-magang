<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function __contruct() {
    $this->middleware(['auth:superuser,web'])->only('logout');
  }

  public function index() {
    return view('login');
  }

  public function prosesLogin(Request $request) {
    $validated = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required']
    ]);

    if(Auth::guard('superuser')->attempt([
      'email' => $validated['email'], 
      'password' => $validated['password']
    ], $request->remember) || Auth::guard('web')->attempt([
      'email' => $validated['email'], 
      'password' => $validated['password']
    ], $request->remember)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard'); 
    }

    return redirect()->back()->withError('Email atau kata sandi Anda salah.');
  }

  public function logout(Request $request) {
    if(auth('web')->check()) {
      auth('web')->logout();
    } else {
      auth('superuser')->logout();
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('login');
  }
}
