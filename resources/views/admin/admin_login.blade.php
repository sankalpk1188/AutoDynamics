<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login to Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('backend_plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('backend_plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/frontend_images/logo/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('backend_css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset('assets/img/summer_banner.png') }}'); ">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
     
        @if(Session::has('flash_message_error'))            
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong style="color: red;">{!! session('flash_message_error') !!}</strong>
        </div>
        @endif
        @if(Session::has('flash_message_success'))            
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong style="color: white;">{!! session('flash_message_success') !!}</strong>
        </div>
        @endif

        <h3 class="login-box-msg" style="color: #000;">Admin Panel</h3>
            <form action="{{ url('admin-login-check') }}" method="post">@csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            {{-- <p class="mb-1 d-flex justify-content-center mt-2">
                <a href="{{ url('forgot-password') }}">I forgot my password</a>
            </p> --}} 
        </div>
    </div>
</div>

<script src="{{ asset('backend_plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend_plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend_js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>

</body>
</html>
