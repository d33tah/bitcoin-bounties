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
contact the administrator at <a href=\"mailto:${adminemail}\">${adminemail}</a>.
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
Hello %LOGIN%,

Someone with the IP address %REMOTEIP% tried to register a username '%LOGIN%'
and entered your e-mail address on the website %DOMAIN%. If it wasn't you,
please just remove this e-mail and ignore it. Otherwise, please click the below
or copy it to your browser's address bar to confirm that your e-mail address 
is valid:

%LINK_PREFIX%/confirm/hash=%HASH2%

The following link will expire within 24 hours.

Please note this is an automatically generated message. Please do not reply to
it. Should you have any questions, please contact the server admin at
%ADMINEMAIL%

Yours sincerely,
%DOMAIN% admin
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
