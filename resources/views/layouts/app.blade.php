<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @routes
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <title>Sistem Informasi Magang</title>
  
</head>

<body>

  <div class="d-flex position-relative">
    {{-- sidebar --}}
    <div id="sidebar" class="position-fixed position-md-sticky start-0 top-0 vh-100 z-3 bg-white shadow-sm translate-x-md-0 translate-nx-100 transition-all">
      <div class="fs-4 p-4 text-white text-center border border-bottom-0 border-start-0 border-end-0  border-5 border-primary">
        E-Magang
      </div>

      <div class="px-4 py-3 mb-3 text-center d-flex text-white align-items-center gap-3 border border-top-0 border-start-0 border-end-0  border-2 border-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
        <div class="fw-medium">
          Hi, <span class="text-capitalize">{{ auth('superuser')->user()->username ?? auth('web')->user()->username }}</span>
        </div>
      </div>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <i class="fs-4 bi bi-speedometer2"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="{{ route('edit.profil', [auth('superuser')->id() ?? auth('web')->id()]) }}">
            <i class="fs-4 bi bi-person-fill-gear"></i>
            <span>Profil</span>
          </a>
        </li>
        @auth('web')
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="{{ route('presensi') }}">
          <i class="fs-4 bi bi-calendar2-check"></i>
            <span>Presensi</span>
          </a>
        </li>
        @endauth
        @auth('superuser')
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="{{ route('daftar.user') }}">
            <i class="fs-4 bi bi-person-fill-gear"></i>
            <span>Daftar User</span>
          </a>
        </li>
        @endauth
      </ul>
    </div>
    {{-- /sidebar --}}

    {{-- main --}}
    <div class="overflow-x-hidden w-100 position-relative">
      {{-- header --}}
      <div class="p-3 p-sm-2 bg-white d-flex justify-content-between justify-content-md-end shadow-sm ">
        <i id="icon-list" class="fs-3 bi bi-list cursor-pointer d-md-none"></i>
        <i id="logout" class="fs-3 bi bi-box-arrow-right cursor-pointer" data-id="{{ auth('web')->id() }}"></i>
      </div>
      {{-- /header --}}
  
      {{-- content --}}
      <div class="content p-2 p-sm-3 p-md-4">
        @yield('content')
      </div>
      {{-- /content --}}
    </div>
    {{-- /main --}}
  </div>


  @include('sweetalert::alert')
</body>

</html>