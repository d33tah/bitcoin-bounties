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
<a href="mailto:${adminemail}">${adminemail}</a>.
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
and entered your e-mail address on the website ${domain}. If it wasn't you,
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
You can view it <a href=%s>here</a>. You will be automatically redirected to
 this page in 5 seconds.
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

%s
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
Your commit was accepted and is ready to be paid out!
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

$messages[MSG_ADDRESSNOTFOUND]=<<<MESSAGE
Sorry, the address you requested was not found.
MESSAGE;

$messages[MSG_BOUNTY_SYSTEM_RULES]=<<<MESSAGE
bounty system rules
MESSAGE;

$messages[MSG_COMMITS_LIST_FOR]=<<<MESSAGE
commits list for %s
MESSAGE;

$messages[MSG_COMMITS_LIST]=<<<MESSAGE
commits list
MESSAGE;

$messages[MSG_COMMITS_LIST_CAPITAL]=<<<MESSAGE
Commits list
MESSAGE;

$messages[MSG_AUTHOR]=<<<MESSAGE
Author
MESSAGE;

$messages[MSG_VOTES]=<<<MESSAGE
votes
MESSAGE;

$messages[MSG_VOTE_UP]=<<<MESSAGE
VOTE UP
MESSAGE;

$messages[MSG_ADDCOMMIT]=<<<MESSAGE
Add a new commit!
MESSAGE;

$messages[MSG_DONATE_BOUNTY_X]=<<<MESSAGE
donate a bounty '%s'
MESSAGE;

$messages[MSG_DONATE_BOUNTY]=<<<MESSAGE
donate a bounty
MESSAGE;

$messages[MSG_DONATING_A_BOUNTY]=<<<MESSAGE
donating a bounty
MESSAGE;

$messages[MSG_BOUNTIES_LIST]=<<<MESSAGE
bounties list
MESSAGE;

$messages[MSG_DESCRIPTION]=<<<MESSAGE
Description
MESSAGE;

$messages[MSG_COLLECTED]=<<<MESSAGE
Collected
MESSAGE;

$messages[MSG_ADD_BOUNTY]=<<<MESSAGE
Add a new bounty!
MESSAGE;

$messages[MSG_LOG_IN]=<<<MESSAGE
log in
MESSAGE;

$messages[MSG_LOGIN]=<<<MESSAGE
Login:
MESSAGE;

$messages[MSG_PASSWORD]=<<<MESSAGE
Password:
MESSAGE;

$messages[MSG_REMEMBER_ME]=<<<MESSAGE
Remember me
MESSAGE;

$messages[MSG_VERIFICATION_CAPTCHA]=<<<MESSAGE
Verification CAPTCHA (please repeat the text below):
MESSAGE;

$messages[MSG_FORGOT_PASSWORD]=<<<MESSAGE
Forgot the password?
MESSAGE;

$messages[MSG_HAVE_NO_ACCOUNT_SIGN_UP]=<<<MESSAGE
Don't have an account yet? Click here to sign up.
MESSAGE;

$messages[MSG_A_MESSAGE]=<<<MESSAGE
a message
MESSAGE;

$messages[MSG_ADD_NEW_BOUNTY_TITLE]=<<<MESSAGE
add a new bounty
MESSAGE;

$messages[MSG_TITLE]=<<<MESSAGE
Title: 
MESSAGE;

$messages[MSG_DESCRIPTION_COLON]=<<<MESSAGE
Description:
MESSAGE;

$messages[MSG_SUBMIT]=<<<MESSAGE
Submit
MESSAGE;

$messages[MSG_ADD_COMMIT_TITLE]=<<<MESSAGE
add a new commit
MESSAGE;

$messages[MSG_COMMENTS]=<<<MESSAGE
Comments:
MESSAGE;

$messages[MSG_BOUNTY_PAYOUT]=<<<MESSAGE
bounty payout
MESSAGE;

$messages[MSG_PASSWORD_RECOVERY]=<<<MESSAGE
password recovery
MESSAGE;

$messages[MSG_SIGN_UP_TITLE]=<<<MESSAGE
sign up
MESSAGE;

$messages[MSG_REPEAT_PASSWORD]=<<<MESSAGE
Repeat password:
MESSAGE;

$messages[MSG_EMAIL]=<<<MESSAGE
E-mail address:
MESSAGE;

$messages[MSG_VIEWING_X]=<<<MESSAGE
viewing '%s'
MESSAGE;

$messages[MSG_VIEW_BOUNTY]=<<<MESSAGE
view a bounty
MESSAGE;

$messages[MSG_DONATIONS_COLLECTED]=<<<MESSAGE
Donations collected:
MESSAGE;

$messages[MSG_DONATE_BUTTON]=<<<MESSAGE
DONATE
MESSAGE;

$messages[MSG_SUBMISSIONS_TO_VOTE]=<<<MESSAGE
Submissions to vote:
MESSAGE;

$messages[MSG_SUBMIT_BUTTON]=<<<MESSAGE
SUBMIT
MESSAGE;

$messages[MSG_VIEW_BUTTON]=<<<MESSAGE
VIEW
MESSAGE;

$messages[MSG_VIEWING_COMMIT_TO_BY]=<<<MESSAGE
viewing a commmit to '%s' by %s
MESSAGE;

$messages[MSG_VIEWING_COMMIT_BY]=<<<MESSAGE
view a commit by %s
MESSAGE;

$messages[MSG_TO_X]=<<<MESSAGE
To '%s'
MESSAGE;

$messages[MSG_FILE_NAME]=<<<MESSAGE
File name:
MESSAGE;

$messages[MSG_FILE_SIZE]=<<<MESSAGE
File size:
MESSAGE;

$messages[MSG_REDIRECTING]=<<<MESSAGE
redirecting...
MESSAGE;

$messages[MSG_LOGGED_IN_AS]=<<<MESSAGE
Logged in as '%s'
MESSAGE;

$messages[MSG_LOGOUT_BUTTON]=<<<MESSAGE
Log out
MESSAGE;

$messages[MSG_LOGIN_BUTTON]=<<<MESSAGE
Login
MESSAGE;

$messages[MSG_SIGN_UP_BUTTON]=<<<MESSAGE
Sign up
MESSAGE;

$messages[MSG_BACK_TO_HOMEPAGE]=<<<MESSAGE
Back to the homepage
MESSAGE;

$messages[MSG_BOUNTY_PAYOUT_SUCCESS]=<<<MESSAGE
The bounty was paid out successfully!
MESSAGE;

$messages[MSG_INVALID_ADDRESS_GIVEN]=<<<MESSAGE
You typed in an invalid address!
MESSAGE;

$messages[MSG_ENTER_PAYOUT_ADDRESS]=<<<MESSAGE
You earned %s. Just type in the address you want it to be 
transferred to:
MESSAGE;

$messages[MSG_NO_PAYOUT]=<<<MESSAGE
No bounty to be paid out.
MESSAGE;

$messages[MSG_NEED_LOGIN]=<<<MESSAGE
This function is restricted to the users that are already logged in. 
You have to log in to access it. Please enter your log in data below:
MESSAGE;

$messages[MSG_NEED_LOGOUT]=<<<MESSAGE
This function is restricted to the users that are already logged out. 
If you wish to access it, please click the 'logout' button on the top of the
screen.
MESSAGE;

$messages[MSG_NO_BOUNTIES_YET]=<<<MESSAGE
There are no bounties to browse yet! How about adding one using the link 
below?
MESSAGE;

$messages[MSG_EMAIL_SENDING_ERROR]=<<<MESSAGE
There was a problem while sending your confirmation e-mail. Please double
check your e-mail address, try again after some time, and if everything fails,
contact the administrator at <a href="mailto:${adminemail}">${adminemail}</a>.
MESSAGE;

$messages[MSG_NO_COMMITS_YET]=<<<MESSAGE
There are no commits to browse yet! How about adding one using the link 
below?
MESSAGE;

$messages[MSG_COMMIT_NOT_FOUND]=<<<MESSAGE
The specified commit was not found.
MESSAGE;

$messages[MSG_BOUNTY_NOT_FOUND]=<<<MESSAGE
The specified bounty was not found.
MESSAGE;

$messages[MSG_NO_COMMIT_GIVEN]=<<<MESSAGE
No commit ID was given in the website URL. Please check if the address is not
corrupt.
MESSAGE;

$messages[MSG_NO_BOUNTY_GIVEN]=<<<MESSAGE
No bounty ID was given in the website URL. Please check if the address is not
corrupt.
MESSAGE;

$messages[MSG_LOGIN_NEEDED]=<<<MESSAGE
login needed
MESSAGE;

$messages[MSG_ERROR]=<<<MESSAGE
error
MESSAGE;

$messages[MSG_FILE_UPLOAD_ERROR]=<<<MESSAGE
There was an error while uploading your file. Try again, making sure it is
not too big or contains illegal data.
MESSAGE;

$messages[MSG_TITLE_TOO_SHORT]=<<<MESSAGE
The title you have entered is too short. Please choose a different one.
MESSAGE;

$messages[MSG_TITLE_TOO_LONG]=<<<MESSAGE
The title you have entered is too long. Please choose a different one.
MESSAGE;

$messages[MSG_TITLE_REGEX]=<<<MESSAGE
The title you have entered contains illegal characters. 
Please choose  a different one.
MESSAGE;

$messages[MSG_DESCRIPTION_TOO_SHORT]=<<<MESSAGE
The description you have entered is too short. Please choose a different one.
MESSAGE;

$messages[MSG_DESCRIPTION_TOO_LONG]=<<<MESSAGE
The description you have entered is too long. Please choose a different one.
MESSAGE;

$messages[MSG_DESCRIPTION_REGEX]=<<<MESSAGE
The description you have entered contains illegal characters. 
Please choose  a different one.
MESSAGE;

$messages[MSG_BOUNTY_ADDING_FAILED_LIST]=<<<MESSAGE
The bounty submission failed due to the following reasons: 
MESSAGE;

$messages[MSG_BOUNTY_TITLE_EXISTS]=<<<MESSAGE
A bounty with the same title already exist.
MESSAGE;


$messages[MSG_COMMIT_ADDED]=<<<MESSAGE
Your commit was successfully added. 
You can view it <a href=%s>here</a>. You will be automatically redirected to
 this page in 5 seconds.
MESSAGE;

$messages[MSG_COMMIT_ADDING_FAILED_LIST]=<<<MESSAGE
The commit submission failed due to the following reasons: 
MESSAGE;

$messages[MSG_ILLEGAL_FILENAME]=<<<MESSAGE
The name of the file you have uploaded is illegal. Please change it and
try again. Uploading PHP files is not allowed due to the security policy.
MESSAGE;

$messages[MSG_FILENAME_EXISTS]=<<<MESSAGE
The name of the file you have uploaded conflicts with an already uploaded
file. Please change it and try again.
MESSAGE;

$messages[MSG_FILE_EMPTY]=<<<MESSAGE
The file you have tried to upload is empty. Please try again with a correct
file.
MESSAGE;

$messages[MSG_DELETED_USER]=<<<MESSAGE
(deleted user)
MESSAGE;

$messages[MSG_UNDO_VOTE]=<<<MESSAGE
UNDO VOTE
MESSAGE;

$messages[MSG_BOUNTY_LOCKED]=<<<MESSAGE
<strong>NOTE:</strong> This is a locked bounty. You cannot edit it, it is here
for archival purposes only.
MESSAGE;

$messages[MSG_BOUNTY_X]=<<<MESSAGE
Bounty '%s'
MESSAGE;

$messages[MSG_VOTEDOWN_SUCCESS]=<<<MESSAGE
You have just voted down a submission. We will redirect you back to the
submissions' list now. If it doesn't happen, click 
<a href="${LINK_PREFIX}/commits/id=%s">here</a>.
MESSAGE;

$messages[MSG_BOUNTY_WAS_LOCKED]=<<<MESSAGE
Failed to vote - the bounty has already ended!
MESSAGE;

$messages[MSG_ALREADY_VOTED]=<<<MESSAGE
You cannot vote on more than one commit! Please undo your current vote and 
vote again if you changed your mind.
MESSAGE;

$messages[MSG_CANT_DONATE_LOCKED]=<<<MESSAGE
This bounty has already ended and cannot be donated now. How about donating
another bounty?
MESSAGE;

$messages[MSG_BOUNTY_WAS_LOCKED_CANT_COMMIT]=<<<MESSAGE
Failed to add the commit - the bounty has already ended!
MESSAGE;

$messages[MSG_BOUNTY_WAS_LOCKED_CANT_ADD_COMMIT]=<<<MESSAGE
Cannot add a commit - the bounty has already ended!
MESSAGE;
