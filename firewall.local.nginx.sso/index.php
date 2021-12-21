<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

    <head>
        <title>Cyberdev > SSO</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="expires" content="-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#514a9d" />
        <link rel="icon" type="image/x-icon" href="/auth_sso/icons/favicon.ico">
        <link rel="shortcut icon" type="image/x-icon" href="/auth_sso/icons/favicon.ico">
        <link rel="stylesheet" type="text/css" href="/auth_sso/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/auth_sso/css/fonts.css">
        <link rel="stylesheet" type="text/css" href="/auth_sso/css/google-material-icons.css">
        <link rel="stylesheet" type="text/css" href="/auth_sso/css/effects.css">
        <link rel="stylesheet" type="text/css" href="/auth_sso/css/style.css">
        <script src="/auth_sso/js/jquery-3.3.1.min.js"></script>
        <script src="/auth_sso/js/bootstrap.min.js"></script>
        <script src="/auth_sso/js/popper.min.js"></script>
    </head>

    <body>
            <nav class="navbar navbar-expand-sm fixed-top navbar-dark nav-background">
              <a class="navbar-brand" href="">
                <img src="/auth_sso/icons/favicon32.png" width="32px" height="32px" class="d-inline-block align-top" alt="">
                <span class="nav-logo-text">CyberDev SSO</span>
              </a>
              <button class="navbar-toggler RightToLeftSlide" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-icons Fade-In">menu</span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href=""><span class="material-icons d-inline-block align-top Fade-In">lock</span> Log On <span class="sr-only">(current)</span></a>
                  </li>
                </ul>
              </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-2">
                        <div id="form_background" class="Fade-In">
<?php
    ini_set('session.sid_length','32');
    ini_set('session.hash_bits_per_character','5');
    ini_set('session.hash_function','sha256');
    //session_name('nginxSso_'.substr(base64_encode(hash('sha256',random_int(1024,100240))),0,16));
    session_start();
    //session_regenerate_id();

    if(isset($_GET['uri']))
    {
        $_SESSION['uri'] = $_GET['uri'];
    }
    else
    {
        $_SESSION['uri'] = '/';   
    }

    if(isset($_SESSION['user_id']))
    {
        echo '
                            <form name="logout" action="/auth_sso/logout.php" method="post">
                                <h5 id="form_header" class="TopToBottomSlide">Welcome to NGINX SSO</h5>
                                <div id="trial_info">You are accessing secure content!</div>
                                <div class="form-group">
                                    <input id="UserName" class="form-control" name="user_name" type="text" placeholder="'.$_SESSION['user_name'].'" disabled="true" />
                                </div>
                                <div class="form-group">
                                    <input id="Password" class="form-control" name="password" type="password" value="EncryptedKey" placeholder="password" disabled="true" />
                                </div>
                                <button id="SubmitBtn" class="btn btn-success btn-sm btn-block" type="submit">Log Off!</button>
                            </form>
        ';

        if(isset($_SESSION['user_id']))
        {
            echo '<div id="error_text" style="color: #36C14F">You have successfully logged in!</div>';
        }
    }

    else
    {
        echo '
                            <form name="login" action="/auth_sso/login.php" method="post">
                                <h5 id="form_header" class="TopToBottomSlide">Welcome to NGINX SSO</h5>
                                <div id="trial_info">Please log in to access secure content!</div>
                                <div class="form-group">
                                    <input id="UserName" class="form-control" name="user_name" type="text" placeholder="user id" required="true" />
                                </div>
                                <div class="form-group">
                                    <input id="Password" class="form-control" name="password" type="password" placeholder="password" required="true" />
                                </div>
                                <button id="SubmitBtn" class="btn btn-success btn-sm btn-block" type="submit">Log On!</button>
                            </form>
        ';

        if(!isset($_GET['LoginAttempt']))
        {
            echo '<div id="error_text" style="color: #FF8080">You are not logged in!</div>';
        }
        else
        {
            if($_GET['LoginAttempt']="failed")
            {
                echo '<div id="error_text" style="color: #FF8080">Log in failed!</div>';
            }
        }

        if(isset($_GET['LogoutAttempt']))
        {
            if($_GET['LogoutAttempt']="failed")
            {
                echo '<div id="error_text" style="color: #FF8080">You have to Log in first!</div>';
            }
        }
    }
?>
                        </div><!--
                        <div id="powered_by_text" class="BottomToTopSlide">Powered by: Nginx SSO by Debdut</div>-->
                    </div>
                </div>
            </div>
    </body>
</html>