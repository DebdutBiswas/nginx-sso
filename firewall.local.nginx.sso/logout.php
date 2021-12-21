<?php
	session_start();
	//session_regenerate_id();

	//include 'connectdb.php';

	if(isset($_SESSION['user_id']))
	{
		session_unset();
		session_destroy();

		//mysqli_close($link);

		header('Location: /',true,301);
	}
	else
	{
		header('Location: /auth_sso/?LogoutAttempt="failed"',true,301);
	}
?>