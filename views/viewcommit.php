<?php include('header.php'); if(@!$FATAL_ERROR): ?>

	<h2><?php echo __(MSG_TO_X,$BOUNTY_DESC) ?></h2>
	
	<p><?php echo __(MSG_FILE_NAME).' '.$COMMIT_FILENAME ?></p>
	<p><?php echo __(MSG_FILE_SIZE).' '.$COMMIT_SIZE ?></p>
	<p><?php echo __(MSG_DESCRIPTION_COLON).' '.$COMMIT_COMMENT ?></p>

<?php endif; include('footer.php') ?>