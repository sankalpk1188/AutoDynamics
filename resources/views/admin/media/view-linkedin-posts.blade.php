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
            <li class="breadcrumb-item active">View LinkedIn Posts</li>
          </ol>
        </div>
      </div>
      @if(Session::has('flash_message_success')) <div class="alert alert-success">{!! session('flash_message_success') !!}</div> @endif
      @if(Session::has('flash_message_error')) <div class="alert alert-danger">{!! session('flash_message_error') !!}</div> @endif
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <a href="{{ url('/admin/add-linkedin-post') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add</a>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Embed</th>
                <th>Updated</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($posts as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Illuminate\Support\Str::limit(strip_tags($row->embed_code), 70) }}</td>
                <td>{{ date('d F Y', strtotime($row->updated_at)) }}</td>
                <td>
                  <a class="btn btn-default" href="{{ url('/admin/edit-linkedin-post/'.$row->id) }}"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('/admin/delete-linkedin-post/'.$row->id) }}"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
