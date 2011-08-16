<html>

<head>

	%ENCODING%
	<title>
	%DOMAIN% - log in
	</title>

	%CSS%
</head>
	
<body>

	%HEADER%
	<br />%HOMELINK%
	
        %ERROR_MESSAGE%

	<h1>%DOMAIN% - log in</h1>
	<form method="post" action="%LINK_PREFIX%/login/">
		Login: <input type="text" name="login" /> <br />
		Password: <input type="password" name="password" /> <br />
                <input type="checkbox" name="remember"> Remember me <br />
                Verification CAPTCHA (please repeat the text below):
		<script type="text/javascript">
		var RecaptchaOptions = {
		    theme : 'clean'
		};
		</script>
                %RECAPTCHA%
		<input type="submit" value="Submit" />
	</form>
	
	<p>
		<a href="%LINK_PREFIX%/resetpassword/">Forgot the password?</a>
	</p>
	
	<p>
		<a href="%LINK_PREFIX%/signup/">Don't have an account yet? Click here to sign up.</a>
	</p>
	
</body>
</html>