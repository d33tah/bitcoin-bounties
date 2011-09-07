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

	<form method="post" action="<?php echo $LINK_PREFIX ?>/signup/">

		<?php echo __(MSG_LOGIN) ?>
                  <input type="text" name="login" /> <br />

		<?php echo __(MSG_PASSWORD) ?>
                  <input type="password" name="password" /> <br />

		<?php echo __(MSG_REPEAT_PASSWORD) ?>
                  <input type="password" name="password2" />  <br />

		<?php echo __(MSG_EMAIL) ?>
                  <input type="text" name="email" /> <br />

		<?php echo __(MSG_VERIFICATION_CAPTCHA) ?>
		  <script type="text/javascript">
		    var RecaptchaOptions = {
			theme : 'clean'
		    };
		  </script>
                <?php echo $RECAPTCHA ?>
		<input type="submit" value="<?php echo __(MSG_SUBMIT) ?>" />
	</form>

        <?php endif ?>
</body>
</html>