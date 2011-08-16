<html>

<head>

	%ENCODING%
	<title>
	%DOMAIN% - add a new commit
	</title>

	%CSS%
</head>
	
<body>

	%HEADER%
	<br />%HOMELINK%
	
	<h1>%DOMAIN% - add a new commit</h1>
	<form method="post" action="/newcommit/">
		<input type="file" name="file" /> <br />
		Comments: <br />
		<textarea name="comments"></textarea><br />
		<input type="submit" value="Submit" />
	</form>
</body>
</html>