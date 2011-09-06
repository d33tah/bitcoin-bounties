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

    <h1><?php echo $SHORT_TITLE ?></h1>
    <form method="post" action="<?php echo $LINK_PREFIX ?>/login/">

      <?php echo __(MSG_LOGIN) ?> 
	<input type="text" name="login" /> <br />

      <?php echo __(MSG_PASSWORD) ?> 
	<input type="password" name="password" /> <br />

	<input type="checkbox" name="remember">
      <?php echo __(MSG_REMEMBER_ME) ?> 
	<br />

      <?php echo __(MSG_VERIFICATION_CAPTCHA) ?> 
	<script type="text/javascript">
	  var RecaptchaOptions = {
	      theme : 'clean'
	  };
	</script>
      <?php echo $RECAPTCHA ?>

      <input type="submit" value="Submit" />
    </form>
    
    <p>
      <a href="<?php echo $LINK_PREFIX ?>/resetpassword/">
	<?php echo __(MSG_FORGOT_PASSWORD) ?> 
      </a>
    </p>
    
    <p>
      <a href="<?php echo $LINK_PREFIX ?>/signup/">
	<?php echo __(MSG_HAVE_NO_ACCOUNT_SIGN_UP) ?> 
      </a>
    </p>
	
</body>
</html>