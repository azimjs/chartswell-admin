<?php
session_start();

include("../parse.php");

error_reporting(0);
$redirect_page = "view_brands.php";
use Parse\ParseUser;
use Parse\ParseException;
if(isset($_SESSION['login_user'])){
    header("location: $redirect_page"); // Redirecting To Other Page
}

$error= false; // Variable To Store Error Message
if (isset($_POST['login_submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = true;
    }
    else
    {
// Define $username and $password
        $displayToast = "";
        $username=$_POST['username'];
        $password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
// Selecting Database

        try {
            $user = ParseUser::logIn($username, $password);
            // Do stuff after successful login.
            $_SESSION['login_user']=$username; // Initializing Session
            header("location: $redirect_page"); // Redirecting To Other Page
        } catch (ParseException $error) {
            // The login failed. Check error to see why.
            $error = true;
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Chartswell </title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link type="text/css" href="../js/resources/css/jquery.toastmessage.css" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <center>
                        <img src="../dining_services_logo_green.jpg" alt="" style="width: 120px">
                        </center>
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <?php if($error){?>
                                <div class="alert alert-danger">
                                    Invalid Username or Password. Please try again.
                                </div>
                                <?php } ?>
                                <input type="submit" name="login_submit" class="btn btn-lg btn-success btn-block" value="LOGIN" />
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.toastmessage.js"></script>

    <script type="text/javascript">

        function showSuccessToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'top-right',
                type     : 'success',
                closeText: '',
                close    : function () {
                    console.log("toast is closed ...");
                }
            });
        }

        function showNoticeToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'top-right',
                type     : 'notice',
                closeText: '',
                close    : function () {console.log("toast is closed ...");}
            });
        }

        function showWarningToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'top-right',
                type     : 'warning',
                closeText: '',
                close    : function () {
                    console.log("toast is closed ...");
                }
            });
        }

        function showErrorToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'top-right',
                type     : 'error',
                closeText: '',
                close    : function () {
                    console.log("toast is closed ...");
                }
            });
        }

    </script>

    <?php
    if(isset($displayToast))
        echo "<script type='text/javascript'>showSuccessToast('message',false)</script>";
    ?>


</body>

</html>
