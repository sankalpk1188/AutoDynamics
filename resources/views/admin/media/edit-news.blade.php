<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>News Section</h1>
            @if ($errors->any())
          <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $errors->first() }}</strong>
          </div>
      @endif
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
              <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">News Section</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Edit News</h3>
              </div>
              <form method="post" action="{{ url('admin/edit-news/'.$newsviews->id) }}" enctype="multipart/form-data" role="form" id="editNews">
                 {{ csrf_field() }}

                <div class="card-body"> 
                  <div class="row">
                    
                    <div class="form-group col-md-12">
                      <label for="exampleInputEmail1" class="required">Title</label>
                      <input type="text" name="title" class="form-control" id="title" value="{{ $newsviews->title }}" placeholder="Enter Title" required>
                    </div>

                    <div class="form-group col-md-12">
                      <label class="required">Category</label>
                      <input type="text" name="category" class="form-control" value="{{ $newsviews->category ?? '' }}" placeholder="Enter Category">
                    </div>

                    <div class="form-group col-md-12">
                      <label class="required">Date</label>
                      <input type="date" name="date" class="form-control" value="{{ !empty($newsviews->date) ? date('Y-m-d', strtotime($newsviews->date)) : '' }}">
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group col-md-12">
                        <label class="required">Description</label>
                        <small>(Note: Text maximum length should be 100 words)</small>
                        <textarea name="description" class="textarea form-control" placeholder="Enter Description" valve="{!! $newsviews->description !!}" required>{!! $newsviews->description !!}</textarea>
                        <!--<textarea type="text" name="description" class="textarea form-control" placeholder="Enter Description"  required ></textarea>-->
                    </div>  
                  </div>

                  <div class="form-group col-md-12">
                        <label for="exampleInputEmail1" class="required">Image</label>
                        @if(!empty($newsviews->image))
                        <input type="hidden" name="current_image" value="{{ $newsviews->image }}">
                        @endif
                        <small>(Note: Banner size should be less than 500KB)</small>
                        <input type="file" name="image" class="form-control" id="image" value="{{ $newsviews->image }}">
                        <img style="width: 15%;" src="{{ asset('assets/images/news/'.$newsviews->image) }}" alt="">
                  </div>

                  <div class="form-group col-md-12">
                    <label class="required">Status</label>
                    <select name="status" class="form-control">
                      <option value="1" {{ (isset($newsviews->status) && (int)$newsviews->status === 1) ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ (isset($newsviews->status) && (int)$newsviews->status === 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
            </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
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
        $('#editNews').validate({
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
                form.submit();
            }
        });
    });
</script>
@endsection
