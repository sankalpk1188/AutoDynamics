<!DOCTYPE html>
<html>
<head>
    <title>New Distributor Enquiry</title>
</head>
<body>
    <h2>New Distributor Enquiry</h2>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Firm:</strong> {{ $farm }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone }}</p>
    <p><strong>Address:</strong> {{ $address }}</p>
    <p><strong>Pincode:</strong> {{ $pincode }}</p>
    <p><strong>Business Type:</strong> {{ $business_type }}</p>

    @if($gstFile)
        <p><strong>GST File:</strong> <a href="{{ $gstFile }}" target="_blank">Download GST</a></p>
    @endif

    @if($panFile)
        <p><strong>PAN Card File:</strong> <a href="{{ $panFile }}" target="_blank">Download PAN</a></p>
    @endif
</body>
</html>
