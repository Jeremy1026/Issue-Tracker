<?php

 	include_once('./inc/init.php');
	
	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
	$dbo->connect();

	$comment = new iComment($dbo);
	if ($comment->createComment(fSession::get('ticket'),fRequest::get('comment'),fSession::get('user_id'))) {
		header("location:../ticket/".fSession::get('ticket'));
	}
	
?>