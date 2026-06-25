@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Banner Section</h4>
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
                        <li class="breadcrumb-item active">Banner Section</li>
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
                        <form method="post" action="{{ url('admin/edit-banner/'.$banner->id) }}" enctype="multipart/form-data" role="form" id="editBanner">@csrf
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1" class="required">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ $banner->title }}" placeholder="Enter Title" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                            <label class="required">Description</label>
                                            <textarea name="description" class="textarea form-control" placeholder="Enter Description" valve="{!! $banner->description !!}" required>{!! $banner->description !!}</textarea>
                                        </div>  
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1">Image <small>(Size: 1350x500px) | </small></label>
                                        @if(!empty($banner->image))
                                        <input type="hidden" name="current_image" value="{{ $banner->image }}">
                                        @endif
                                        <small>(Note: Banner size should be less than 500KB)</small>
                                        <input type="file" name="image" class="form-control p-1" id="image" value="{{ $banner->image }}">
                                        <img style="width: 15%;" class="mt-2" src="{{ asset('assets/imgs/banner/'.$banner->image) }}" alt="">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" @if($banner->status == 1) checked @endif >
                                            <label class="form-check-label" for="status">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary submit"><i class="fa fa-check-circle"></i> Update</button>
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
