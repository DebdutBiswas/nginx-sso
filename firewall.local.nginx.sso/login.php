<?php
	session_start();
	//session_regenerate_id();

	include 'connectdb.php';

	$user_name = mysqli_real_escape_string($link, $_POST['user_name']);
	$password = mysqli_real_escape_string($link, $_POST['password']);

	$password_hash = hash(sha256,$password,false);
	
	//$sql = "SELECT * FROM nginx_sso WHERE user_name='$user_name' AND password='$password_hash'";
	$sql = "SELECT * FROM nginx_sso WHERE user_name=? AND password=?";
	$stmt = mysqli_stmt_init($link);
	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		session_destroy();
		
		if(!isset($_SESSION['uri']))
		{
			$_SESSION['uri'] = '/';
		}

		header('Location: /auth_sso/?LoginAttempt="failed"&uri='.$_SESSION['uri'],true,301);
	}
	else
	{
		mysqli_stmt_bind_param($stmt,"ss",$user_name,$password_hash);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row=mysqli_fetch_assoc($result);

		if ($row && ($row['password']==$password_hash))
		{
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_name'] = $row['user_name'];
			$_SESSION['user_cookie'] = $row['user_cookie'];

			mysqli_close($link);

			if(isset($_SESSION['user_id']))
			{
				header('Location: '.$_SESSION['uri'],true,301);
			}
		}
		else
		{
			session_destroy();
			
			if(!isset($_SESSION['uri']))
			{
				$_SESSION['uri'] = '/';
			}

			header('Location: /auth_sso/?LoginAttempt="failed"&uri='.$_SESSION['uri'],true,301);
		}
	}
	//$result = mysqli_query($link,$sql);
	//$row=mysqli_fetch_assoc($result);
?>