@extends('layouts\frontLayout\front_design') 
@section('content')

<div class="container login-container">
    <div class="row d-flex justify-content-center mt--40">
    	<div class="col-md-6 col-sm-12">
            <div class="">
                <div class="text-center"><h3><i class="fa fa-lock fa-4x"></i></h3></div>
              	@if(Session::has('flash_message_error'))			
				<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <strong>{!! session('flash_message_error') !!}</strong>
                    <button type="button" class="close float-end" data-bs-dismiss="alert" aria-label="Close">
				       <span aria-hidden="true">&times;</span>
				   </button>
				</div>
				@endif  			
				@if(Session::has('flash_message_success'))			
				<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <strong>{!! session('flash_message_success') !!}</strong>
                    <button type="button" class="close float-end" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
				    </button>
				</div>
			    @endif
                <h3 class="text-center mt-4 color-brand-1">Reset Password</h3>
                <p class="mt-4 color-brand-1">You can reset your password here.</p>
                <div class="panel-body">    
                    <form action="{{ url('/reset-password') }}" id="resetPass" class="form" method="post">{{ csrf_field() }}   
                        <div class="form-group mt-4">
                            <label class="d-block required color-brand-1">Email Address</label>
                            <input name="email" placeholder="Email Address" class="form-control" type="email">
                        </div>
                        <div class="form-group mt-4">
                            <label class="d-block required color-brand-1">OTP</label>
                            <input name="otp" placeholder="Email OTP" class="form-control" type="number">
                        </div>
                        <div class="form-group mt-4">
                            <label class="d-block required color-brand-1"> New Password</label>
                            <input name="password" id="newpassword" placeholder="Email New Password" class="form-control" type="password">
                        </div>
                        <div class="form-group mt-4">
                            <label class="d-block required color-brand-1">Confirm Password</label>
                            <input name="confirm_password" placeholder="Email Confirm Password" class="form-control" type="password">
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <button type="submit" class="btn btn-brand-1 hover-up w-100" id="chngpass">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection