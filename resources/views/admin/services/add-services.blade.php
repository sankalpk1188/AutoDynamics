<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')
<style>

    .radio-inputs {
      display: flex;
      /*justify-content: center;*/
      align-items: center;
      max-width: 100%;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .radio-inputs > * {
      margin: 6px;
    }

    .radio-input:checked + .radio-tile {
      border-color: #0c4b16;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      color: #0c4b16;
    }

    .radio-input:checked + .radio-tile:before {
      transform: scale(1);
      opacity: 1;
      background-color: #0c4b16;
      border-color: #0c4b16;
    }

    .radio-input:checked + .radio-tile .radio-icon svg {
      fill: #0c4b16;
    }

    .radio-input:checked + .radio-tile .radio-label {
      color: #0c4b16;
    }

    .radio-input:focus + .radio-tile {
      border-color: #0c4b16;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
    }

    .radio-input:focus + .radio-tile:before {
      transform: scale(1);
      opacity: 1;
    }

    .radio-tile {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 150px;
      min-height: 45px;
      border-radius: 0.5rem;
      border: 2px solid #b5bfd9;
      background-color: #fff;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      transition: 0.15s ease;
      cursor: pointer;
      position: relative;
    }

    .radio-tile:before {
      content: "";
      position: absolute;
      display: block;
      width: 0.75rem;
      height: 0.75rem;
      border: 2px solid #b5bfd9;
      background-color: #fff;
      border-radius: 50%;
      top: 0.25rem;
      left: 0.25rem;
      opacity: 0;
      transform: scale(0);
      transition: 0.25s ease;
    }

    .radio-tile:hover {
      border-color: #0c4b16;
    }

    .radio-tile:hover:before {
      transform: scale(1);
      opacity: 1;
    }

    .radio-icon svg {
      width: 2rem;
      height: 2rem;
      fill: #494949;
    }

    .radio-label {
      color: #707070;
      transition: 0.375s ease;
      text-align: center;
      font-size: 13px;
    }

    .radio-input {
      clip: rect(0 0 0 0);
      -webkit-clip-path: inset(100%);
      clip-path: inset(100%);
      height: 1px;
      overflow: hidden;
      position: absolute;
      white-space: nowrap;
      width: 1px!important;
    }
    
    @media (max-width: 576px) {
        .radio-inputs {
            flex-direction: column;
            align-items: start;
        }
        .radio-inputs label {
            flex: 1 1 calc(50% - 10px); 
        }
    }
</style>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <form method="POST" action="{{ url('admin/add-services') }}" enctype="multipart/form-data" id="bannerForm" name="bannerForm">@csrf
                <div class="card-body">
                    <div class="form-group col-md-8">
                        <label class="control-label required"> Select Category  :</label>
                        <div class="controls">
                            <select class="form-control select2 aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                @foreach ($category as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @foreach ($category->childrenCategory as $childCategory)
                                @include('admin.services.child_category', ['child_category' => $childCategory])
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-8">
                        <label class="">Select Image</label><br>
                        <input type="file" class="form-control" name="image" accept=".jpeg,.jpg,.png">
                           <small>Upload only jpeg jpg and png files(Image size 535x535px)</small>
                           <small>Note: Upload Only jpeg jpg and png images</small>
                    </div>
                        
                    <div class="form-group col-md-8">
                        <label class="">Name</label>
                        <input type="text" class="form-control" name="name" id="title"   />
                      <!--   <textarea  id="description" name="description" required ></textarea> -->
                    </div>
                    <div class="form-group col-md-8">
                        <label class="">Type</label>
                        <input type="text" class="form-control" name="type" id="title"   />
                      <!--   <textarea  id="description" name="description" required ></textarea> -->
                    </div>
                    <div class="form-group col-md-8">
                        <label class="">Pack Size</label>
                        <input type="text" class="form-control" name="size" id="title"   />
                      <!--   <textarea  id="description" name="description" required ></textarea> -->
                    </div>
                    <div class="form-group col-md-8">
                        <label>Description</label>
                        <textarea type="text" class="form-control summernote" name="description" id="title"></textarea>
                      <!--   <textarea  id="description" name="description" required ></textarea> -->
                    </div>
                    <div class="form-group col-md-8">
                        <label>Specifications / Features</label>
                        <textarea type="text" class="form-control summernote" name="additional" id="title"  ></textarea>
                      <!--   <textarea  id="description" name="description" required ></textarea> -->
                    </div>
                    <!--<div class="form-group col-md-8">-->
                    <!--    <label class="control-label">Select Season :</label>-->
                    <!--    <div class="controls">-->
                    <!--        <select class="form-control select2 aiz-selectpicker" name="season[]" id="season" multiple data-live-search="true">-->
                    <!--            <option value="Summer">Summer</option>-->
                    <!--            <option value="Rabi">Rabi</option>-->
                    <!--            <option value="Kharif">Kharif</option>-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="radio-inputs">
                        <label>
                            <input checked class="radio-input" type="checkbox" name="season[]" value="Summer">
                            <span class="radio-tile">
                                <span class="radio-label">Summer</span>
                            </span>
                        </label>
                        <label>
                            <input class="radio-input" type="checkbox" name="season[]" value="Rabi">
                            <span class="radio-tile">
                                <span class="radio-label">Rabi</span>
                            </span>
                        </label>
                        <label>
                            <input class="radio-input" type="checkbox" name="season[]" value="Kharif">
                            <span class="radio-tile">
                                <span class="radio-label">Kharif</span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="card-footer">
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
                name1:{
                    required:true,
                    minlength: 5,
                    maxlength: 40,
                },
                category_id:{
                    required:true,
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
                additional:{
                    required:false,
                },
                image1: {
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
