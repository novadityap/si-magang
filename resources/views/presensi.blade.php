@extends('layouts.app')
@section('content')
<div>
  <div class="row">
    <!-- presensi datang -->
    <div class="col-sm-8 col-md-8 col-xl-5">
      <div class="card mb-4">
        <div class="card-header fs-5">
          Presensi Datang
        </div>
        <div class="card-body">
          <div class="row text-capitalize">
            <div class="col-12 col-md-6">
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Nama</span>
                <span>{{ $user->username }}</span>
              </div>
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Asal Sekolah</span>
                <span>{{ $user->asal_sekolah }}</span>
              </div>
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Tanggal</span>
                <span>{{ now()->translatedFormat('D, d-m-Y') }}</span>
              </div>
            </div>
            <form action="{{ route('proses.presensi.datang', [auth('web')->id()]) }}" method="POST">
              @csrf
              <input type="hidden" name="tanggal" value="{{ now() }}">
              <input type="hidden" name="jam_masuk" value="{{ now() }}">
              <!-- cek statusnya di hari ini apakah ada -->
              @if(empty($presensiUserSekarang->status))
              <button type="submit" class="btn btn-primary">Presensi</button>
              @else
              <div class="alert alert-success d-flex align-items-center gap-2 py-2 fw-medium">
                <i class="fs-2 bi bi-check2-circle"></i>
                <span>Anda sudah presensi</span>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /presensi datang -->

    @if(isset($presensiUserSekarang->jam_keluar))
    <div class="col-sm-8 col-md-8 col-xl-5">
      <!-- presensi pulang -->
      <div class="card">
        <div class="card-header fs-5">
          Presensi Pulang
        </div>
        <div class="card-body">
          <div class="row text-capitalize">
            <div class="col-12 col-md-6">
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Nama</span>
                <span>{{ $user->username }}</span>
              </div>
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Asal Sekolah</span>
                <span>{{ $user->asal_sekolah }}</span>
              </div>
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Tanggal</span>
                <span>{{ now()->translatedFormat('D, d-m-Y') }}</span>
              </div>
            </div>
            <form action="{{ route('proses.presensi.pulang', [auth('web')->id()]) }}" method="POST">
              @csrf
              <input type="hidden" name="jam_keluar" value="{{ now() }}">
              @if(empty($presensiUserSekarang->jam_keluar))
              <button type="submit" class="btn btn-primary">Presensi</button>
              @else
              <div class="alert alert-success d-flex align-items-center gap-2 py-2 fw-medium">
                <i class="fs-2 bi bi-check2-circle"></i>
                <span>Anda sudah presensi</span>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
      <!-- /presensi pulang -->
    </div>
    @elseif(now()->between($jamPresensiTutup->copy()->subHour(1), $jamPresensiTutup))
    <div class="col-sm-8 col-md-8 col-xl-5">
      <!-- presensi pulang -->
      <div class="card">
        <div class="card-header fs-5">
          Presensi Pulang
        </div>
        <div class="card-body">
          <div class="row text-capitalize">
            <div class="col-12 col-md-6">
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Nama</span>
                <span>{{ $user->username }}</span>
              </div>
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Asal Sekolah</span>
                <span>{{ $user->asal_sekolah }}</span>
              </div>
              <div class="d-flex flex-column mb-3">
                <span class="fs-6 fw-semibold">Tanggal</span>
                <span>{{ now()->translatedFormat('D, d-m-Y') }}</span>
              </div>
            </div>
            <form action="{{ route('proses.presensi.pulang', [auth('web')->id()]) }}" method="POST">
              @csrf
              <input type="hidden" name="jam_keluar" value="{{ now() }}">
              @if(empty($presensiUserSekarang->jam_keluar))
              <button type="submit" class="btn btn-primary">Presensi</button>
              @else
              <div class="alert alert-success d-flex align-items-center gap-2 py-2 fw-medium">
                <i class="fs-2 bi bi-check2-circle"></i>
                <span>Anda sudah presensi</span>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
      <!-- /presensi pulang -->
    </div>
    @endif
  </div>
</div>
@endsection