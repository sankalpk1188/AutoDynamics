<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table border="2">
		<tr>
			<td>Name</td>
			<td>{{$data['name']}}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{$data['email']}}</td>
		</tr>
		<tr>
			<td>Phone</td>
			<td>@if(!empty($data['country_code'])){{$data['country_code']}}-@endif{{$data['phone']}}</td>
		</tr>
		@if(!empty($data['organization']))
		<tr>
			<td>Organization</td>
			<td>{{$data['organization']}}</td>
		</tr>
		@endif
		@if(!empty($data['subject']))
		<tr>
			<td>Looking For</td>
			<td>{{$data['subject']}}</td>
		</tr>
		@endif
		@if(!empty($data['country']))
		<tr>
			<td>Country</td>
			<td>{{$data['country']}}</td>
		</tr>
		@endif
		@if(!empty($data['comment']))
		<tr>
			<td>Message</td>
			<td>{{$data['comment']}}</td>
		</tr>
		@endif
	</table>
</body>
</html>