<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
          <div class="col-sm-6">
            <h1> Product Section </h1>
          </div>
          <div class="col-sm-6">
            <div class="float-right">
                  <a href="{{ url('/admin/add-services') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Products</a>
                  <a href="{{ url('/admin/services/add-category/') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Category</a>
                  <a href="{{ url('/admin/services/view/') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Category</a>
              </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Additional Information</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach($services as $row)
                  <tr class="gradeX">
                     <td>{{ $loop->index+1 }}</td>
                     <td><img src="{{asset('assets/img/products/'.$row->image) }}" style="height: 50px;"> &nbsp;</td>
                     <td>{{Str::limit($row->title,20)}}</td>
                     <td>{{Str::limit($row->name,20)}}</td>
                     
                     <td>{!! Str::limit(strip_tags($row->description),20)!!}</td>
                     <td>{!! Str::limit(strip_tags($row->additional),20)!!}</td>
                     <td class="center">
                        
                        <a class="btn btn-default btn-sm" href="{{ url('/admin/edit-services/'.$row->id) }}"><i class="fa fa-edit" style="color: #000;"></i></a> &nbsp;
                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href="{{ url('/admin/delete-services/'.$row->id) }}"><i class="fa fa-trash"></i></a>
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