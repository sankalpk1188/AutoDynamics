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
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/view-achievements') }}">Awards</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                        <form method="POST" action="{{ url('admin/edit-achievement/'.$achievement->id) }}" enctype="multipart/form-data" id="editAchievement">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="required">Type</label>
                                        <select class="form-control" name="type" required>
                                            @foreach($types as $value => $label)
                                            <option value="{{ $value }}" @if($achievement->type === $value) selected @endif>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="required">Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $achievement->title }}" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $achievement->description }}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Image Alt Text</label>
                                        <input type="text" name="alt" class="form-control" value="{{ $achievement->alt }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Identifier</label>
                                        <input type="text" name="identifier" class="form-control" value="{{ $achievement->identifier }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Sort Order</label>
                                        <input type="number" name="sort_order" class="form-control" value="{{ $achievement->sort_order }}" min="0">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Image</label>
                                        @if(!empty($achievement->image))
                                        <input type="hidden" name="current_image" value="{{ $achievement->image }}">
                                        @endif
                                        <input type="file" name="image" class="form-control p-1" accept="image/*">
                                        @if(!empty($achievement->image))
                                        <img class="mt-2" style="width: 120px;" src="{{ $achievement->imageUrl() }}" alt="">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" @if($achievement->status == 1) checked @endif>
                                            <label class="form-check-label" for="status">Publish on homepage</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update</button>
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
