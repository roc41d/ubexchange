<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Reset Password</h2><br><br>

		<div>
			Hi {{$email}},<br>
			Please follow the link below to reset your password.<br><br>
			To reset your password, follow link: {{ URL::to('recovery/'.$link)}}.<br/>
			If you did not register at <a href="http://ubex.nuketeck.com/">ubexchange</a>, please ignore this email.<br><br>
		</div>
		<h3>ubexchange team</h3>
	</body>
</html>
