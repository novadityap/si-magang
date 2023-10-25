$(document).on('click', '#btn-hapus-profil', function (e) {
  Swal.fire({
    icon: 'warning',
    title: 'Apakah Anda yakin?',
    text: 'Akun Anda akan terhapus termasuk semua data Anda',
    showConfirmButton: true,
    showCancelButton: true,
  }).then((result) => {
    if(result.isConfirmed) {
      let id = $(e.target).data('id');
      let url = route('hapus.profil', id);

      $.ajax({
        type: "delete",
        url: url,
        success: function(xhr) {
          location.href = route('login');
        }
      });
    }
  });
});