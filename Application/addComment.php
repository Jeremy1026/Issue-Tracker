<?php

	include_once('./inc/init.php');
	
	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
	$dbo->connect();

	$comment = new iComment($dbo);
	$issue = new iIssue($dbo);
	if ($comment->createComment(fSession::get('ticket'),fRequest::get('comment'),fSession::get('user_id'))) {
		$issue->issueUpdated(fSession::get('ticket'));
		header("location:../ticket/".fSession::get('ticket'));
	}
	
?>