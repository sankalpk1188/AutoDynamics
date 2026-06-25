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
			<td>{{$data['phone']}}</td>
		</tr>
		<tr>
			<td>Message</td>
			<td>{{$data['comment']}}</td>
		</tr>
		<tr>
			<td>Resume</td>
			<td><a href="{{asset('resume/'.$resume)}}" download>Click Here</a></td>
		</tr>
	</table>
</body>
</html>