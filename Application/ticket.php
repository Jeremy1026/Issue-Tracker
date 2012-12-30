<?php
 	include_once('./inc/init.php');
	
	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
	$dbo->connect();

	$user = new iUser($dbo);
	$issue = new iIssue($dbo);

	fSession::set('ticket', $_GET['id']);
	if (fSession::get('user_id')) {
		include('./HTML/ticket.html');
	}
	else {
		header("location:../?redirect={$_SERVER["REQUEST_URI"]}");
	}	
	
?>