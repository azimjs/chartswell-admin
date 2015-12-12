<?php
/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 11/19/2015
 * Time: 5:59 PM
 */

session_start();
unset($_SESSION['login_user']);
header("location: login.php"); // Redirecting To Other Page
