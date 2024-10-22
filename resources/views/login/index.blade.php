<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; SIMPEG</title>
  <link rel="icon" href="/img/logo1.png">
  <!-- General CSS Files -->

  <link rel="stylesheet" href="/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="/template/assets/css/style.css">
  <link rel="stylesheet" href="/template/assets/css/components.css">
</head>

<body>
<div id="app">
<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="/img/logo1.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login SIMPEG</h4></div>
              <div class="card-body">
        @if (session()->has('loginError'))
       <div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        {{ session('loginError') }}
                      </div>
                    </div>
         @endif
                <form method="POST" action="/login" class="needs-validation" novalidate="">
              @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required oninput="toggleShowPasswordButton('password')">
                     <button type="button" id="showPassword" class="btn badge badge-light  toggle-password mt-2" style="display: none;" onclick="togglePasswordVisibility('password')"><i class="fas fa-eye"></i></button>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }} >
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                    <div class="mb-3">

       {!! NoCaptcha::renderJs() !!}
     {!! NoCaptcha::display() !!}
      @error('g-recaptcha-response')
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Asep Ripa'i {{ date('Y') }}
            </div>
          </div>
        </div>
      </div>
    </section>
   </div>
    <!-- General JS Scripts -->
  <script src="/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- JS Libraies -->

  <!-- Template JS File -->
   <script src="/template/assets/js/scripts.js"></script>
  <script src="/template/assets/js/custom.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>


  <!-- Page Specific JS File -->
</body>
</html>
