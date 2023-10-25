@extends('layouts.app')
@section('content')
<div>

  <!-- datatable -->
  <div class="card">

    <div class="card-header fs-5">
      Daftar User
    </div>

    <div class="card-body">
      <div class="border p-2 table-responsive">
        <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modal-tambah-user"><i class="fs-5 bi bi-person-add me-2"></i>Add User</button>
        <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modal-tambah-superuser"><i class="fs-5 bi bi-person-add me-2"></i>Add Superuser</button>

        <table id="tabel-daftar-user" class="w-100 table table-striped table-hover">
          <thead class="table-light">
            <tr>
              <td>No</td>
              <td>Username</td>
              <td>Email</td>
              <td>Aksi</td>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </div>
  <!-- /datatable -->

  <!-- modal -->
  <!-- tambah user -->
  <div class="modal fade" id="modal-tambah-user" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Form Tambah User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
        <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" name="email">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Asal Sekolah</label>
              <input type="text" class="form-control" name="asal_sekolah">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" rows="3"></textarea>
              <span class="text-error text-danger"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button id="tutup-modal-tambah-user" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /tambah user -->

   <!-- tambah superuser -->
   <div class="modal fade" id="modal-tambah-superuser" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Form Tambah Superuser</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
        <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" name="email">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <span class="text-error text-danger"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button id="tutup-modal-tambah-superuser" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /tambah superuser -->

  <!-- edit user -->
  <div class="modal fade" id="modal-edit-user" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Form edit user</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
        <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" name="email">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Asal Sekolah</label>
              <input type="text" class="form-control" name="asal_sekolah">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" rows="3"></textarea>
              <span class="text-error text-danger"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button id="tutup-modal-edit-user" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /edit user -->

  <!-- edit superuser -->
  <div class="modal fade" id="modal-edit-superuser" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Form edit user</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
        <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" name="email">
              <span class="text-error text-danger"></span>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <span class="text-error text-danger"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button id="tutup-modal-edit-superuser" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /edit superuser -->
  <!-- /modal -->

</div>
@endsection