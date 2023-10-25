$(function () {
  $('#tabel-daftar-user').DataTable({
    ajax: route('daftar.user'),
    serverSide: true,
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
      {data: 'username', name: 'username'},
      {data: 'email', name: 'email'},
      {data: 'aksi', name: 'aksi', searchable: false, orderable: false},
    ]
  });

  $(document).on('submit', '#modal-tambah-user form', function (e) {
    e.preventDefault();
    
    $.ajax({
      type: "post",
      url: route('tambah.user'),
      data: $(e.target).serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#modal-tambah-user form .text-error').text('');
      },
      success: function (res) {
        Swal.fire({
          icon: 'success',
          title: res.message,
          showConfirmButton: false,
          toast: true,
          position: 'top-end',
          timer: 1500,
        });

        $(e.target).trigger('reset');
        $('#tutup-modal-tambah-user').trigger('click');
        $('#tabel-daftar-user').DataTable().ajax.reload();
      },
      error: function(xhr) {
        $.each(xhr.responseJSON.errors, function (i, val) { 
           $(`#modal-tambah-user form input[name=${i}]`).next('.text-error').text(val[0]);
           $(`#modal-tambah-user form textarea[name=${i}]`).next('.text-error').text(val[0]);
        }); 
      }
    });
  });

  $(document).on('submit', '#modal-tambah-superuser form', function (e) {
    e.preventDefault();

    $.ajax({
      type: "post",
      url: route('tambah.superuser'),
      data: $(e.target).serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#modal-tambah-superuser form .text-error').text('');
      },
      success: function (res) {
        Swal.fire({
          icon: 'success',
          title: res.message,
          showConfirmButton: false,
          toast: true,
          position: 'top-end',
          timer: 1500,
        });

        $(e.target).trigger('reset');
        $('#tutup-modal-tambah-superuser').trigger('click');
        $('#tabel-daftar-user').DataTable().ajax.reload();
      },
      error: function(xhr) {
        $.each(xhr.responseJSON.errors, function (i, val) { 
           $(`#modal-tambah-superuser form input[name=${i}]`).next('.text-error').text(val[0]);
           $(`#modal-tambah-superuser form textarea[name=${i}]`).next('.text-error').text(val[0]);
        }); 
      }
    });
  });

  $(document).on('click', '#btn-edit-user', function (e) {
    let textError = $('#modal-edit-user form .text-error');
    
    if(textError.text().length > 0) {
      textError.text('');
    }

    let id = $(e.target).data('id');
    let url = route('edit.user', {user: id});
    
    $.ajax({
      type: "get",
      url: url,
      dataType: "json",
      success: function (res) {
        $('#modal-edit-user form input[name=username]').val(res.data.username);
        $('#modal-edit-user form input[name=email]').val(res.data.email);
        $('#modal-edit-user form input[name=asal_sekolah]').val(res.data.asal_sekolah);
        $('#modal-edit-user form textarea[name=alamat]').val(res.data.alamat);
        $('#modal-edit-user form').data('id', id);
      }
    });
  });

  $(document).on('click', '#btn-edit-superuser', function (e) {
    let textError = $('#modal-edit-superuser form .text-error');
    
    if(textError.text().length > 0) {
      textError.text('');
    }

    let id = $(e.target).data('id');
    let url = route('edit.superuser', {superuser: id});
    
    $.ajax({
      type: "get",
      url: url,
      dataType: "json",
      success: function (res) {
        $('#modal-edit-superuser form input[name=username]').val(res.data.username);
        $('#modal-edit-superuser form input[name=email]').val(res.data.email);
        $('#modal-edit-superuser form').data('id', id);
      }
    });
  });

  $(document).on('submit', '#modal-edit-user form', function (e) {
    e.preventDefault();

    let id = $(e.target).data('id');
    let url = route('update.user', {user: id});

    $.ajax({
      type: "put",
      url: url,
      data: $(e.target).serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#modal-edit-user form .text-error').text('');
      },
      success: function (res) {
        Swal.fire({
          icon: 'success',
          title: res.message,
          showConfirmButton: false,
          toast: true,
          position: 'top-end',
          timer: 1500,
        });

        $('#tutup-modal-edit-user').trigger('click');
        $('#modal-edit-user form input[name=password]').val('');
        $('#tabel-daftar-user').DataTable().ajax.reload();
      },
      error: function(xhr) {
        $.each(xhr.responseJSON.errors, function (i, val) { 
          $(`#modal-edit-user form input[name=${i}]`).next('.text-error').text(val[0]);
          $(`#modal-edit-user form textarea[name=${i}]`).next('.text-error').text(val[0]);
        }); 
      }
    });
  });

  $(document).on('submit', '#modal-edit-superuser form', function (e) {
    e.preventDefault();

    let id = $(e.target).data('id');
    let url = route('update.superuser', {superuser: id});

    $.ajax({
      type: "put",
      url: url,
      data: $(e.target).serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#modal-edit-superuser form .text-error').text('');
      },
      success: function (res) {
        Swal.fire({
          icon: 'success',
          title: res.message,
          showConfirmButton: false,
          toast: true,
          position: 'top-end',
          timer: 1500,
        });

        $('#tutup-modal-edit-superuser').trigger('click');
        $('#modal-edit-superuser form input[name=password]').val('');
        $('#tabel-daftar-user').DataTable().ajax.reload();
      },
      error: function(xhr) {
        $.each(xhr.responseJSON.errors, function (i, val) { 
          $(`#modal-edit-superuser form input[name=${i}]`).next('.text-error').text(val[0]);
          $(`#modal-edit-superuser form textarea[name=${i}]`).next('.text-error').text(val[0]);
        }); 
      }
    });
  });

  $(document).on('click', '#btn-hapus-user', function (e) { 
    Swal.fire({
      icon: 'warning',
      title: 'Apakah anda yakin?',
      text: 'Data yang dihapus tidak dapat dikembalikan.',
      showCancelButton: true,
      cancelButtonText: 'Batal',
      confirmButtonText: 'Hapus',
    }).then((result) => {
      if(result.isConfirmed) {
        let id = $(e.target).data('id');
        let url = route('hapus.user', {user: id});

        $.ajax({
          type: "delete",
          url: url,
          dataType: "json",
          success: function (res) {
            Swal.fire({
              icon: 'success',
              title: res.message,
              showConfirmButton: false,
              toast: true,
              position: 'top-end',
              timer: 1500,
            });

            $('#tabel-daftar-user').DataTable().ajax.reload();
          }
        });
      }
    });
  });

});

window.addEventListener('DOMContentLoaded', (e) => {
  var modalTambahUser = new bootstrap.Modal(document.getElementById('modal-tambah-user'));
  var modalTambahSuperuser = new bootstrap.Modal(document.getElementById('modal-tambah-superuser'));

  modalTambahUser._element.addEventListener('show.bs.modal', function (e) {
    let textError = document.querySelectorAll('#modal-tambah-user form .text-error');

    textError.forEach((el) => {
      if(el.innerText.length > 0) {
        el.innerText = '';
      }
    });
  });

  modalTambahSuperuser._element.addEventListener('show.bs.modal', function (e) {
    let textError = document.querySelectorAll('#modal-tambah-superuser form .text-error');

    textError.forEach((el) => {
      if(el.innerText.length > 0) {
        el.innerText = '';
      }
    });
  });

});