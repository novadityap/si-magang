$(function () {
  $(document).on('click', '#btn-edit-waktu', function (e) {
    let id = $(e.target).data('id');

    $.ajax({
      type: "get",
      url: route('edit.waktu', {waktu: id}),
      data: "data",
      dataType: "json",
      success: function (res) {
        $('#modal-edit-waktu form input[name=hari]').val(res.data.hari);
        $('#modal-edit-waktu form input[name=buka]').val(res.data.buka);
        $('#modal-edit-waktu form input[name=tutup]').val(res.data.tutup);
        $('#modal-edit-waktu form').data('id', id);
      }
    });
  });

  $(document).on('submit', '#modal-edit-waktu form', function (e) {
    e.preventDefault();
    let id = $(e.target).data('id');

    $.ajax({
      type: "put",
      url: route('update.waktu', {waktu: id}),
      data: $(e.target).serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#modal-edit-waktu form .text-error').text('');
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

        $('#tutup-modal-edit-waktu').trigger('click');
        location.reload();
      },
      error: function(xhr) {
        $.each(xhr.responseJSON.errors, function (i, val) { 
          $(`#modal-edit-waktu form input[name=${i}]`).next('.text-error').text(val[0]);
        }); 
      }
    });
  });

});