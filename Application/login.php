<?php
 	include_once('./inc/init.php');

	try {
		$validator = new fValidation();
		$validator->addRequiredFields('user_email', 'user_password');
		$validator->addEmailFields('user_email');
		$validator->validate();
		
		$dbo = new fDatabase('mysql','main','root','zaq1xswcde');
		$dbo->connect();

		$email = fRequest::get('user_email');
		$password = fRequest::get('user_password');

		$user = new iUser($dbo);
		$id = $user->checkLogin($email, $password);
		
		if ($id) {
			fSession::setLength('3 days');
			fSession::set('user_id', $id);
		
			if (strcmp(fRequest::get('redirect'), "") == 0) {
				header("location:./index.php");
			}
			else {
				header("location:.".fRequest::get('redirect'));
			}
		}
		else {
			header("location:./failed.php");
		}

		// Here would be the action of the contact form, such as sending an email
	}
	catch (fValidationException $e) {
	    fMessaging::create('error', $e->getMessage());
	    echo "form invalid";
	}
?>