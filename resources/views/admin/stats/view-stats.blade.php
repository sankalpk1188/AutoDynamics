<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Stats Section</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Stats Section </li>
                    </ol>
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
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="overflow-x: auto;">
                                <thead>
                                    <tr>
                                        <th>Count</th>
                                        <th>Prefix</th>
                                        <th>Title</th>
                                        <th>Update At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                @foreach($stats as $row) 
                                <tr>
                                    <td>{!! Str::limit($row->count,20)!!}</td>
                                    <td>{!! Str::limit($row->prefix,20)!!}</td>
                                    <td>{!! Str::limit($row->title,20)!!}</td>
                                    <td>{{date('d F Y', strtotime($row->updated_at)) }}</td>
                                    <td>
                                        <a class="btn btn-default" id="editAbout" href="{{ url('/admin/edit-stats/'.$row->id) }}" title="Edit Stats">
                                            <i class="fa fa-edit" style="color: #000;"></i>
                                        </a> &nbsp;&nbsp;
                                    </td>
                                </tr> 
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection