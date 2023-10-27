@extends('layouts.app')
@section('content')
<div>
  <div class="row">
    @if(strtolower(now()->isoFormat('dddd')) != 'sabtu' || strtolower(now()->isoFormat('dddd')) != 'minggu')
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
                {{-- jika hari jumat --}}
                @if(strtolower(now()->isoFormat('dddd')) == 'jumat')
                  <!-- jika dini hari - jam 6 pagi -->
                  @if(now()->between(now()->startOfDay(), $waktuBukaBiasa->copy()->subHour(1)))
                    <div class="alert alert-info fw-medium">
                      Presensi Belum Dibuka
                    </div>
                  {{-- jika jam buka - tutup & jam masuk empty --}}
                  @elseif(now()->between($waktuBukaBiasa->copy()->subHour(1), $waktuTutupJumat->copy()->subHour(1)) && empty($presensiUserSekarang->jam_masuk))
                    <button type="submit" class="btn btn-primary">Presensi</button>
                  {{-- jika jam buka - tutup & jam masuk isset --}}
                  @elseif(now()->between($waktuBukaBiasa->copy()->subHour(1), $waktuTutupJumat->copy()->subHour(1)) && isset($presensiUserSekarang->jam_masuk))
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  {{-- jika jam tutup - malam & jam masuk empty --}}
                  @elseif(now()->between($waktuTutupJumat->copy()->subHour(1), $waktuTutupJumat->copy()->endOfDay()) && empty($presensiUserSekarang->jam_masuk))
                    <div class="alert alert-danger fw-medium">
                      Anda Tidak Presensi
                    </div>
                  @else 
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  @endif
                {{-- jika hari Biasa --}}
                @else()
                  {{-- jika jam buka - tutup & jam masuk empty --}}
                  @if(now()->between($waktuBukaBiasa->copy()->subHour(1), $waktuTutupBiasa->copy()->subHour(1)) && empty($presensiUserSekarang->jam_masuk))
                    <button type="submit" class="btn btn-primary">Presensi</button>
                  {{-- jika jam buka - tutup & jam masuk isset --}}
                  @elseif(now()->between($waktuBukaBiasa->copy()->subHour(1), $waktuTutupBiasa->copy()->subHour(1)) && isset($presensiUserSekarang->jam_masuk))
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  {{-- jika jam tutup - malam & jam masuk empty --}}
                  @elseif(now()->between($waktuTutupBiasa->copy()->subHour(1), $waktuTutupBiasa->copy()->endOfDay()) && empty($presensiUserSekarang->jam_masuk))
                    <div class="alert alert-danger fw-medium">
                      Anda Tidak Presensi
                    </div>
                  @else
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  @endif
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /presensi datang -->

      <!-- presensi pulang -->
      <div class="col-sm-8 col-md-8 col-xl-5">
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

                {{-- jika hari jumat --}}
                @if(strtolower(now()->isoFormat('dddd')) == 'jumat')
                  <!-- jika dini hari - jam tutup -->
                  @if(now()->between(now()->startOfDay(), $waktuTutupJumat))
                    <div class="alert alert-info fw-medium">
                      Presensi Belum Dibuka
                    </div>
                  {{-- jika jam tutup - +3 & jam keluar empty --}}
                  @elseif(now()->between($waktuTutupJumat, $waktuTutupJumat->copy()->addHour(3)) && empty($presensiUserSekarang->jam_keluar))
                    <button type="submit" class="btn btn-primary">Presensi</button>
                  {{-- jika jam tutup - +3 & jam keluar isset --}}
                  @elseif(now()->between($waktuTutupJumat, $waktuTutupJumat->copy()->addHour(3)) && isset($presensiUserSekarang->jam_keluar))
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  {{-- jika jam tutup +3 - malam & jam keluar empty --}}
                  @elseif(now()->between($waktuTutupJumat->copy()->addHour(3), $waktuTutupJumat->copy()->endOfDay()) && empty($presensiUserSekarang->jam_keluar))
                    <div class="alert alert-danger fw-medium">
                      Anda Tidak Presensi
                    </div>
                  @else 
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  @endif
                {{-- jika hari Biasa --}}
                @else()
                  <!-- jika dini hari - jam tutup -->
                  @if(now()->between(now()->startOfDay(), $waktuTutupBiasa))
                    <div class="alert alert-info fw-medium">
                      Presensi Belum Dibuka
                    </div>
                  {{-- jika jam tutup - +3 & jam keluar empty --}}
                  @elseif(now()->between($waktuTutupBiasa, $waktuTutupBiasa->copy()->addHour(3)) && empty($presensiUserSekarang->jam_keluar))
                    <button type="submit" class="btn btn-primary">Presensi</button>
                  {{-- jika jam tutup - +3 & jam keluar isset --}}
                  @elseif(now()->between($waktuTutupBiasa, $waktuTutupBiasa->copy()->addHour(3)) && isset($presensiUserSekarang->jam_keluar))
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  {{-- jika jam tutup +3 - malam & jam keluar empty --}}
                  @elseif(now()->between($waktuTutupBiasa->copy()->addHour(3), now()->endOfDay()) && empty($presensiUserSekarang->jam_keluar))
                    <div class="alert alert-danger fw-medium">
                      Anda Tidak Presensi
                    </div>
                  @else 
                    <div class="alert alert-success fw-medium">
                      Anda Sudah Presensi
                    </div>
                  @endif
                @endif

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /presensi pulang -->
      @else
        <div class="col-sm-8 col-md-8 col-xl-5">
          <div class="alert alert-info fw-medium">
            Presensi Tutup
          </div>
        </div>
      @endif
  </div>
</div>
@endsection