<?php
if (!empty($_POST['newsletter_email']) && isset($_REQUEST))
{
	echo 'ok';
}
else
{
	return 'wrong';
}