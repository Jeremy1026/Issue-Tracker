<?php

	include_once('./inc/init.php');

	$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
	$dbo->connect();

	$user = new iUser($dbo);
	$user->getUserNames();

?>
