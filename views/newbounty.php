<html>

<head>

	<?php echo $ENCODING ?>
	<title>
	<?php echo $TITLE ?>
	</title>

	<?php echo $CSS ?>
</head>
	
<body>

	<?php echo $HEADER ?>
	<br /><?php echo $HOMELINK ?>
	
	<h1><?php echo $SHORT_TITLE ?></h1>
	<form method="post" action="<?php echo $LINK_PREFIX ?>/newbounty/">

		<?php echo __(MSG_TITLE) ?>
                  <input type="text" name="title" /> <br />

		<?php echo __(MSG_DESCRIPTION_COLON) ?> <br />
		  <textarea name="desc"></textarea><br />

		<input type="submit" value="<?php echo __(MSG_SUBMIT) ?>" />
	</form>
</body>
</html>