<!DOCTYPE html>
<html>
	<head>
		<title>Issue Tracker Home</title>
		<link rel="stylesheet" href="./inc/css/kube/kube.css" type="text/css">
	</head>
	<body>
		<div class="wrapper" style="width: 320px; height: 300px; margin-left: -160px; margin-top: -150px; left:50%; top:50%; position: absolute;">

<?php
 	include_once('./inc/init.php');

	try {
		$validator = new fValidation();
		$validator->addRequiredFields('user_email', 'user_password');
		$validator->addEmailFields('user_email');
		$validator->validate();
	    echo "form valid";

		// Here would be the action of the contact form, such as sending an email
	}
	catch (fValidationException $e) {
	    fMessaging::create('error', $e->getMessage());
	    echo "form invalid";
	}
?>

		</div>
	</body>
</html>
