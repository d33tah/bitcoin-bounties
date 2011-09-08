<?php include('header.php'); if(@!$FATAL_ERROR): ?>

	<form method="post" action="<?php echo $LINK_PREFIX 
            ?>/resetpassword/<?php echo $HASH ?>">
                <?php echo $INPUTS ?>
		<input type="submit" value="Submit" />
	</form>

<?php endif; include('footer.php') ?>