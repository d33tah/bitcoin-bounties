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

        <?php echo $ERROR_MESSAGE ?>
	
	<h1><?php echo $DOMAIN ?> - <?php echo $TITLE ?></h1>
	<form method="post" action="<?php echo $LINK_PREFIX 
            ?>/resetpassword/<?php echo $HASH ?>">
                <?php echo $INPUTS ?>
		<input type="submit" value="Submit" />
	</form>
</body>
</html>