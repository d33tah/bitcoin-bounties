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
	<form enctype="multipart/form-data" 
          method="post"> <!-- action="%LINK_PREFIX%/newcommit/ -->
		<input type="file" name="uploaded" /> <br />
		Comments: <br />
		<textarea name="comments"></textarea><br />
		<input type="submit" value="Submit" />
	</form>
</body>
</html>