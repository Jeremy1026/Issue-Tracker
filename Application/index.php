<?php
/**
 * Jeremy Curcio
 *
 * @link      www.jcurcio.com
 * @copyright Copyright (c) 2012 Jeremy Curcio
 * @license   All code contained below is owned by Copyright holder(s) and may not be distributed.
 * @program	  Issue Tracker
 */

 	require_once('/classes/user.php');

 	$user = new user('Jeremy','Jeremy1026@gmail.com','1');
 	var_dump($user->getUser());


?>