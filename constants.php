<?php

assume_index();

$consts_list=<<<LIST
MSG_LOGIN_TOO_SHORT
MSG_LOGIN_TOO_LONG
MSG_LOGIN_REGEX
MSG_PASS_TOO_SHORT
MSG_PASS_TOO_LONG
MSG_PASS_DONT_MATCH
MSG_EMAIL_REGEX
MSG_EMAIL_TAKEN
MSG_LOGIN_TAKEN
MSG_INVALID_CAPTCHA
MSG_CONFIRMATION_EMAIL
MSG_CONFIRMATION_EMAIL_TITLE
MSG_CONFIRMATION_EMAIL_SENT
MSG_REGISTRATION_FAILED_LIST
MSG_BOUNTY_ADDED
MSG_DONATE_REGISTERED
MSG_DONATE_UNREGISTERED
MSG_VOTEUP_SUCCESS
MSG_BOUNTY_GATHERED
MSG_BOUNTY_GATHERED_TITLE
MSG_CONFIRATION_LINK_INVALID
MSG_ACCOUNT_CONFIRMED
MSG_ACCOUNT_NOT_CONFIRMED_YET
MSG_LOGIN_DATA_INVALID
MSG_LOGIN_FAILED_REASONS
MSG_PASSWORD_CHANGED
MSG_NO_REAL_PASSWORD_CHANGE
MSG_NEW_PASSWORD_TOO_LONG
MSG_NEW_PASSWORD_TOO_SHORT
MSG_NEW_PASSWORDS_DIFFER
MSG_RESETPASSWORD_MAIL
MSG_INVALID_OLD_PASSWORD
MSG_FILL_REQUIRED_FIELDS
MSG_RESETPASSWORD_MAIL_TITLE
MSG_RESETPASSWORD_MAIL_SENT
MSG_LOGIN_OR_EMAIL_INVALID
MSG_INVALID_HASH
MSG_PASSWORD_RECOVERY_TITLE
MSG_NEW_PASSWORD_INPUTS
MSG_CHANGE_PASSWORD_TITLE
MSG_OLD_NEW_PASSWORD_INPUTS
MSG_LOGIN_EMAIL_INPUTS
MSG_OPERATION_FAILED_REASONS
MSG_BOUNTY_SYSTEM_RULES
MSG_ADDRESSNOTFOUND
MSG_SOLUTIONS_LIST_FOR
MSG_SOLUTIONS_LIST
MSG_SOLUTIONS_LIST_CAPITAL
MSG_AUTHOR
MSG_VOTES
MSG_VOTE_UP
MSG_ADDSOLUTION
MSG_DONATE_BOUNTY_X
MSG_DONATE_BOUNTY
MSG_DONATING_A_BOUNTY
MSG_BOUNTIES_LIST
MSG_DESCRIPTION
MSG_COLLECTED
MSG_ADD_BOUNTY
MSG_LOG_IN
MSG_LOGIN
MSG_PASSWORD
MSG_REMEMBER_ME
MSG_VERIFICATION_CAPTCHA
MSG_FORGOT_PASSWORD
MSG_HAVE_NO_ACCOUNT_SIGN_UP
MSG_A_MESSAGE
MSG_ADD_NEW_BOUNTY_TITLE
MSG_TITLE
MSG_DESCRIPTION_COLON
MSG_SUBMIT
MSG_ADD_SOLUTION_TITLE
MSG_COMMENTS
MSG_BOUNTY_PAYOUT
MSG_PASSWORD_RECOVERY
MSG_SIGN_UP_TITLE
MSG_REPEAT_PASSWORD
MSG_EMAIL
MSG_VIEWING_X
MSG_VIEW_BOUNTY
MSG_DONATIONS_COLLECTED
MSG_DONATE_BUTTON
MSG_SOLUTIONS_TO_VOTE
MSG_SUBMIT_BUTTON
MSG_VIEW_BUTTON
MSG_VIEWING_SOLUTION_TO_BY
MSG_VIEWING_SOLUTION_BY
MSG_TO_X
MSG_FILE_NAME
MSG_FILE_SIZE
MSG_REDIRECTING
MSG_LOGGED_IN_AS
MSG_LOGOUT_BUTTON
MSG_LOGIN_BUTTON
MSG_SIGN_UP_BUTTON
MSG_BACK_TO_HOMEPAGE
MSG_BOUNTY_PAYOUT_SUCCESS
MSG_INVALID_ADDRESS_GIVEN
MSG_ENTER_PAYOUT_ADDRESS
MSG_NO_PAYOUT
MSG_NEED_LOGIN
MSG_NEED_LOGOUT
MSG_NO_BOUNTIES_YET
MSG_EMAIL_SENDING_ERROR
MSG_NO_SOLUTIONS_YET
MSG_SOLUTION_NOT_FOUND
MSG_BOUNTY_NOT_FOUND
MSG_NO_SOLUTION_GIVEN
MSG_NO_BOUNTY_GIVEN
MSG_LOGIN_NEEDED
MSG_ERROR
MSG_FILE_UPLOAD_ERROR
MSG_TITLE_TOO_SHORT
MSG_TITLE_TOO_LONG
MSG_TITLE_REGEX
MSG_DESCRIPTION_TOO_SHORT
MSG_DESCRIPTION_TOO_LONG
MSG_DESCRIPTION_REGEX
MSG_BOUNTY_ADDING_FAILED_LIST
MSG_BOUNTY_TITLE_EXISTS
MSG_SOLUTION_ADDED
MSG_SOLUTION_ADDING_FAILED_LIST
MSG_ILLEGAL_FILENAME
MSG_FILENAME_EXISTS
MSG_FILE_EMPTY
MSG_DELETED_USER
MSG_UNDO_VOTE
MSG_BOUNTY_LOCKED
MSG_BOUNTY_X
MSG_VOTEDOWN_SUCCESS
MSG_BOUNTY_WAS_LOCKED
MSG_ALREADY_VOTED
MSG_CANT_DONATE_LOCKED
MSG_BOUNTY_WAS_LOCKED_CANT_SOLUTION
MSG_BOUNTY_WAS_LOCKED_CANT_ADD_SOLUTION
MSG_SUB_ADD_BOUNTY
MSG_BLOCK_NUM
MSG_EXEC_TIME
LIST;

$curr=0;
foreach (preg_split("[\n|\r]", $consts_list) as $value)
{
  if(defined($value))
    echo "WTF! Redefining $value!\n<br />";
  define($value,$curr);
  $curr++;
}
