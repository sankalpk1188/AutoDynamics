@extends('layouts/adminLayout/admin_design')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>LinkedIn Posts</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Add LinkedIn Post</li>
          </ol>
        </div>
      </div>
      @if ($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
      @if(Session::has('flash_message_success')) <div class="alert alert-success">{!! session('flash_message_success') !!}</div> @endif
      @if(Session::has('flash_message_error')) <div class="alert alert-danger">{!! session('flash_message_error') !!}</div> @endif
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header"><h3 class="card-title">Add LinkedIn Post</h3></div>
        <form method="POST" action="{{ url('admin/add-linkedin-post') }}">@csrf
          <div class="card-body">
            <div class="form-group">
              <label class="required">LinkedIn Embed (iframe or URL)</label>
              <textarea name="embed_code" class="form-control" rows="6" required placeholder='Paste iframe or https://www.linkedin.com/embed/feed/update/...'>{{ old('embed_code') }}</textarea>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Add Post</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection
