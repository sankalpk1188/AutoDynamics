@extends('emails.partials.layout')

@section('preheader')
New job application for {{ $position }}
@endsection

@section('badge')
Careers
@endsection

@section('headline')
New Job Application
@endsection

@section('intro')
A candidate has applied through the careers section. Review their profile and message below.
@endsection

@section('content')
    @include('emails.partials.field_row', ['label' => 'Position', 'value' => e($position)])
    @include('emails.partials.field_row', ['label' => 'Name', 'value' => e($name)])
    @include('emails.partials.field_row', ['label' => 'Email', 'value' => '<a href="mailto:' . e($email) . '" style="color:#5ec8ff;text-decoration:none;">' . e($email) . '</a>'])
    @include('emails.partials.field_row', ['label' => 'Phone', 'value' => e($phone)])

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:8px 0 0;background-color:#0d2138;border-radius:12px;border:1px solid rgba(94,200,255,0.12);">
        <tr>
            <td style="padding:18px;">
                <span style="display:block;color:#5ec8ff;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:10px;">Cover Message</span>
                <div style="color:#eef4fb;font-size:14px;line-height:1.7;">{!! nl2br(e($comment)) !!}</div>
            </td>
        </tr>
    </table>

    @if(!empty($resume_url))
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:20px 0 0;">
            <tr>
                <td align="center">
                    <a href="{{ $resume_url }}" style="display:inline-block;padding:12px 24px;background:linear-gradient(135deg,#0082c6,#5ec8ff);color:#061224;font-size:13px;font-weight:700;text-decoration:none;border-radius:8px;">Download Resume</a>
                </td>
            </tr>
        </table>
    @endif
@endsection
