<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blogs Section</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('/admin/add-blogs') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> Add </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block w-50">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block w-50">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        
                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12"> 

                        <div class="card">
                            
                          
                          <!-- /.card-header -->
                          <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="overflow-x: auto;">
                              <thead>
                              <tr>
                                <th>Sr.No</th>
                                <th>Image</th>                    
                                <th>Title</th>
                                <th>Category</th>
                                {{-- <th>Short Description</th> --}}
                                {{-- <th>Description</th> --}}
                                <th>Date</th>
                                <th>Status</th>
                                <th>Update At</th>                                        
                                <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>

                            @foreach($blogs as $row)
                                <tr>
                                  <td>{{ $loop->index+1 }}</td>
                                  <td><a href="{{ asset('assets/images/blogs/'.$row->image) }}"><img src="{{ asset('assets/images/blogs/'.$row->image) }}" width="100px"></a></td>                                         
                                  <td>{!! Str::limit($row->title,20)!!}</td>                                         
                                  <td>{!! Str::limit($row->category,20)!!}</td>                                         
                                  {{-- <td>{!! Str::limit($row->short_description,50)!!}</td>                                          --}}
                                  {{-- <td>{!! Str::limit($row->description,50)!!}</td> --}}
                                  <td>{!! Str::limit($row->date,20)!!}</td>
                                  <td>{{ ($row->status == 1) ? 'Published' : 'Not Published' }}</td>
                                  <td>{{date('d F Y', strtotime($row->updated_at)) }}</td>
                                  <td>
                                    <a class="btn btn-default"  id="editAbout" href="{{ url('/admin/edit-blogs/'.$row->id) }}" title="Edit Blogs"><i class="fa fa-edit" style="color: #000;"></i></a> &nbsp;&nbsp;
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('/admin/delete-blogs/'.$row->id) }}"><i class="fa fa-trash"></i></a> &nbsp;
                                  </td>
                                </tr>

                            @endforeach

                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
              </div>
  @endsection