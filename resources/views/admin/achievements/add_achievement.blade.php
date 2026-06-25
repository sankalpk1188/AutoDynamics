@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Awards & Certifications</h4>
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
                        <li class="breadcrumb-item active">Awards & Certifications</li>
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
                        <form method="POST" action="{{ url('admin/add-achievement') }}" enctype="multipart/form-data" id="addAchievement">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="required">Type</label>
                                        <select class="form-control" name="type" required>
                                            <option value="">Select type</option>
                                            @foreach($types as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="required">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Award or certificate title" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Short description for SEO and lightbox"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Image Alt Text</label>
                                        <input type="text" name="alt" class="form-control" placeholder="Accessibility description for the image">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Identifier</label>
                                        <input type="text" name="identifier" class="form-control" placeholder="e.g. design number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Sort Order</label>
                                        <input type="number" name="sort_order" class="form-control" value="0" min="0">
                                        <small class="text-muted">Lower numbers appear first on homepage.</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="required">Image</label>
                                        <input type="file" name="image" class="form-control p-1" accept="image/*" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                                            <label class="form-check-label" for="status">Publish on homepage</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary submit"><i class="fa fa-check-circle"></i> Add Item</button>
                                <a href="{{ url('admin/view-achievements') }}" class="btn btn-default">Back to list</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
