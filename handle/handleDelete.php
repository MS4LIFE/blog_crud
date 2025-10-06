<?php

require_once __DIR__ . "/../inc/conn.php";


// <!--Start Authorization handle-->
if (!isset($_SESSION['user_id'])) {
    $_SESSION['errors'] = ['You Must Login First'];
    header("location:../login.php");
    exit;
}


if (!isset($_GET['id'])) {
    header("location:../index.php");
}

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id=$id";
$res = mysqli_query($conn, $query);

if ($res && mysqli_num_rows($res) == 1) {

    $oldImage = mysqli_fetch_assoc($res)['image'];
    if (!empty($oldImage)) {
        unlink("../assets/images/postImage/$oldImage");
    }

    $query = "DELETE FROM posts WHERE id=$id";

    $res = mysqli_query($conn, $query);
    $_SESSION['success'] = "Post Deleted Successfully";
    header("location:../deletePost.php");
    exit;
} else {
    $_SESSION['errors'] = ["Post Not Found"];
    header("location:../index.php");
    exit;
}