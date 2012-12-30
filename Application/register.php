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

	function password_check($value) {
		$confirm = fRequest::get('user_confirm_password');
		if (strcasecmp($confirm, $value) == 0) {
			return strlen($value) >= 6;
		}
	}
	
	function register_user() {
		$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
		$dbo->connect();

		$first_name = fRequest::get('user_first_name');
		$last_name = fRequest::get('user_last_name');
		$email = fRequest::get('user_email');
		$password = fRequest::get('user_password');
		$password = fCryptography::hashPassword($password);

		$user = new iUser($dbo);
		$user->createUser($first_name, $last_name, $email, $password);
	}

	try {
		$validator = new fValidation();
		$validator->addRequiredFields('user_first_name', 'user_last_name', 'user_email', 'user_password', 'user_confirm_password');
		$validator->addEmailFields('user_email');
		$validator->addCallbackRule('user_password', 'password_check', 'Please enter at least 8 characters');
		$validator->validate();
	    register_user();
	    
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
