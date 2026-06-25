@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>{{$partners->name}}</h4>
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
                        <li class="breadcrumb-item active">Partners Section</li>
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
                        <form method="POST" action="{{ url('admin/edit-partners/'.$partners->id) }}" enctype="multipart/form-data" id="editService">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="required">Partners Education</label>
                                        <input type="text" name="education" class="form-control" placeholder="Enter Partners Education" value="{{$partners->education}}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="required">Category</label>
                                        <select class="form-control select2bs4" name="partners_cat_id" required>
                                            <option value="" selected>Select One</option>
                                            @foreach(App\Models\PartnersCategory::where('status',1)->orderBy('name','ASC')->get() as $row)
                                            <option value="{{$row->id}}" @if($partners->partners_cat_id == $row->id) selected @endif>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="required">Cover Image <small>(Size: 635x595px)</small></label>
                                        @if(!empty($partners->image))
                                        <input type="hidden" name="current_image" value="{{ $partners->image }}">
                                        @endif
                                        <input type="file" name="image" class="form-control p-1" id="image" value="{{ $partners->image }}">
                                        <img class="mt-2" style="width: 15%;" src="{{ asset('assets/imgs/partners/'.$partners->image) }}" alt="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="required">Linkedin Url</label>
                                        <input type="text" name="url" class="form-control" placeholder="Enter Linkedin Url" value="{{$partners->url}}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="required">Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="Enter Email" value="{{$partners->email}}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Department</label>
                                        <input type="text" name="department" class="form-control" placeholder="Enter Department" value="{{$partners->department}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Location</label>
                                        <input type="text" name="location" class="form-control" placeholder="Enter Location" value="{{$partners->location}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" @if($partners->status == 1) checked @endif >
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
                title: {
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