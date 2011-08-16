<?php
if ($udb->try_confirm($_GET["hash"]))
{
$message = "Your account is now confirmed. You may log in using it to freely
access the website.";
}
else
{
$message = "<p>There was an error with the confirmation link. Make sure your
account isn't already confirmed, the link is not outdated or damaged.<br /></p>
<p>Keep in mind that a single confirmation link is valid only for the 24 hours
since generation time. After that time it expries and the account gets deleted.</p>";
}

$tpl->replace("MESSAGE",$message);
