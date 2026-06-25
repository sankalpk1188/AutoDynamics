@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog Comments</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('/admin/add-blogs') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Blog</a>
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
                <div class="col-12"> 
                    <div class="card">
                        <div class="card-body">
                            @if(count($comments)>0)
                            <table id="example1" class="table table-bordered table-striped" style="overflow-x: auto;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>User</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Commented On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{!! $row->user_name !!}</td>
                                    <td>{!! $row->comment !!}</td>
                                    <td>
                                        <form action="{{ url('admin/comment-status/'.$row->id) }}" method="post">@csrf
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="status" value="1" @if($row->status=="1") checked @endif class="custom-control-input" id="customSwitch{{$row->id}}" onchange="javascript:this.form.submit();">
                                                <label class="custom-control-label" for="customSwitch{{$row->id}}"></label>
                                            </div>
                                        </div>
                                        </form>
                                    </td>
                                    <td>{{date('d M Y, H:i', strtotime($row->created_at))}}</td>
                                    <td class="d-flex border-0 justify-content-center">
                                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('/admin/delete-comment/'.$row->id) }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 d-flex justify-content-center">
                                {{ $comments->links("pagination::bootstrap-4") }}
                            </div>
                            @else
                            <div class="alert alert-dark">No Comments available</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection