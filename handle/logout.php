<?php

session_start();

unset($_SESSION['user_id']);

$_SESSION['errors'] = ['You Must Be Logged In First To Logout'];
header("location:../login.php");