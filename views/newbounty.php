<?php include('header.php'); if(@!$FATAL_ERROR): ?>

	<form method="post" action="<?php echo $LINK_PREFIX ?>/newbounty/">

		<?php echo __(MSG_TITLE) ?>
                  <input type="text" name="title" /> <br />

		<?php echo __(MSG_DESCRIPTION_COLON) ?> <br />
		  <textarea name="desc"></textarea><br />

		<input type="submit" value="<?php echo __(MSG_SUBMIT) ?>" />
	</form>

<?php endif; include('footer.php') ?>