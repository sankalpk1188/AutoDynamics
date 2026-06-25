@php
    $logoUrl = asset('assets/images/auto_dynamic_logo.png');
    $siteUrl = url('/');
    $brandName = 'AutoDynamics';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('headline', 'Auto Dynamics')</title>
    <!--[if mso]><style>table{border-collapse:collapse;}td{font-family:Arial,sans-serif;}</style><![endif]-->
</head>
<body style="margin:0;padding:0;background-color:#061224;font-family:'Segoe UI',Arial,Helvetica,sans-serif;-webkit-font-smoothing:antialiased;">
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">@yield('preheader', '')</div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#061224;padding:28px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background-color:#0a1a30;border-radius:16px;overflow:hidden;border:1px solid rgba(94,200,255,0.18);box-shadow:0 18px 48px rgba(0,0,0,0.35);">

                    <tr>
                        <td style="padding:0;background:linear-gradient(135deg,#0082c6 0%,#0a3d5c 48%,#061224 100%);">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding:28px 32px 22px;text-align:center;">
                                        <img src="{{ $logoUrl }}" alt="{{ $brandName }}" width="180" style="display:block;margin:0 auto 16px;max-width:180px;height:auto;border:0;">
                                        <span style="display:inline-block;padding:6px 14px;border-radius:999px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.22);color:#ffffff;font-size:11px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;">@yield('badge', 'Website Notification')</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:28px 32px 8px;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;line-height:1.3;font-weight:700;">@yield('headline', 'New Enquiry')</h1>
                            @hasSection('intro')
                                <p style="margin:12px 0 0;color:#9db3c9;font-size:15px;line-height:1.6;">@yield('intro')</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:12px 32px 28px;">
                            @yield('content')
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:20px 32px 28px;border-top:1px solid rgba(94,200,255,0.12);background-color:#071525;">
                            <p style="margin:0 0 8px;color:#6f849c;font-size:12px;line-height:1.6;text-align:center;">
                                This message was sent from the <a href="{{ $siteUrl }}" style="color:#5ec8ff;text-decoration:none;">{{ $brandName }}</a> website.
                            </p>
                            <p style="margin:0;color:#4f6478;font-size:11px;line-height:1.5;text-align:center;">
                                &copy; {{ date('Y') }} Auto Dynamic Technologies &amp; Solutions. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
