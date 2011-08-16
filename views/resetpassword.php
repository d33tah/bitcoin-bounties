<html>

<head>

	%ENCODING%
	<title>
	%DOMAIN% - password recovery
	</title>

	%CSS%
</head>
	
<body>

	%HEADER%
	<br />%HOMELINK%
	
	<h1>%DOMAIN% - password recovery</h1>
	<form method="post" action="/login/mode=resetpassword">
		Login: <input type="text" name="login" /> <br />
		E-mail address: <input type="text" name="e-mail" /> <br />
		<input type="submit" value="Submit" />
	</form>
</body>
</html>