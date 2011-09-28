<?php include('header.php'); if(@!$FATAL_ERROR): ?>

        <div id="loginform">
	<form method="post" action="<?php echo $LINK_PREFIX ?>/signup/">

		<?php echo __(MSG_LOGIN) ?><br />
                  <input type="text" name="login" /> <br />

		<?php echo __(MSG_PASSWORD) ?><br />
                  <input type="password" name="password" /> <br />

		<?php echo __(MSG_REPEAT_PASSWORD) ?><br />
                  <input type="password" name="password2" />  <br />

		<?php echo __(MSG_EMAIL) ?><br />
                  <input type="text" name="email" /> <br />

		<?php echo __(MSG_VERIFICATION_CAPTCHA) ?>
		  <script type="text/javascript">
		    var RecaptchaOptions = {
			theme : 'clean'
		    };
		  </script>
                <?php echo $RECAPTCHA ?><br />
		<input type="submit" value="<?php echo __(MSG_SUBMIT) ?>" />
	</form>
        </div>

<?php endif; include('footer.php') ?>