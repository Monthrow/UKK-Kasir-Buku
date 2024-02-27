
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
    <title>Register</title>
    <!-- CSS files -->
    <link href="/vendor/admin/dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/demo.min.css?1692870487" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column" style="background: url('/vendor/admin/dist/img/bg-perpus.jpg') center center fixed; background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
    <script src="/vendor/admin/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark" style="color:white;">
            <h1>
              <img src="https://e7.pngegg.com/pngimages/350/392/png-clipart-logo-bruntcliffe-academy-book-book-blue-angle.png" width="110" height="32" class="navbar-brand-image">
              <span>Kasir Progress</span>
            </h1>
          </a>
        </div>
        <form class="card card-md" action="/register/do" method="POST" autocomplete="off" novalidate style="background-color: rgba(255, 255, 255, 0.0);">
          @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4" style="color:white;">Buat Akun</h2>
            <div class="form-group">
                            <label for="" style="color:white;"><b>Nama Lengkap</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama Lengkap">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" style="color:white;"><b>Email</b></label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" 
                            placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label text-info"for="Level" style="color:white;"><b>Level</b></label>
                            @if($user->where('level','Admin')->count() == 0)
                            <input type="text" class="form-control" name="level" value="Admin" readonly>
                            @endif
                            @if($user->where('level','Admin')->count() > 0)
                            <input type="text" class="form-control" name="level" value="Kasir" readonly>
                            @endif
                            
                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="" style="color:white;"><b>Password</b></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" 
                            placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" style="color:white;"><b>Konfirmasi Password</b></label>
                            <input type="password" class="form-control @error('re_password') is-invalid @enderror" name="re_password" 
                            placeholder="Password">
                            @error('re_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Buat Akun Baru</button>
            </div>
          </div>
        </form>
        <div class="text-center text-light mt-3">
          Sudah Punya Akun? <a href="/login" tabindex="-1" style="color:#3285a8;">Login</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/vendor/admin/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/vendor/admin/dist/js/demo.min.js?1692870487" defer></script>
  </body>
</html>