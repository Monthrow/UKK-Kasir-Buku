
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
    <title>Login</title>
    <!-- CSS files -->
    <link href="/vendor/admin/dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/demo.min.css?1692870487" rel="stylesheet"/>
  
  </head>
  <body  class=" d-flex flex-column">
    <script src="/vendor/admin/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <h1>
            <span class="brand-text font-weight-light">KASIR Progress</span>
          </h1>
        </div>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="login-box-msg text-center mb-4">Login to your account</h2>

              @if (session()->has('loginError'))
              <div class="alert alert-danger">{{ session('loginError')}}</div>
              @endif

            <form action="/login/do" method="post">
              @csrf
              <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                placeholder="Email">
                <div class="input-group-append">
                  
                </div>
                @error('email')
                <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror

              </div>

              <span class="form-label-description">
                <a href="#">I forgot password</a>
              </span>
              <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" 
                placeholder="Password">
                <div class="input-group-append">
                  
                </div>

                @error('password')
                <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror

              </div>

              <button type="submit" class="btn btn-primary w-100">Sign in</button>

      </form>

          </div>
          
        </div>
        <div class="text-center text-secondary mt-3">
          Don't have account yet? <a href="/admin/user/create" tabindex="-1">Sign up</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/vendor/admin/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="/vendor/admin/dist/js/demo.min.js?1692870487" defer></script>
  </body>
</html>