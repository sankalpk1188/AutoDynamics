@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
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
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Upload Your Design</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Design Upload Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="overflow-x: auto;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Looking For</th>
                                        <th>Material</th>
                                        <th>Annual Volume</th>
                                        <th>Program / SOP</th>
                                        <th>Files</th>
                                        <th>Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($uploads as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a></td>
                                        <td>{{ $row->company }}</td>
                                        <td>{{ $row->looking_for }}</td>
                                        <td>{{ $row->preferred_material ?: '—' }}</td>
                                        <td>{{ $row->annual_volume ?: '—' }}</td>
                                        <td>
                                            @if($row->program_name || $row->sop_timeline)
                                                @if($row->program_name)<div><strong>Program:</strong> {{ $row->program_name }}</div>@endif
                                                @if($row->sop_timeline)<div><strong>SOP:</strong> {{ $row->sop_timeline }}</div>@endif
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                            @if($row->part_description)
                                                <div class="text-muted small mt-1" title="{{ $row->part_description }}">{{ Str::limit($row->part_description, 60) }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($row->files) && is_array($row->files))
                                                @foreach($row->files as $file)
                                                    @php
                                                        $path = is_array($file) ? ($file['path'] ?? '') : $file;
                                                        $label = is_array($file) ? ($file['name'] ?? basename($path)) : basename($path);
                                                    @endphp
                                                    @if($path)
                                                        <a href="{{ asset($path) }}" target="_blank" rel="noopener">{{ $label }}</a>@if(!$loop->last)<br>@endif
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="text-muted">No files</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->created_at ? $row->created_at->format('d M Y, h:i A') : '—' }}</td>
                                        <td>
                                            <a class="btn btn-default" href="{{ url('admin/delete-design-upload/'.$row->id) }}" onclick="return confirm('Are you sure you want to delete this request?');"><i class="fa fa-trash" style="color: red;"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">No design upload requests yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
