@extends('layouts.app')
@section('content')
  <div>
    <div class="card">
      <div class="card-header fs-5">
        Pengaturan Presensi
      </div>
      <div class="card-body">
        <table class="table table-hover table-responsive tab">
          <thead>
            <tr>
              <th>Hari</th>
              <th>Jam Buka</th>
              <th>Jam Tutup</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($waktu as $val)
              <tr>
                <td>{{ $val->hari }}</td>
                <td>{{ $val->buka }}</td>
                <td>{{ $val->tutup }}</td>
                <td>
                  <button id="btn-edit-waktu" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-edit-waktu" data-id={{ $val->id }}>
                    <i class="bi bi-pencil-square" data-id={{ $val->id }}></i>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- modal edit waktu --}}
      <div class="modal fade" id="modal-edit-waktu" tabindex="-1" aria-labelledby="modal-edit-waktu" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modal-edit-waktu">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
            <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Hari</label>
                  <input type="input" class="form-control" name="hari" disabled>
                  <span class="text-error text-danger"></span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jam Buka</label>
                  <input type="time" class="form-control" name="buka">
                  <span class="text-error text-danger"></span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jam Tutup</label>
                  <input type="time" class="form-control" name="tutup">
                  <span class="text-error text-danger"></span>
                </div>
              </div>
              <div class="modal-footer">
                <button id="tutup-modal-edit-waktu" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    {{-- /modal edit waktu --}}

  </div>
@endsection