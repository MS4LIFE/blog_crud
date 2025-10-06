<?php

require_once __DIR__ . "/../inc/conn.php";

// <!--Start Authorization handle-->
if (!isset($_SESSION['user_id'])) {
    $_SESSION['errors'] = ['You Must Login First'];
    header("location:../login.php");
    exit;
}


//submit - id - catch - validation - error empty - update
if (isset($_POST['submit']) && isset($_GET['id'])) {


    // Errors handling

    $errors = [];


    $id = $_GET['id'];

    $query = "SELECT * FROM posts WHERE id=$id";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) == 1) {




        //الصورة القديمة
        $oldImage = mysqli_fetch_assoc($res)["image"];

        //validation

        // العنوان
        $title = trim(htmlspecialchars($_POST['title']));
        // المحتوى الداخلي
        $body = trim(htmlspecialchars($_POST['body']));
        // الصورة
        if (isset($_FILES['image']) && $_FILES['image']['name']) {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmpname = $image['tmp_name'];
            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $image_error = $image['error'];
            $image_size = $image['size'] / (1024 * 1024);

            if ($image_error) {
                $errors[] = "Image Is Required";
            } elseif ($image_size > 1) {
                $errors[] = "Max size is 1mb";
            } else if (!in_array($ext, ['jpg', 'gif', 'png'])) {
                $errors[] = "Image extension is not allowed";
            }

            $newName = uniqid() . "." . $ext;
            move_uploaded_file($image_tmpname, "../assets/images/postImage/$newName");

            if ($oldImage && $oldImage !== $newName && file_exists("../assets/images/postImage/$oldImage")) {
                unlink("../assets/images/postImage/$oldImage");
            }
        } else {
            $newName = $oldImage;
        }


        //Error handling

        if (empty($title)) {
            $errors[] = "Title Is Required";
        } elseif (is_numeric($title)) {
            $errors[] = "Title Must Be String";
        }

        if (empty($body)) {
            $errors[] = "Body Is Required";
        } elseif (is_numeric($body)) {
            $errors[] = "Body Must Be String";
        }


        // if (empty($image)) {
        //     $errors[] = "Image can not be empty";
        // }


        //update
        if (empty($errors)) {
            $query = "UPDATE posts SET `title`='$title' , `body`='$body' , `image` = '$newName' WHERE id=$id";
            $res = mysqli_query($conn, $query);
            if ($res) {
                $_SESSION['success'] = "Post Updated Succesfully";
                header("location:../viewPost.php?id=$id");
            } else {
                $_SESSION['errors'] = "Error While Update";
                header("location:../editPost.php?id=$id");
            }
        } else {
            $_SESSION['errors'] = $errors;
            header("location:../editPost.php?id=$id");
        }
    } else {
        $_SESSION['errors'] = ["Post Not Found"];
        header("location:../index.php");
    }
} else {
    $_SESSION['errors'] = ['You Must Login First'];
    header("location:../login.php");
    exit;
}