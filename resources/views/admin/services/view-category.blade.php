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
            <h1> Category Section </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin-dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"> Category Section </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            @if(Session::has('flash_message_error'))
                    <div class="alert alert-dismissible fade show respo" role="alert" style="background-color: #CC9966;display: none;">
                      <p style="color:#fff;">{!! session('flash_message_error') !!}</p>
                      <button type="button" id="btn" onclick="fire()" class="btn btn-success toastrDefaultError"></button>
                    </div>
                @endif
              @if(Session::has('flash_message_success'))
                    <div class="alert alert-dismissible fade show respo" role="alert" style="background-color: #CC9966; display: none;">
                      <p style="color:#fff;">{!! session('flash_message_success') !!}</p>
                      <button type="button" id="btn" onclick="fire()" class="btn btn-success toastrDefaultSuccess"></button>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div><br>
              @endif
            <div class="card">
              <div class="card-header">
              <h3 class="card-title">View section</h3>
               <a href="{{ url('/admin/add-category') }}"><button style="float: right; margin: 3px 3px;" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Category</button></a>
              <a href="{{ url('/admin/add-services') }}"><button style="float: right; margin: 3px 3px;" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Services</button></a>
              <a href="{{ url('/admin/view-services') }}"><button style="float: right; margin: 3px 3px;" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View Services</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Title</th>                
                    <th>Description</th>                
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach($category as $category)
                <tr class="gradeX">
                    <td>{{ $loop->index+1 }}</td>
                    <!--<td style="text-align: left !important;">{{ $category->name }}</td>-->
                    <td>{!! Str::limit($category->title,20)!!}</td>
                    <td>{!! $category->description !!}</td>
                  <td class="center">
                    
                    <!-- <a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-mini" title="Edit Category">Edit</a> -->
                    <a class="btn btn-default" href="{{ url('/admin/edit-category/'.$category->id) }}"><i class="fa fa-edit" style="color: #000;"></i></a> &nbsp;
                    @if(session('adminSession')=='admin@gmail.com')
                    {{-- <a rel="{{ $category->id }}" rel1="delete-category" href="{{ url('/admin/delete-category/'.$category->id) }}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-mini deleteCategory" title="Delete Category">Delete</a> --}}
                    <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('/admin/delete-category/'.$category->id) }}"><i class="fa fa-trash"></i></a> &nbsp;
                    @endif
                  </td>
                </tr>
                <div id="myModal{{ $category->id }}" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>"{{ $category->name }}" Full Details </h3>
                  </div>
                  <div class="modal-body">
                    <p><b>Category ID: </b>{{ $category->id }}</p>
                    <p><b>Category Type: </b> <?php if($category->parent_id == 0) echo "Main Category"; else echo "Subcategory" ?></p>
                    <p><b>Category Name: </b>{{ $category->name }}</p>
                    
                    <p><b>Category Status: </b> 
                      <?php if($category->status==1) 
                        echo "<span style='color:green; font-weight: bold'>Active</span>";
                        else 
                        echo "<span style='color:red; font-weight: bold'>Inactive</span>"; ?>
                    </p>
                    <p><b>Category Description: </b> <?php echo nl2br($category->description) ?> </p>
                    <p><b>Created On: </b>{{ date('D, d M Y, h:i a', strtotime($category->created_at)) }}</p>
                    <p><b>Updated On: </b>{{ date('D, d M Y, h:i a', strtotime($category->updated_at)) }}</p>
                  </div>
                </div>
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