<?php

require_once __DIR__ . "/../inc/conn.php";

//submit
if (isset($_POST['submit'])) {

    //errors
    $errors = [];

    //catch data & validation
    $email = filter_var(
        trim(
            htmlspecialchars(
                $_POST["email"]
            )
        ),
        FILTER_VALIDATE_EMAIL
    );
    $password = trim(htmlspecialchars($_POST["password"]));



    //check credentials
    $query = "SELECT id ,name, password FROM users WHERE `email`='$email'";
    $res = mysqli_query($conn, $query);

    if ($res && mysqli_num_rows($res) == 1) {

        $user = mysqli_fetch_assoc($res);
        $id = $user['id'];
        $name = $user['name'];
        $oldPassword = $user['password'];
        // تحقق من انه نفس الباسوورد في قاعدة البيانات
        $verify =  password_verify($password, $oldPassword);
        if ($verify) {
            $_SESSION['user_id'] = $id;
            $_SESSION['success'] = "Login successful. Welcome $name";
            header("location:../index.php");
            exit;
        } else {
            $_SESSION['errors'] = ["Incorrect Username Or Password"];
            header("location:../login.php");
        }
    } else {
        $_SESSION['errros'] = ["Account Does Not Exist"];
        header("location:../login.php");
        exit;
    }




    if (empty($email)) {
        $errors[] = 'Email Is Required';
    } elseif (empty($password)) {
        $errors[] = 'Password Is Required';
    }
} else {
    $_SESSION['errors'] = ["Wrong Email Or Password "];
    header("location:../login.php");
}