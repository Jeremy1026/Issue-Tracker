<?php
 	include_once('./inc/init.php');
	
	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
	$dbo->connect();

	$user = new iUser($dbo);
	$issue = new iIssue($dbo);

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	//Fix for running off local server, shouldn't be necessary on production environment.
	else {
		$id = substr($_SERVER['PATH_INFO'],1,strlen($_SERVER['PATH_INFO']-1));
	}
	fSession::set('ticket', $id);
	if (fSession::get('user_id')) {
		include('./HTML/ticket.html');
	}
	else {
		header("location:../?redirect={$_SERVER["REQUEST_URI"]}");
	}	
	
?>