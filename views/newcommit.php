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
  <form enctype="multipart/form-data" 
    method="post"> <!-- action="<?php echo $LINK_PREFIX ?>/newcommit/ -->

      <input type="file" name="uploaded" /> <br />

      <?php echo __(MSG_COMMENTS) ?> <br />
        <textarea name="comments"></textarea><br />

      <input type="submit" value="<?php echo __(MSG_SUBMIT) ?>" />
  </form>
</body>
</html>