<?php

require_once __DIR__ . "/../../inc/conn.php";
//submit
if (isset($_POST['submit'])) {


    //errors
    $errors = [];

    //catch data
    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $email =  filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = trim(htmlspecialchars($_POST["password"]));
    $phone = trim(htmlspecialchars($_POST["phone"]));

    //validation
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);


    //error handling

    if (empty($name)) {
        $errors[] = 'Name Is Required';
    } else if (empty($email)) {
        $errors[] = 'Email Is Required';
    } elseif (empty($password)) {
        $errors[] = 'Password Is Required';
    } elseif (empty($phone)) {
        $errors[] = 'Phone Is Required';
    }


    //insert
    if (empty($errors)) {

        $query = "INSERT INTO users(`name`,`email`,`password`,`phone`) VALUES('$name','$email','$passwordHashed','$phone') ";

        $res = mysqli_query($conn, $query);

        if ($res) {
            $_SESSION['success'] = "Registered Successfully";
            header("location:../../login.php");
            exit;
        } else {
            $_SESSION['errors'] = "Error While Inserting Data";
            header("location:../register.php");
            exit;
        }
    }
} else {
    header("location:../register.php");
    $_SESSION['errors'] = ['Data is not inserted'];
    exit;
}
