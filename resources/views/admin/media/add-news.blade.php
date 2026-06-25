@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Add News</h3>
              
            </div>
            <form method="POST" action="{{ url('admin/add-news') }}" enctype="multipart/form-data" id="addNews">@csrf
                <div class="card-body">
                    
                    <div class="form-group col-md-10">
                        <div class="form-group col-md-10">
	                        <label class="required">Title</label>
	                        <input name="title" class="form-control" placeholder="Enter Title" required>
	                    </div>  
                  	</div>

                  	<div class="form-group col-md-10">
                        <div class="form-group col-md-10">
	                        <label class="required">Category</label>
	                        <input name="category" class="form-control" placeholder="Enter Category (e.g. Product Launch)">
	                    </div>  
                  	</div>

                  	<div class="form-group col-md-10">
                        <div class="form-group col-md-10">
	                        <label class="required">Date</label>
	                        <input type="date" name="date" class="form-control">
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
	                      	<label class="required"> Image</label>
	                      	<input type="file" name="image" class="form-control" accept="image/*">
	                      	<small>Note: Image size should be less than 500KB</small>
                      	</div>
                    </div>                                      
                    <div class="form-group col-md-10">
                      <div class="form-group col-md-10">
                        <label class="required">Status</label>
                        <select name="status" class="form-control">
                          <option value="1" selected>Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Add </button>
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
        $('#addNews').validate({
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