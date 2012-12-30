<?php
 	include_once('./inc/init.php');
	
	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
	$dbo->connect();

	$user = new iUser($dbo);
	$issue = new iIssue($dbo);

	if (fSession::get('user_id')) {
		include './HTML/issue_list.html';
	}
	else {
		include './HTML/home.html';
	}

?>