@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Notifications Section</h4> 
                    @if(Session::has('flash_message_error')) 
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div> 
                    @endif 
                    @if(Session::has('flash_message_success')) 
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div> 
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Notifications Section</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <form method="POST" action="{{ url('admin/add-notifications') }}" enctype="multipart/form-data" id="addBanner">@csrf <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-group col-md-12">
                                        <label class="required">Title</label>
                                        <input name="title" class="form-control" placeholder="Enter Title" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group col-md-12">
                                        <label>Url</label>
                                        <input name="url" class="form-control" placeholder="Enter Url" >
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary submit">
                                    <i class="fa fa-check-circle"></i> Add </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('backend_plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#addBanner').validate({
            ignore: [],
            debug: false,
            rules: {
                content: {
                    required: true,
                },
                title: {
                    required: true,
                    maxlength: 100,
                },
                description: {
                    required: true,
                    maxlength: 165,
                },
                image: {
                    required: true,
                    accept: 'png|jpg|jpeg|svg',
                },
                
            },
            messages: {
                title: {
                    required: "Please enter no more than 100 characters.",   
                },
                description: {
                    required: "Please enter no more than 165 characters.",   
                },
            },
            submitHandler: function(form) {
                $(".submit").attr("disabled", true);
                $(".submit").html("<span class='fa fa-spinner fa-spin'></span> Please wait...");
                form.submit();
            }
        });
    });
</script>
@endsection