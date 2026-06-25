@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category Section</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Category Section</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
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
      <div class="row">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Edit Category</h3>
              {{-- <a href="{{ url('/admin/view-building') }}"><button style="float: right; margin: 3px 3px; background:#28a745;" class="btn btn-success btn-xl"><i class="fa fa-eye"></i> View buildings</button></a> --}}
            </div>
            <form class="p-4" action="{{ url('admin/services/update/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"> Name <i class="las la-language text-danger" title=" Translatable "></i></label>
                        <div class="col-md-9">
                            <input type="text" name="title" value="{{ $category->title }}" class="form-control" id="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"> Parent Category </label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="parent_id" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="{{ $category->parent_id }}">
                                <option value="0">No Parent</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @foreach ($category->childrenCategory as $childCategory)
                                        @include('admin.services.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-md-3 col-form-label">-->
                    <!--        Ordering Number-->
                    <!--    </label>-->
                    <!--    <div class="col-md-9">-->
                    <!--        <input type="number" name="order_level" value="{{ $category->order_level }}" class="form-control" id="order_level" placeholder="Order Level">-->
                    <!--        <small>Higher number has high priority</small>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Slug</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Slug" id="slug" name="slug" value="{{ $category->slug }}" class="form-control">
                        </div>
                    </div>              
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary"> Save </button>
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
        $('#editbuildingForm').validate({
            ignore: [],
            debug: false,
            rules: {
                title: {
                    required: true,
                },
                image: {
                    required: false,
                    accept: 'png|jpg|jpeg',
                },
                url: {
                    required: true,
                    url: true,
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