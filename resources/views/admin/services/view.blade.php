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
                <div class="col-sm-6"><h1>Category</h1></div>

                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="{{ url('/admin/services/add-category') }}"><button style="float: right;" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Category</button></a>
                        <a href="{{ url('/admin/add-services') }}"><button style="float: right; margin: 0px 5px;" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Products</button></a>
                    </div>
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
                                        <th data-breakpoints="lg">#</th>
                                        <th>Name</th>
                                        <!--<th data-breakpoints="lg">Parent Category</th>-->
                                        <!--<th data-breakpoints="lg">Level</th>-->
                                        <th width="10%" class="text-right">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $key => $category)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $category->title }}</td>
                                            
                                            <!--<td>{{ $category->level }}</td>-->
                                            <td class="text-right">
                                                <a class="btn btn-default" href="{{ url('/admin/services/edit/'.$category->id) }}"><i class="fa fa-edit" style="color: #000;"></i></a> &nbsp;
                                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ url('/admin/services/destroy/'.$category->id) }}"><i class="fa fa-trash"></i></a> &nbsp;
                                                {{-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{url('admin/services/'.$category->id)}}" title="Edit">
                                                    <i class="las la-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{url('admin/services/destroy/'.$category->id)}}" title="Delete">
                                                    <i class="las la-trash"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <div class="aiz-pagination">
                                <ul class="pagination m-auto" style="justify-content: center; padding-bottom: 15px;">
                                    
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection