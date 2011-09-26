<?php include('header.php'); if(@!$FATAL_ERROR): ?>

	<h2><?php echo __(MSG_TO_X,$BOUNTY_DESC) ?></h2>
	
	<p><?php echo __(MSG_FILE_NAME).' '.$SOLUTION_FILENAME ?></p>
	<p><?php echo __(MSG_FILE_SIZE).' '.$SOLUTION_SIZE ?></p>
	<p><?php echo __(MSG_DESCRIPTION_COLON).' '.$SOLUTION_COMMENT ?></p>

<?php endif; include('footer.php') ?>