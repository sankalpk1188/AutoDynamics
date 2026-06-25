@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>LinkedIn Embed Settings</h1>
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
            <li class="breadcrumb-item active">LinkedIn Embed URL</li>
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
              <h3 class="card-title">News &amp; Views - LinkedIn Section</h3>
            </div>
            <form method="POST" action="{{ url('admin/linkedin-embed') }}" id="linkedinEmbedForm">@csrf
              <div class="card-body">
                <div class="form-group col-md-10">
                  <label class="required">LinkedIn Embed</label>
                  <textarea name="linkedin_embed" class="form-control" rows="6" placeholder="Paste LinkedIn iframe code or only LinkedIn embed URL">{{ old('linkedin_embed', $linkedinEmbed) }}</textarea>
                  <small class="text-muted">
                    Example URL: https://www.linkedin.com/embed/feed/update/urn:li:share:7449683786046558208?collapsed=1
                  </small>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
