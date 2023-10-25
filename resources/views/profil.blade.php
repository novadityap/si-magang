@extends('layouts.app')
@section('content')
<div>
  <div class="card">
    <div class="card-header fs-5">
      Profil saya
    </div>
    <div class="card-body row">
      <!-- form edit profil -->
      <div class="col-12 col-lg-6 mb-5">
        <div class="d-flex align-items-center gap-2 mb-2">
          <i class="fs-5 bi bi-person-circle"></i>
          <span>Edit profil</span>
        </div>
        <form action="{{ route('update.profil', [$userLogin->id]) }}" method="POST" class="form">
          @method('PUT')
          @csrf
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="{{ old('username') ?? $userLogin->username }}">
            @error('username')
            <span class="text-error text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') ?? $userLogin->email }}">
            @error('email')
            <span class="text-error text-danger">{{ $message }}</span>
            @enderror
          </div>
          @auth('web')
          <div class="mb-3">
            <label class="form-label">Asal Sekolah</label>
            <input type="text" class="form-control" name="asal_sekolah" value="{{ old('asal_sekolah') ?? $userLogin->asal_sekolah }}">
            @error('asal_sekolah')
              <span class="text-error text-danger">{{ $message }}</span>
            @enderror
          </div>
          @endauth
          @auth('web')
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3">{{ old('alamat') ??$userLogin->alamat }}</textarea>
            @error('alamat')
              <span class="text-error text-danger">{{ $message }}</span>
            @enderror
          </div>
          @endauth
          <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
      </div>
      <!-- /form edit profil -->

      <!-- form update password -->
      <div class="col-12 col-lg-6 mb-5">
        <div class="d-flex align-items-center gap-2 mb-2">
          <i class="fs-5 bi bi-shield-lock"></i>
          <span>Ubah password</span>
        </div>
        <form method="POST" action="{{ route('update.password', [$userLogin->id]) }}" class="form">
          @csrf
          <div class="mb-3">
            <label class="form-label">Password lama</label>
            <input type="password" class="form-control" name="password_lama">
            @error('password_lama')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Password baru</label>
            <input type="password" class="form-control" name="password_baru">
            @error('password_baru')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Konfirmasi password</label>
            <input type="password" class="form-control" name="password_konfirmasi">
            @error('password_konfirmasi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
      </div>
      <!-- /form update password -->

      <!-- hapus akun -->
      <div class="row">
        <div class="col-12">
          <div class="d-flex align-items-center gap-2">
            <i class="fs-5 bi bi-exclamation-triangle"></i>
            Hapus akun:
          </div>
          <span class="text-danger">Akun yang dihapus tidak dapat dikembalikan dan Anda akan kehilangan semua data.</span>
          <button id="btn-hapus-profil" data-id="{{ $userLogin->id }}" data-bs-target="#modal-hapus-profil" class="btn btn-danger d-block">Hapus</button>
        </div>
      </div>
      <!-- /hapus akun -->
    </div>
  </div>

</div>
@endsection