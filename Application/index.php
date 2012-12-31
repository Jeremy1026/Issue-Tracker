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
	
	/*

	$smtp = new fSMTP('smtp.gmail.com', 465, TRUE, 5);
	$smtp->authenticate('jeremy1026@gmail.com', 'Zaq1xswcde');
	$email = new fEmail();
	$email->addRecipient('j.curcio@me.com', 'Jeremy');
	$email->setFromEmail('jeremy1026@gmail.com');
	$email->setSubject("This won't break email programs because it is properly encoded by the class");
	// Set the body to include a string containing UTF-8
	$email->setBody('This is the body of the email');

	$email->send($smtp);
	
	*/
?>