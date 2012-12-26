<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	include_once('Classes/ClassAutoloader.php');
	$autoloader = new ClassAutoloader();

 	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
 	$dbo->connect();


	$user = new User($dbo);

	$issue = new Issue($dbo);
//	$issue->createIssue('Bug in Issue Tracker',	'Nothing really works.', 6, '1,2,6', 'General,PHP,Error');

	var_dump($issue->searchIssues('status',0));

?>