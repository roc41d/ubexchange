<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Activate Account</h2><br><br>

		<div>
			Hi {{$name}},<br>
			Welcome to <a href="#">techexchange</a>, please follow the link below to activate your account.<br><br>
			To activate your account, follow link: {{ URL::to('activate/'.$link)}}.<br/>
			If you did not register at <a href="#">techexchange</a>, please ignore this email.<br><br>
		</div>
		<h3>techexchange team</h3>
	</body>
</html>
