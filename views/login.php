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

    <?php echo $ERROR_MESSAGE ?>

    <?php 
      //A NOTE TO THE FRONTEND DEVELOPER:
      //please see functions.php in the main script directory for form html.
      //it's in the login_form function
      echo $LOGIN_FORM 
    ?>

    <? endif ?>
	
</body>
</html>