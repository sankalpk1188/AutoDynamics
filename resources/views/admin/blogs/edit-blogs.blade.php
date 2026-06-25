@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blogs Section</h1>
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
                      <li class="breadcrumb-item active">Blogs Section</li>
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
                            <h3 class="card-title">Edit Blog</h3>
                        </div>
                        <form method="post" action="{{ url('admin/edit-blogs/'.$blogs->id) }}" enctype="multipart/form-data" role="form" id="editBanner">@csrf
                            <div class="card-body"> 
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="required">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ $blogs->title }}" placeholder="Enter Title" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="required">Category / Tag</label>
                                        <input type="text" name="category" class="form-control" value="{{ $blogs->category }}" placeholder="e.g. Technology, Industry Insights" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="required">Description</label>
                                        <textarea name="description" class="textarea form-control summernote" placeholder="Enter Description" required>{!! $blogs->description !!}</textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="required">Date</label>
                                        <input type="date" name="date" class="form-control" id="date" value="{{ $blogs->date }}" placeholder="Enter Date" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="">Image</label>
                                        @if(!empty($blogs->image))
                                        <input type="hidden" name="current_image" value="{{ $blogs->image }}">
                                        @endif
                                        <input type="file" name="image" class="form-control p-1" id="image" value="{{ $blogs->image }}">
                                        <img class="mt-2" style="height: 70px;" src="{{ asset('assets/images/blogs/'.$blogs->image) }}" alt="">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" @if($blogs->status == 1) checked @endif >
                                            <label class="form-check-label" for="status">Publish</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update</button>
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
                    maxlength: 1000,
                    sanitizeip: true,
                },
                description: {
                    required: true,
                    maxlength: 100000,
                    sanitizeip: true,
                },
                author: {
                    required: true,
                    maxlength: 50,
                    sanitizeip: true,
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