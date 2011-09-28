<?php include('header.php'); if(@!$FATAL_ERROR): ?>

        <div id="newbounty">
	<form method="post" action="<?php echo $LINK_PREFIX ?>/newbounty/">

		<?php echo __(MSG_TITLE) ?>
                  <input type="text" name="title" size="40" /> <br />

		<?php echo __(MSG_DESCRIPTION_COLON) ?> <br />
		  <textarea cols="50" rows="10" name="desc"></textarea><br />

		<input type="submit" value="<?php echo __(MSG_SUBMIT) ?>" />
	</form>
        </div>

<?php endif; include('footer.php') ?>