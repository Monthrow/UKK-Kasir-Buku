
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Lupa Password</title>
    <!-- CSS files -->
    <link href="/vendor/admin/dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/demo.min.css?1692870487" rel="stylesheet"/>
  
  </head>
  <body  class=" d-flex flex-column" style="background: url('/vendor/admin/dist/img/bg-perpus.jpg') center center fixed; background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">>
    <script src="/vendor/admin/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <h1>
          <img src="https://e7.pngegg.com/pngimages/350/392/png-clipart-logo-bruntcliffe-academy-book-book-blue-angle.png" width="110" height="32" class="navbar-brand-image">
            <span class="brand-text font-weight-light" style="color:white;">KASIR Progress</span>
          </h1>
        </div>
        <div class="card card-md" style="background-color: rgba(255, 255, 255, 0.0);">
          <div class="card-body">
            <h2 class="login-box-msg text-center mb-4" style="color:white;">Masukkan Password Baru</h2>

            <form action="{{ route ('password.update') }}" method="post">
              @csrf
              <input type="hidden" name="token" value="{{ request()->token }}">
              <input type="hidden" name="email" value="{{ request()->email }}">
              <div class="form-group">
                            <label for="" style="color:white;"><b>Password</b></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" 
                            placeholder="Password" id="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" style="color:white;"><b>Konfirmasi Password</b></label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" 
                            placeholder="Password" id="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

              <button type="submit" class="btn btn-primary w-100">Submit</button>

      </form>
      
        
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/vendor/admin/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/vendor/admin/dist/js/demo.min.js?1692870487" defer></script>
  </body>
</html>