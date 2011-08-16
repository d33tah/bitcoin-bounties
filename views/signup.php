<html>

<head>

	%ENCODING%
	<title>
	%DOMAIN% - sign up
	</title>

	%CSS%
</head>
	
<body>

	%HEADER%
	<br />%HOMELINK%
	
        %ERROR_MESSAGE%

	<h1>%DOMAIN% - Sign up</h1>
	<form method="post" action="%LINK_PREFIX%/signup/">
		Login: <input type="text" name="login" /> <br />
		Password: <input type="password" name="password" /> <br />
		Repeat password: <input type="password" name="password2" /> <br />
		E-mail address: <input type="text" name="email" /> <br />
                Verification CAPTCHA (please repeat the text below):
		<script type="text/javascript">
		var RecaptchaOptions = {
		    theme : 'clean'
		};
		</script>
                %RECAPTCHA%
		<input type="submit" value="Submit" />
	</form>
</body>
</html>