<?php include('header.php'); if(@!$FATAL_ERROR): ?>

  <form enctype="multipart/form-data" 
    method="post"> <!-- action="<?php echo $LINK_PREFIX ?>/newsolution/ -->

      <input type="file" name="uploaded" /> <br />

      <?php echo __(MSG_COMMENTS) ?> <br />
        <textarea name="comments"></textarea><br />

      <input type="submit" value="<?php echo __(MSG_SUBMIT) ?>" />
  </form>

<?php endif; include('footer.php') ?>