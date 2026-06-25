<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Contact Details Section</h4> 
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
                        <li class="breadcrumb-item active">Contact Details Section</li>
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
                        <form method="post" action="{{ url('admin/edit-contact/'.$contact->id) }}" enctype="multipart/form-data" role="form" id="editBanner">@csrf 
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1" class="required">Location</label>
                                        <input type="text" name="location" class="form-control" id="title" value="{{ $contact->location }}" placeholder="Enter Location" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1" class="required">Address</label>
                                        <input type="text" name="address" class="form-control" id="title" value="{{ $contact->address }}" placeholder="Enter Address" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="exampleInputEmail1" class="required">Phone Number</label>
                                        <input type="number" name="phone" class="form-control" id="title" value="{{ $contact->phone }}" placeholder="Enter Phone Number" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1" class="required">Email</label>
                                        <input type="email" name="email" class="form-control" id="title" value="{{ $contact->email }}" placeholder="Enter Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary submit">
                                    <i class="fa fa-check-circle"></i> Update </button>
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
        $('#editBanner').validate({
            ignore: [],
            debug: false,
            rules: {
                title: {
                    required: true,
                },
                description: {
                    required: true,
                },
                image: {
                    required: false,
                    accept: 'png|jpg|jpeg',
                },
            },
            messages: {},
            submitHandler: function(form) {
                $(".submit").attr("disabled", true);
                $(".submit").html("<span class='fa fa-spinner fa-spin'></span> Please wait...");
                form.submit();
            }
        });
    });
</script>
@endsection
