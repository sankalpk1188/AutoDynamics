<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')
  <div class="content-wrapper">
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
            <h1>Product Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Product Section</li>
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
              <div class="card-header">
                <h3 class="card-title">Edit Section</h3>
         <!--        <a href="{{ url('/admin/view-crop') }}"><button style="float: right; margin: 3px 3px;background:#2f2f86" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View Section</button></a> -->
              </div>
              <form method="post" action="{{ url('admin/edit-services/'.$services->id) }}" enctype="multipart/form-data" role="form"  >
                 {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group col-md-8">
                        <label for="current_image">Previous Services Image</label>
                          <br>
                          @if(!empty($services->image))
                            <input type="hidden" name="current_image" value="{{$services->image}}"> 
                          @endif

                          @if(!empty($services->image))
                          <img style="height: 40%; width: 40%;" src="{{ asset('assets/img/products/'.$services->image) }}">
                          @endif
                          <br><br>
                          <label for="current_image">Select New Image </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" id="exampleInputFile" accept=".jpeg,.jpg,.png">
                      </div>
                    </div>
                        <small>Upload only jpeg jpg and png files(Image size 535x535px)</small>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="name" class="required">Product name</label>
                         <input type="text" name="name" class="form-control" id="link" value="{{ $services->name }}" placeholder="Enter  Name"  >
                    </div>
                    <div class="form-group col-md-8">
                        <label for="name" class="required">Type</label>
                         <input type="text" name="type" class="form-control" id="link" value="{{ $services->type }}" placeholder="Enter Type"  >
                    </div>
                    <div class="form-group col-md-8">
                        <label for="name" class="required">Pack Size</label>
                         <input type="text" name="size" class="form-control" id="link" value="{{ $services->size }}" placeholder="Enter Pack Size"  >
                    </div>
                    <div class="form-group col-md-8">
                        <label for="name">Description </label>
                        <textarea type="text" name="description" class="summernote form-control" id="link"  placeholder="Enter Description">{{ $services->description }}</textarea>
                         {{-- <textarea type="text" name="description" class="form-control textarea" id="link" value="{{ $services->description }}" placeholder="Enter Description"></textarea>   --}}
                    </div>
                    <div class="form-group col-md-8">
                        <label for="name" class="required">Specifications / Features</label>
                        <textarea type="text" name="additional" class="summernote form-control" id="link"  placeholder="Enter Additional">{{ $services->additional }}</textarea>
                    </div>
                    <div class="form-group col-md-8">
                        <label class="control-label">Select Season :</label>
                        <div class="controls">
                            <select class="form-control select2 aiz-selectpicker" name="season[]" id="season" multiple data-live-search="true">
                                @php
                                    $selectedSeasons = explode(',', $services->season); 
                                @endphp
                                <option value="Summer" {{ in_array('Summer', $selectedSeasons) ? 'selected' : '' }}>Summer</option>
                                <option value="Rabi" {{ in_array('Rabi', $selectedSeasons) ? 'selected' : '' }}>Rabi</option>
                                <option value="Kharif" {{ in_array('Kharif', $selectedSeasons) ? 'selected' : '' }}>Kharif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                  <button type="submit" class="btn btn-primary">Update</button>
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
        $("[name='editbannerForm']").validate({
            ignore: [],
            debug: false,
            rules: {
                title:{
                    required:true,
                },
                descriptions:{
                    required:true,
                    minlength: ,
                    maxlength: ,
                },
                 descriptionhindi:{
                    required:true,
                },
                titlehindi:{
                    required:true,
                    minlength:,
                    maxlength: ,
                },
                image: {
                    accept: 'jpg|png|jpeg',
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
