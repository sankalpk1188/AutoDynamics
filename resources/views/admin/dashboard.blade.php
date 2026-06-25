@php
    $email = session('adminSession');
  
    use App\Models\Admin;
    use App\Models\Enquiry;

    $enquiry = Enquiry::count();
  
@endphp

@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
            </div>
        </div>
    </div> 

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$enquiry}}</h3>
                            <p>Enquiries</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-location"></i>
                        </div>
                        <a href="{{url('admin/view-joinus-enq')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection