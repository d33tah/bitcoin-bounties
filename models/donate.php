<?php
$registered_message=<<<HEREDOC
	<p>
		You are about to donate a bounty as a <strong>registered</strong> user.
		This gives you the rights to vote on whether you accept or not
		particular solutions to the bounty you chose. You can read about the 
		rules <a href="%LINK_PREFIX%/about/">here</a>. Please send the donation to the
		following bitcoin address:
	</p>
	
	<pre class="donate_address">
%ADDRESS%
	</pre>
	
	<p>
		This particular address is for your transactions only. Should you 
		decide to withdraw your donation, all the transactions from this address
		will be reverted.
		Note that the number of votes is proportional to the amount of money 
		you donate - the more you donate, the more influence on the bounty you
		have!
	</p>
HEREDOC;

$unregistered_message=<<<HEREDOC
	<p>
		You are about to donate a bounty as an <strong>unregistered</strong> 
		user. This gives you no rights to vote on bounty submissions; you can 
		read about the rules <a href="%LINK_PREFIX%/about/">here</a>. Please send the 
		donation to the following bitcoin address:
	</p>
	
	<pre class="donate_address">
%BOUNTY_ADDRESS%
	</pre>
	
	<p>
		This is a public address created for this bounty only. The donation
		you send will be returned to you after a year if there will send his
		submissions to this bounty. Also, the system will automatically vote in
		your name in favour of any submissions sent. Should you want to change 
		it, sign in below:
	</p>
	
	<form method="post" action="/login/redirect=/donate/%BOUNTY_ID%">
		Login: <input type="text" name="login" /> <br />
		Password: <input type="password" name="password" /> <br />
		<input type="submit" value="Submit" />
	</form>
	
	<p>
		<a href="%LINK_PREFIX%/resetpassword/">Forgot the password?</a>
	</p>
	
	<p>
		<a href="%LINK_PREFIX%/signup">Don't have an account yet? Click here to sign up.</a>
	</p>
	
HEREDOC;

$tpl->replace("BOUNTYDESC","Przykladowy tytul");
$tpl->replace("MESSAGE",$unregistered_message);
$tpl->replace("BOUNTY_ADDRESS","1MKa9ekqevWdjjY97HYJ62nNNfahM3Qvhw");
$tpl->replace("ADDRESS","1MKa9ekqevWdjjY97HYJ62nNNfahM3Qvhw");