@extends('layouts/frontLayout/front_design')
@section('content')
<style>
	.form-gap {
    padding-top: 70px;    
}
@media only screen and (min-width: 600px) {
  .respo {
    margin-left: 25%;
  }
}
</style>
<div class="container login-container">

    <div class="row respo" style="margin-top: 120px;">
    	<div class="col-md-8 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  	@if(Session::has('flash_message_error'))			
    					<div class="alert alert-danger alert-dismissible fade show" role="alert">
    					  <strong>{!! session('flash_message_error') !!}</strong>
    					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    					    <span aria-hidden="true">&times;</span>
    					  </button>
    					</div>
    					@endif  			
    					@if(Session::has('flash_message_success'))			
    					<div class="alert alert-success alert-dismissible fade show" role="alert">
    					  <strong>{!! session('flash_message_success') !!}</strong>
    					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    					    <span aria-hidden="true">&times;</span>
    					  </button>
    					</div>
    				@endif
                  <h2 class="text-center">Forgot Password?</h2>
                  <p class="pt-2">You can reset your password here, Please enter registered email.</p>
                  <div class="panel-body">
    
                    <form action="{{ url('/forgot-password') }}" id="forgetPassword" role="form" autocomplete="off" class="form" method="post">
                      {{ csrf_field() }}   
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="Email Address" class="form-control" type="email" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-lg btn-danger btn-block" value="Reset Password">
                      </div>
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div></center>
</div>

@endsection