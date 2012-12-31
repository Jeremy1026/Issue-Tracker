<?php

	include_once('./inc/init.php');
	
	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
	$dbo->connect();

	$issue = new iIssue($dbo);

	header("location:../ticket/".$issue->createIssue(fRequest::get('application'),
													 fRequest::get('title'),
													 fRequest::get('description'),
													 fSession::get('user_id'),
													 fRequest::get('users_assigned'),
													 fRequest::get('tags')));

	
?>