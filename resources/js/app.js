import './bootstrap';
import './profil';
import './user';


$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click', '#icon-list', function () {
    $('#sidebar').removeClass('translate-nx-100').addClass('translate-x-0');
  });

  $(document).on('click', function (e) {
    let sidebar = $('#sidebar');
    let iconList = $('#icon-list');

    if(!sidebar.is(e.target) && sidebar.has(e.target).length == 0 && !iconList.is(e.target) && iconList.has(e.target).length == 0) {
        sidebar.removeClass('translate-x-0').addClass('translate-nx-100');
    }
  });

  // logout
  $(document).on('click', '#logout', function (e) {
    location.replace(route('logout'));
  });
});