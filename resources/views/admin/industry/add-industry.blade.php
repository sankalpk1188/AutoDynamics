@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Industry Insights Section</h1>
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
            <li class="breadcrumb-item active">Industry Insights Section</li>
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
              <h3 class="card-title">Add Industry Insights</h3>
              
            </div>
            <form method="POST" action="{{ url('admin/add-industry') }}" enctype="multipart/form-data" id="addBanner">@csrf
                <div class="card-body">

                    <div class="form-group col-md-10">
                        <div class="form-group col-md-10">  
                            <label class="required"> Image (Size : 225x160px) </label>
                            <input type="file" name="image" class="form-control p-1" accept="image/*" required>
                            <small>Note: Image size should be less than 500KB</small>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-10">
                        <div class="form-group col-md-10">
	                        <label class="required">Title</label>
	                        <input name="title" class="form-control" placeholder="Enter Title" required>
	                    </div>  
                  	</div>

                  	<div class="form-group col-md-10">
                        <div class="form-group col-md-10">
	                        <label class="required">Description</label>
	                        <textarea name="description" class="textarea form-control" placeholder="Enter Description" required></textarea>
	                    </div>  
                  	</div>

                    <div class="form-group col-md-10">
                        <div class="form-group col-md-10">
                            <label class="required">Date</label>
                            <input type="date" name="date" class="form-control" placeholder="Enter Date" required>
                        </div>  
                    </div>

                    <div class="form-group col-md-10">
                        <div class="form-group col-md-10">
                            <label>PDF</label>
                            <input type="file" name="pdf" class="form-control p-1" placeholder="Enter PDF">
                        </div>  
                    </div>
                  	                                      
                </div>
                <div class="card-footer ">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Add </button>
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
        $('#addBanner').validate({
            ignore: [],
            debug: false,
            rules: {
                content: {
                    required: true,
                },
                image: {
                    required: true,
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