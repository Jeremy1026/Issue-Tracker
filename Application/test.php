<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */


 	include_once('./inc/init.php');

 	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
 	$dbo->connect();


//	$user = new iUser($dbo);

 //	$user->createUser('Jeremy Curcio', 'Jeremy1026@gmail.com');

//	var_dump($user->getUser('1'));


//	var_dump($user->getUser(6));
//	var_dump($user->getUser(2));

//	var_dump($user);
	$issue = new iIssue($dbo);
//	$issue->createIssue('Bug in Issue Tracker',	'Nothing really works yet.', 6, '1,2,6', 'General,PHP,Error');

//	var_dump($issue->searchIssues('status',1));

//	var_dump($issue->searchIssues('status',1));
//	$issue->updateIssue(6,'Bug when updating tickets.','When updating a ticket everything seems to break uncontrollably','1,6','General,PHP,Error');


	$comment = new iComment($dbo);
	var_dump($comment->alertUsers(1));

	var_dump($_SERVER);
	
?>