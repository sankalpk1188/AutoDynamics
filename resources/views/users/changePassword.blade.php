@extends('layouts/adminLayout/admin_design')
@section('content')
 <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger" role="alert">
                      <strong>{!! session('flash_message_error') !!}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @if(Session::has('flash_message_success'))          
                    <div class="alert alert-success alert-success" role="alert">
                      <strong>{!! session('flash_message_success') !!}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif 
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3><br>
                        </div> 
                        <form  method="post" action="{{ url('/changePassword') }}" >@csrf
                            <div class="row wow fadeIn p-4">
                                <div class="input-box col-lg-8">
                                    <label class="label-text">Old Password</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="password" name="current_pwd" placeholder="Old Password" required>
                                        <span class="la la-lock input-icon"></span>
                                    </div>
                                </div><!-- end input-box -->
                                <div class="input-box col-lg-8">
                                    <label class="label-text">New Password</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="password" name="new_password" placeholder="New Password" required>
                                        <span class="la la-lock input-icon"></span>
                                    </div>
                                </div><!-- end input-box -->
                                <div class="input-box col-lg-8">
                                    <label class="label-text">Confirm New Password</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="password" name="re_password" placeholder="Confirm New Password" required>
                                        <span class="la la-lock input-icon"></span>
                                    </div>
                                </div><!-- end input-box -->
                                <div class="input-box col-lg-12 py-2">
                                    <button class="btn btn-primary"  type="submit" value="Update Password" id="changepwd">Change Password</button>
                                </div><!-- end input-box -->                                       
                            </div>         
                            <div class="spacer-30"></div>
                            <!-- <input type="submit" id="signup" class="btn-main" value="Update Password"> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $("#show-oldpass").click(function() {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if(input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });
</script>
<script>
    $("#show-newpass").click(function() {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if(input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });
</script>
<script>
    $("#show-repass").click(function() {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if(input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });
</script>
@endsection