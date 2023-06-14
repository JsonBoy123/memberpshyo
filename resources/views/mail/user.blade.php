<!DOCTYPE html>
<html>
<head>
<title>Welcome Email</title>
</head>
<body>
	<h2>Welcome to the Physiotherapy India {{$user['name'] }} </h2>
	<br/>
	<h3>Your registered email-id is {{$user['email']}}, Please click on the below link to verify your email account</h3>
	<br/>
	<div style="width: 100%; text-align: center">
	<a href="{{url('/verify/'. $user['remember_token'])}}" style="border:1px solid #3490dc; background-color: #3490dc; color:white; padding: 5px; font-size: 16px; text-decoration: none">Verify Email</a>
	</div>
	<br/>
	<div style="width: 100%;">
		<p>Physiotherapy have created your account mobile number and  password is below here</p>	<br/>
		<p>Mobile Number: {{$user['phone']}}</p>
		<p>Password: {{$user['password']}}</p>
	</div>	
</body>

</html>