@extends('emails.partials.layout')

@section('preheader')
Thank you for contacting Auto Dynamics
@endsection

@section('badge')
Thank You
@endsection

@section('headline')
Thank You, {{ $name }}!
@endsection

@section('intro')
We have received your message and our team will get back to you shortly.
@endsection

@section('content')
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 16px;background:linear-gradient(135deg,rgba(0,130,198,0.18),rgba(94,200,255,0.08));border-radius:12px;border:1px solid rgba(94,200,255,0.2);">
        <tr>
            <td style="padding:20px 22px;text-align:center;">
                <span style="display:block;font-size:28px;line-height:1;margin-bottom:8px;">&#10003;</span>
                <span style="color:#eef4fb;font-size:15px;line-height:1.6;">Your enquiry has been submitted successfully. We appreciate you reaching out to AutoDynamics.</span>
            </td>
        </tr>
    </table>

    @include('emails.partials.field_row', ['label' => 'Subject', 'value' => e($subject)])
    @if(!empty($company))
        @include('emails.partials.field_row', ['label' => 'Company', 'value' => e($company)])
    @endif
    @include('emails.partials.field_row', ['label' => 'Your Email', 'value' => e($email)])

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:8px 0 0;background-color:#0d2138;border-radius:12px;border:1px solid rgba(94,200,255,0.12);">
        <tr>
            <td style="padding:18px;">
                <span style="display:block;color:#5ec8ff;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:10px;">Your Message</span>
                <div style="color:#eef4fb;font-size:14px;line-height:1.7;">{!! nl2br(e($body)) !!}</div>
            </td>
        </tr>
    </table>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:16px 0 0;">
        <tr>
            <td style="padding:16px 18px;background-color:#0d2138;border-radius:12px;border:1px solid rgba(94,200,255,0.12);">
                <p style="margin:0;color:#9db3c9;font-size:13px;line-height:1.65;">
                    Need urgent help? Contact us at
                    <a href="mailto:{{ e($support_email) }}" style="color:#5ec8ff;text-decoration:none;font-weight:600;">{{ e($support_email) }}</a>
                </p>
            </td>
        </tr>
    </table>
@endsection
