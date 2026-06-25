@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
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
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Gallery Section</li>
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
                        <form method="POST" action="{{ url('admin/edit-gallery/'.$gallery->id) }}" enctype="multipart/form-data" id="editService">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="required">Category</label>
                                        <select class="form-control select2bs4" name="cat_id" required>
                                            <option value="" selected>Select One</option>
                                            @foreach(App\Models\GalleryCategory::where('status',1)->orderBy('name','ASC')->get() as $row)
                                            <option value="{{$row->id}}" @if($gallery->cat_id == $row->id) selected @endif>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $gallery->title ?? '' }}" placeholder="Enter image title">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="required">Cover Image <small>(Size: 575X500px)</small></label>
                                        @if(!empty($gallery->image))
                                        <input type="hidden" name="current_image" value="{{ $gallery->image }}">
                                        @endif
                                        <input type="file" name="image" class="form-control p-1" id="image" value="{{ $gallery->image }}">
                                        @if(!empty($gallery->image))
                                        <img class="mt-2" style="width: 15%;" src="{{ asset('assets/images/gallery/'.$gallery->image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" @if($gallery->status == 1) checked @endif >
                                            <label class="form-check-label" for="status">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update </button>
                                <button type="reset" class="btn btn-default"> Reset </button>
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
        $('#editService').validate({
            ignore: [],
            debug: false,
            rules: {
                cat_id: {
                    required: true,
                },
                image: {
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