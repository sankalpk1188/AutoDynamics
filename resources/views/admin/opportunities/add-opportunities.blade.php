@extends('layouts/adminLayout/admin_design')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h4>Career Opportunities Section</h4></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Opportunity</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger">{!! session('flash_message_error') !!}</div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success">{!! session('flash_message_success') !!}</div>
            @endif

            <div class="card card-default">
                <div class="card-header"><h3 class="card-title">Add Career Opportunity</h3></div>
                <form method="POST" action="{{ url('admin/add-opportunities') }}" id="addOpportunity">@csrf
                    <div class="card-body form-row">
                        <div class="form-group col-md-4">
                            <label class="required">Designation</label>
                            <input name="designation_name" class="form-control" placeholder="Enter Job Designation" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required">Location</label>
                            <input name="location" class="form-control" placeholder="Enter Job Location" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required">Department / Qualification</label>
                            <input name="qualification" class="form-control" placeholder="Enter Department or Qualification" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required">Experience</label>
                            <input name="experience" class="form-control" placeholder="Enter Job Experience" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="required">Job Application Receive Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="required">Description</label>
                            <textarea name="job_description" class="textarea form-control" placeholder="Enter Job Description" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>
                                <label class="form-check-label" for="status">Publish</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary submit"><i class="fa fa-check-circle"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('backend_plugins/jquery/jquery.min.js') }}"></script>
<script>
$(function () {
    $('#addOpportunity').validate({
        submitHandler: function(form) {
            $('.submit').attr('disabled', true).html("<span class='fa fa-spinner fa-spin'></span> Please wait...");
            form.submit();
        }
    });
});
</script>
@endsection