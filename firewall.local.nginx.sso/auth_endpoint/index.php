<?php
	session_start();
	$nginx_sso_token = $_SESSION['user_name'];
    
	if (isset($nginx_sso_token)) {
		header('X-SSO-Token: '.hash(sha256, $nginx_sso_token, false), true, 200);
	}
	else {
		header('X-SSO-Token: ', true, 401);
	}
?>