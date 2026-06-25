@extends('emails.partials.layout')

@section('preheader')
Thank you for applying to Auto Dynamics
@endsection

@section('badge')
Application Received
@endsection

@section('headline')
Thank You, {{ $name }}!
@endsection

@section('intro')
Your job application has been submitted successfully. Our HR team will review your profile and contact you if your qualifications match our requirements.
@endsection

@section('content')
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 16px;background:linear-gradient(135deg,rgba(0,130,198,0.18),rgba(94,200,255,0.08));border-radius:12px;border:1px solid rgba(94,200,255,0.2);">
        <tr>
            <td style="padding:20px 22px;text-align:center;">
                <span style="display:block;font-size:28px;line-height:1;margin-bottom:8px;">&#10003;</span>
                <span style="color:#eef4fb;font-size:15px;line-height:1.6;">We have received your application and appreciate your interest in joining Auto Dynamics.</span>
            </td>
        </tr>
    </table>

    @include('emails.partials.field_row', ['label' => 'Position', 'value' => e($position)])
    @include('emails.partials.field_row', ['label' => 'Name', 'value' => e($name)])
    @include('emails.partials.field_row', ['label' => 'Email', 'value' => e($email)])
    @include('emails.partials.field_row', ['label' => 'Phone', 'value' => e($phone)])

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:16px 0 0;">
        <tr>
            <td style="padding:16px 18px;background-color:#0d2138;border-radius:12px;border:1px solid rgba(94,200,255,0.12);">
                <p style="margin:0;color:#9db3c9;font-size:13px;line-height:1.65;">
                    Questions about your application? Reach us at
                    <a href="mailto:{{ e($support_email) }}" style="color:#5ec8ff;text-decoration:none;font-weight:600;">{{ e($support_email) }}</a>
                </p>
            </td>
        </tr>
    </table>
@endsection
