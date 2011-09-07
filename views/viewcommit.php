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

	<?php if(isset($FATAL_ERROR)): ?>
	<?php echo $FATAL_ERROR ?>
	<?php else: ?>

	<h2><?php echo __(MSG_TO_X,$BOUNTY_DESC) ?></h2>
	
	<p><?php echo __(MSG_FILE_NAME).' '.$COMMIT_FILENAME ?></p>
	<p><?php echo __(MSG_FILE_SIZE).' '.$COMMIT_SIZE ?></p>
	<p><?php echo __(MSG_DESCRIPTION_COLON).' '.$COMMIT_COMMENT ?></p>

        <?php endif ?>	
	
</body>
</html>