@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Partners Section</h4>
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
                        <form method="POST" action="{{ url('admin/add-partners') }}" enctype="multipart/form-data" id="addService">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
            	                        <label class="required">Partners Education</label>
            	                        <input type="text" name="education" class="form-control" placeholder="Enter Partners Education" required>
                          	        </div>
                                    <div class="form-group col-md-4">
                                        <label class="required">Category</label>
                                        <select class="form-control select2bs4" name="partners_cat_id" required>
                                            <option value="" selected>Select One</option>
                                            @foreach(App\Models\PartnersCategory::where('status',1)->orderBy('name','ASC')->get() as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
            	                      	<label class="required">Cover Image <small>(Size: 635x595px)</small></label>
            	                      	<input type="file" name="image" class="form-control p-1" accept="image/*" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="required">Linkedin Url</label>
                                        <Input name="url" class="form-control" rows="4" placeholder="Enter Linkedin Url" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="required">Email</label>
                                        <Input name="email" class="form-control" rows="4" placeholder="Enter Email" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Department</label>
                                        <Input name="department" class="form-control" rows="4" placeholder="Enter Department">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Location</label>
                                        <Input name="location" class="form-control" rows="4" placeholder="Enter Location">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1">
                                            <label class="form-check-label" for="status">Publish</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary submit"><i class="fa fa-check-circle"></i> Add Partners </button>
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
        $('#addService').validate({
            ignore: [],
            debug: false,
            rules: {
                title: {
                    required: true,
                },
                service_content: {
                    required: true,
                },
                image: {
                    required: true,
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