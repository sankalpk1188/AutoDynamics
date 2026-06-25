<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    @if(Session::has('flash_message_error'))
          <div class="alert alert-error alert-block">
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Category Section</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Add Section</h3>
            <!--     <a href="{{ url('/admin/view-product') }}"><button style="float: right; margin: 3px 3px;background:#2f2f86;" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View Section</button></a> -->
              </div>

                 <form method="POST" action="{{ url('admin/add-category') }}" enctype="multipart/form-data" id="bannerForm" name="bannerForm">@csrf
                <div class="card-body">
                  <div class="form-group col-md-10">
                    <label class="control-label"> Add Category:</label>
                    <div class="controls">
                        <input type="text" class="form-control" name="title" id="category_name"  required />
                    </div>
                  </div>
                  <div class="form-group col-md-10">
                    <label class="control-label"> Description</label>
                    <div class="controls">
                        <textarea type="text" class="textarea form-control" name="description"></textarea>
                    </div>
                  </div>
                 
                <div class="card-footer ">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
            
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

    <script src="{{ asset('plugins/backend_plugins/jquery/jquery.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        $("[name='bannerForm']").validate({
            ignore: [],
            debug: false,
            rules: {
                name:{
                    required:true,
                    minlength: 5,
                    maxlength: 40,
                },
                title:{
                    required:true,
                    minlength: 5,
                    maxlength: 40,
                },
                 namehindi:{
                    required:true,
                    minlength: 5,
                    maxlength: 40,
                },
                titlehindi:{
                    required:true,
                    minlength: 5,
                    maxlength: 40,
                },
                image: {
                    required: true,
                    accept: 'jpg|jpeg|png',
                },
            },
            messages: {
                image: {
                    accept: 'Please choose valid image',
                },
            }
        });

    });
</script>
@endsection
