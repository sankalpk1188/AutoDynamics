@extends('emails.partials.layout')

@section('preheader')
New design upload from {{ $company }}
@endsection

@section('badge')
Design Upload
@endsection

@section('headline')
New Design Upload Request
@endsection

@section('intro')
A visitor submitted the <strong style="color:#eef4fb;">Upload Your Design</strong> form. Review the project details and file links below.
@endsection

@section('content')
    @include('emails.partials.field_row', ['label' => 'Name', 'value' => e($name)])
    @include('emails.partials.field_row', ['label' => 'Email', 'value' => '<a href="mailto:' . e($email) . '" style="color:#5ec8ff;text-decoration:none;">' . e($email) . '</a>'])
    @include('emails.partials.field_row', ['label' => 'Company', 'value' => e($company)])
    @include('emails.partials.field_row', ['label' => 'Looking For', 'value' => e($looking_for)])
    @include('emails.partials.field_row', ['label' => 'Material', 'value' => e($preferred_material)])
    @include('emails.partials.field_row', ['label' => 'Annual Volume', 'value' => e($annual_volume)])

    @if(!empty($part_description))
        @include('emails.partials.field_row', ['label' => 'Part Description', 'value' => nl2br(e($part_description))])
    @endif
    @if(!empty($program_name))
        @include('emails.partials.field_row', ['label' => 'Program', 'value' => e($program_name)])
    @endif
    @if(!empty($sop_timeline))
        @include('emails.partials.field_row', ['label' => 'SOP Timeline', 'value' => e($sop_timeline)])
    @endif

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:8px 0 0;background-color:#0d2138;border-radius:12px;border:1px solid rgba(94,200,255,0.12);">
        <tr>
            <td style="padding:18px;">
                <span style="display:block;color:#5ec8ff;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:12px;">Uploaded Files</span>
                @if(!empty($files) && count($files))
                    @foreach($files as $file)
                        <p style="margin:0 0 8px;">
                            <a href="{{ $file['url'] }}" style="color:#5ec8ff;font-size:14px;text-decoration:none;font-weight:600;">{{ e($file['name']) }}</a>
                        </p>
                    @endforeach
                @else
                    <span style="color:#9db3c9;font-size:14px;">No files attached.</span>
                @endif
            </td>
        </tr>
    </table>
@endsection
