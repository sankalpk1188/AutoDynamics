<!DOCTYPE html>
<html>
<head>
  <title>New Password Email</title>
</head>
<body>
  <table>
    <tr><td>Dear {{ $name }}!</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>We have received request for OTP to reset password.</td></tr>
    <tr><td><b>OTP: {{ $otp }}</b></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Thanks & Regards,</td></tr>
    <tr><td>Kirtane & Pandit</td></tr>
  </table>
</body>
</html>