@extends('emails.partials.layout')

@section('preheader')
We received your design upload request
@endsection

@section('badge')
Request Received
@endsection

@section('headline')
Thank You, {{ $name }}!
@endsection

@section('intro')
Your design has been submitted successfully. Our engineering team will review your request and respond within <strong style="color:#eef4fb;">7 business days</strong>.
@endsection

@section('content')
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 16px;background:linear-gradient(135deg,rgba(0,130,198,0.18),rgba(94,200,255,0.08));border-radius:12px;border:1px solid rgba(94,200,255,0.2);">
        <tr>
            <td style="padding:20px 22px;text-align:center;">
                <span style="display:block;font-size:28px;line-height:1;margin-bottom:8px;">&#10003;</span>
                <span style="color:#eef4fb;font-size:15px;line-height:1.6;">Your upload is in our queue. We appreciate your interest in partnering with AutoDynamics.</span>
            </td>
        </tr>
    </table>

    @include('emails.partials.field_row', ['label' => 'Company', 'value' => e($company)])
    @include('emails.partials.field_row', ['label' => 'Requirement', 'value' => e($looking_for)])
    @include('emails.partials.field_row', ['label' => 'Material', 'value' => e($preferred_material)])
    @include('emails.partials.field_row', ['label' => 'Annual Volume', 'value' => e($annual_volume)])

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:16px 0 0;">
        <tr>
            <td style="padding:16px 18px;background-color:#0d2138;border-radius:12px;border:1px solid rgba(94,200,255,0.12);">
                <p style="margin:0;color:#9db3c9;font-size:13px;line-height:1.65;">
                    Questions? Reach us at
                    <a href="mailto:{{ e($support_email) }}" style="color:#5ec8ff;text-decoration:none;font-weight:600;">{{ e($support_email) }}</a>
                </p>
            </td>
        </tr>
    </table>
@endsection
