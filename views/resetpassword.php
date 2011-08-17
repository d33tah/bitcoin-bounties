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

        %ERROR_MESSAGE%
	
	<h1>%DOMAIN% - %TITLE%</h1>
	<form method="post" action="%LINK_PREFIX%/resetpassword/%HASH%">
                %INPUTS%
		<input type="submit" value="Submit" />
	</form>
</body>
</html>