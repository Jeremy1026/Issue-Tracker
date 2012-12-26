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

 	var_dump($user->searchUsers('name','jeremy', false));

?>