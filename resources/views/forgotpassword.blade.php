@extends('layouts/frontLayout/front_design') 
@section('content')

<div class="container login-container">
    <div class="row d-flex justify-content-center mt--40">
    	<div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3 class="mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" height="150px" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                            </svg>
                        </h3>
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
                        <h3 class="text-center pt-3 color-brand-1">Forgot Password?</h3>
                        <p class="pt-3">You can reset your password here, Please enter registered email.</p>
                        <div class="panel-body">    
                            <form action="{{ url('/forgot-password') }}" id="register-form" role="form" autocomplete="off" class="form" method="post">{{ csrf_field() }}   
                                <div class="form-group mt-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="Email Address" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-4">
                                    <button type="submit" class="btn btn-brand-1 hover-up w-100">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    </div>
</div>

@endsection