<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @routes
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <title>Sistem Informasi Magang</title>
</head>

<body>
  <div class="container">
    <div class="row min-vh-100">
      <div class="m-auto col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card pt-4 pb-2">
          <div class="card-title text-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" fill="currentColor" class="text-primary bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
            <div class="fs-4 fw-medium text-center mt-3">
              Selamat Datang
            </div>
            @if(session()->has('error'))
              <div class="alert alert-danger mx-3 mt-3 mb-0 p-2">
                <i class="fs-4 me-2 bi bi-exclamation-triangle"></i>
                {{ session('error') }}
              </div>
            @endif
            @if(session('status'))
              <div class="alert alert-success mx-3 mt-3 mb-0 p-2">
              {{ session('status') }}
              </div>
            @endif
            @if(session('success'))
              <div class="alert alert-success mx-3 mt-3 mb-0 p-2">
              {{ session('success') }}
              </div>
            @endif
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('proses.login') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                @error('email') <span class=" text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                @error('password') <span class="  text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="d-flex justify-content-between">
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <div class="mb-3 form-check">
                  <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa kata sandi?</a>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>