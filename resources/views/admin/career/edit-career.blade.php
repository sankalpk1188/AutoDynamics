<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Career Section</h4> 
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
                        <li class="breadcrumb-item active">Career Section</li>
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
                        <form method="post" action="{{ url('admin/edit-career/'.$career->id) }}" enctype="multipart/form-data" role="form" id="editBanner">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1" class="required">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ $career->title }}" placeholder="Enter Title" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label class="required">Description</label>
                                            <small>(Note: Text maximum length should be 100 words)</small>
                                            <textarea name="description" class="textarea form-control" placeholder="Enter Description" valve="{!! $career->description !!}" required>{!! $career->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1">Image <small>(Size: 55x50px) | </small></label> @if(!empty($career->image)) <input type="hidden" name="current_image" value="{{ $career->image }}"> @endif <small>(Note: Image size should be less than 500KB)</small>
                                        <input type="file" name="image" class="form-control p-1" id="image" value="{{ $career->image }}">
                                        <img style="width: 15%;" class="mt-2" src="{{ asset('assets/imgs/career/'.$career->image) }}" alt="">
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
