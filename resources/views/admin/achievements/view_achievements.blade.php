@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Homepage Awards & Certifications</h4>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('/admin/add-achievement') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Item</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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

                    <div class="card">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex justify-content-start">
                                    <div class="col-auto">
                                        <select class="form-control" name="type" onchange="this.form.submit();">
                                            <option value="">-- All Types --</option>
                                            @foreach($types as $value => $label)
                                            <option value="{{ $value }}" @if(request('type') === $value) selected @endif>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ url('admin/view-achievements') }}" class="btn btn-default">Clear</a>
                                    </div>
                                    @if($achievements->count() === 0)
                                    <div class="col-auto">
                                        <a href="{{ url('admin/import-achievements') }}" class="btn btn-secondary" onclick="return confirm('Import all default homepage awards?');">Import Defaults</a>
                                    </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($achievements as $row)
                                    <tr>
                                        <td>{{ $row->sort_order }}</td>
                                        <td>{{ $types[$row->type] ?? ucfirst(str_replace('_', ' ', $row->type)) }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>
                                            @if(!empty($row->image))
                                            <a href="{{ $row->imageUrl() }}" target="_blank" rel="noopener">
                                                <img src="{{ $row->imageUrl() }}" width="90" alt="">
                                            </a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $row->status == 1 ? 'Published' : 'Hidden' }}</td>
                                        <td>
                                            <a class="btn btn-default" href="{{ url('/admin/edit-achievement/'.$row->id) }}"><i class="fa fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="{{ url('/admin/delete-achievement/'.$row->id) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No awards found. Add a new item or import defaults.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            @if(method_exists($achievements, 'links'))
                            <div class="mt-3">{{ $achievements->links() }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
