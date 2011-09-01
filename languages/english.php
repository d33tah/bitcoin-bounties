<?php
assume_index();
require_once(ROOT."constants.php");
$messages[MSG_LOGIN_TOO_SHORT]=<<<MESSAGE
The login you have entered is too short. Please choose a different one.
MESSAGE;

$messages[MSG_LOGIN_TOO_LONG]=<<<MESSAGE
The login you have entered is too long. Please choose a different one.
MESSAGE;

$messages[MSG_LOGIN_REGEX]=<<<MESSAGE
The login you have entered contains illegal characters. 
Please choose  a different one.
MESSAGE;

$messages[MSG_PASS_TOO_SHORT]=<<<MESSAGE
The password you have entered is too short. Please choose a different one.
MESSAGE;

$messages[MSG_PASS_TOO_LONG]=<<<MESSAGE
The password you have entered is too long. Please choose a different one.
MESSAGE;

$messages[MSG_PASS_DONT_MATCH]=<<<MESSAGE
The two "new password" fields do not contain the same password.
MESSAGE;

$messages[MSG_EMAIL_REGEX]=<<<MESSAGE
The e-mail you have entered seems invalid. If you think this is an error, 
contact the administrator at 
<a href=\"mailto:${adminemail}\">${adminemail}</a>.
MESSAGE;

$messages[MSG_EMAIL_TAKEN]=<<<MESSAGE
The e-mail you have entered is already assigned to another account.
MESSAGE;

$messages[MSG_LOGIN_TAKEN]=<<<MESSAGE
The login you entered already belongs to another user.
MESSAGE;

$messages[MSG_INVALID_CAPTCHA]=<<<MESSAGE
The verification CAPTCHA was not repeated correctly.
MESSAGE;

$messages[MSG_CONFIRMATION_EMAIL]=<<<MESSAGE
Hello %s,

Someone with the IP address %s tried to register a username '%1\$s'
and entered your e-mail address on the website %DOMAIN%. If it wasn't you,
please just remove this e-mail and ignore it. Otherwise, please click the 
below or copy it to your browser's address bar to confirm that your e-mail 
address is valid:

${LINK_PREFIX}/confirm/hash=%s

The following link will expire within 24 hours.

Please note this is an automatically generated message. Please do not reply to
it. Should you have any questions, please contact the server admin at
${adminemail}

Yours sincerely,
${domain} admin
MESSAGE;

$messages[MSG_CONFIRMATION_EMAIL_TITLE]=<<<MESSAGE
Cofirm your registration at
MESSAGE;

$messages[MSG_CONFIRMATION_EMAIL_SENT]=<<<MESSAGE
We sent you a confirmation link.
MESSAGE;

$messages[MSG_REGISTRATION_FAILED_LIST]=<<<MESSAGE
The registration failed due to the following reasons: 
MESSAGE;

$messages[MSG_BOUNTY_ADDED]=<<<MESSAGE
Your bounty was successfully added. 
You can view it <a href=%s>here</a>.
MESSAGE;

$messages[MSG_DONATE_REGISTERED]=<<<MESSAGE
<p>
  You are about to donate a bounty as a <strong>registered</strong> user.
  This gives you the rights to vote on whether you accept or not
  particular solutions to the bounty you chose. You can read about the 
  rules <a href="${LINK_PREFIX}/about/">here</a>. Please send the donation 
  to the following bitcoin address:
</p>

<pre class="donate_address">
%s
</pre>

<p>
  This particular address is for your transactions only. Should you 
  decide to withdraw your donation, all the transactions from this address
  will be reverted.
  Note that the number of votes is proportional to the amount of money 
  you donate - the more you donate, the more influence on the bounty you
  have!
</p>
MESSAGE;

$messages[MSG_DONATE_UNREGISTERED]=<<<MESSAGE
<p>
    You are about to donate a bounty as an <strong>unregistered</strong> 
    user. This gives you no rights to vote on bounty submissions; you can 
    read about the rules <a href="${LINK_PREFIX}/about/">here</a>. 
    If you agree, please send the donation to the following bitcoin address:
</p>

<pre class="donate_address">
%s
</pre>

<p>
  This is a public address created for this bounty only. The donation
  you send will be returned to you after a year if there will send his
  submissions to this bounty. Also, the system will automatically vote in
  your name in favour of any submissions sent. Should you want to change 
  it, sign in below:
</p>

<form method="post" action="${LINK_PREFIX}/login/redirect=/donate/%s">
  Login: <input type="text" name="login" /> <br />
  Password: <input type="password" name="password" /> <br />
  <input type="submit" value="Submit" />
</form>

<p>
  <a href="${LINK_PREFIX}/resetpassword/">Forgot the password?</a>
</p>

<p>
  <a href="${LINK_PREFIX}/signup">Don't have an account yet? 
  Click here to sign up.</a>
</p>
MESSAGE;

$messages[MSG_VOTEUP_SUCCESS]=<<<MESSAGE
You have just voted up a submission. We will redirect you back to the
submissions' list now. If it doesn't happen, click 
<a href="${LINK_PREFIX}/commits/id=%s">here</a>.
MESSAGE;

$messages[MSG_BOUNTY_GATHERED]=<<<MESSAGE
Hello %s,

Your contribution to the bounty number %s on ${domain} has met enough
approval for sending a bounty worth %s BTC to a Bitcoin address you 
choose. To receive your reward, please visit the following link and enter
the Bitcoin address the reward will be transfered to:

${LINK_PREFIX}/payout/

Yours faithfully,
${domain} team
MESSAGE;

$messages[MSG_BOUNTY_GATHERED_TITLE]=<<<MESSAGE
Your commit was accepted and ready to be paid out!
MESSAGE;

$messages[MSG_CONFIRATION_LINK_INVALID]=<<<MESSAGE
<p>
There was an error with the confirmation link. Make sure your
account isn't already confirmed, the link is not outdated or damaged.<br />
</p>
<p>
Keep in mind that a single confirmation link is valid only for the 24 hours
since generation time. After that time it expries and the account gets 
deleted.
</p>
MESSAGE;

$messages[MSG_ACCOUNT_CONFIRMED]=<<<MESSAGE
Your account is now confirmed. You may log in using it to freely
access the website.
MESSAGE;

$messages[MSG_ACCOUNT_NOT_CONFIRMED_YET]=<<<MESSAGE
Your account is not confirmed yet. Please
confirm your account by clicking the confirmation link we
sent you to your e-mail address. If you can't find it, check
your SPAM folder. To rule out a mistake, you can retry signing
up again with another username or wait 24 hours for the 
confirmation link to expire. If you still haven't received
the e-mail, please contact the site administrator at
<a href=\"mailto:${adminemail}\">${adminemail}</a>.
MESSAGE;

$messages[MSG_CAPTCHA_INVALID]=<<<MESSAGE
The verification CAPTCHA was not repeated correctly.

MESSAGE;

$messages[MSG_LOGIN_DATA_INVALID]=<<<MESSAGE
The login data you entered are not valid.

MESSAGE;

$messages[MSG_LOGIN_FAILED_REASONS]=<<<MESSAGE
The login failed due to the following reasons:
MESSAGE;

$messages[MSG_PASSWORD_CHANGED]=<<<MESSAGE
Your password has been changed.
MESSAGE;

$messages[MSG_NO_REAL_PASSWORD_CHANGE]=<<<MESSAGE
The password you entered as new is identical to the old one. Please choose 
another one.
MESSAGE;

$messages[MSG_NEW_PASSWORD_TOO_LONG]=<<<MESSAGE
The new password you entered is too long. Please choose a shorter one.
MESSAGE;

$messages[MSG_NEW_PASSWORD_TOO_SHORT]=<<<MESSAGE
The new password you entered is too short. Please choose a longer one.
MESSAGE;

$messages[MSG_NEW_PASSWORDS_DIFFER]=<<<MESSAGE
The two "new password" fields do not contain the same password.
MESSAGE;

$messages[MSG_INVALID_OLD_PASSWORD]=<<<MESSAGE
The old password you entered is not valid.
MESSAGE;

$messages[MSG_FILL_REQUIRED_FIELDS]=<<<MESSAGE
Please fill all the required fields.
MESSAGE;

$messages[MSG_RESETPASSWORD_MAIL]=<<<MESSAGE
Hello %s,

Someone with the IP address %s tried to recover your password
on the website ${domain}. If it wasn't you, please just remove this e-mail and
ignore it. Otherwise, please click the below or copy it to your browser's 
address bar:

${LINK_PREFIX}/resetpassword/hash=%s

The following link does not expire.

Please note this is an automatically generated message. Please do not reply to
it. Should you have any questions, please contact the server admin at
${adminemail}

Yours sincerely,
${domain} admin
MESSAGE;

$messages[MSG_RESETPASSWORD_MAIL_TITLE]=<<<MESSAGE
Reset your password at ${domain}
MESSAGE;

$messages[MSG_RESETPASSWORD_MAIL_SENT]=<<<MESSAGE
To reset your password, please visit the link in the e-mail we have just 
sent you.
MESSAGE;

$messages[MSG_LOGIN_OR_EMAIL_INVALID]=<<<MESSAGE
Either the login or e-mail field is not valid.
Please make sure the account is registered and try again.
MESSAGE;

$messages[MSG_INVALID_HASH]=<<<MESSAGE
The given hash is invalid. Please make sure the 
link you have clicked is not corrupt.
MESSAGE;

///////////

$messages[MSG_PASSWORD_RECOVERY_TITLE]=<<<MESSAGE
password recovery
MESSAGE;

$messages[MSG_NEW_PASSWORD_INPUTS]=<<<MESSAGE
Choose a new password: <input type="password" name="pass1" /> <br />
Repeat new password: <input type="password" name="pass2" /> <br />
MESSAGE;

$messages[MSG_CHANGE_PASSWORD_TITLE]=<<<MESSAGE
change password
MESSAGE;

$messages[MSG_OLD_NEW_PASSWORD_INPUTS]=<<<MESSAGE
      Old password: <input type="password" name="oldpass" /> <br />
      Choose a new password: <input type="password" name="pass1" /> <br />
      Repeat new password: <input type="password" name="pass2" /> <br />
MESSAGE;

$messages[MSG_LOGIN_EMAIL_INPUTS]=<<<MESSAGE
Login: <input type="text" name="login" /> <br />
E-mail address: <input type="text" name="email" /> <br />
MESSAGE;

/////

$messages[MSG_OPERATION_FAILED_REASONS]=<<<MESSAGE
The operation failed due to the following reasons: 
MESSAGE;
