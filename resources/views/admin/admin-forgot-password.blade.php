<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('plugins/backend_plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/backend_plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/backend_css/adminlte.min.css') }}">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/frontend_images/logo/favicon.png') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">.error{color:red; font-size: 14px;}</style>
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset('images/frontend_images/banner/products.jpg') }}');">
<div class="login-box" style="width: 480px;">

  <div class="card">

    <div class="card-body login-card-body">
      @if(Session::has('flash_message_error'))
<div class="alert alert-dismissible fade show respo mt-1" role="alert" style="background-color: #007bff;">
  <p style="color:#fff;">{!! session('flash_message_error') !!}</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has('flash_message_success'))          
      <div class="alert alert-dismissible fade show respo mt-1" role="alert" style="background-color: #007bff;">
        <p style="color:#fff;">{!! session('flash_message_success') !!}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><br>
@endif
       <h3 class="login-box-msg" style="color: #000;">Reset Your Password</h3>
      <form action="{{ url('admin-reset-password') }}" id="adminPasswordReset" method="post">
        @csrf
 
          <center>
        <div class="col-md-8 form-group ">
          <label>Enter your email address <span style="color:red">*</span></label>
          <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div></center>
          <p class="d-flex justify-content-center">Password will be sent to your registered email address</p>
        <div class="row d-flex justify-content-center">
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
          </div>
        </div>
      </form>
       <p class="mb-1 d-flex justify-content-center mt-2">
        <a href="{{ url('admin-login') }}">Back to login</a>
      </p>
    </div>
  </div>
</div>

<script src="{{ asset('plugins/backend_plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/backend_plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/backend_js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/frontend_js/main.js') }}"></script>
<script src="{{ asset('js/frontend_js/jquery.validate.js') }}"></script>
</body>
</html>
