<?php
require_once __DIR__ . "/../inc/conn.php";

// <!--Start Authorization handle-->
if (!isset($_SESSION['user_id'])) {
    $_SESSION['errors'] = ["You must login first"];
    header("location:login.php");
    exit;
}

//ربط البوست برقم اليوزر الخاص بيه
$user_id = $_SESSION['user_id'];

// insert_process => 1-submit / 2-catch / 3-validation / 4-errors_empty / insert

if (isset($_POST['submit'])) {



    // العنوان
    $title = trim(htmlspecialchars($_POST['title']));
    // المحتوى الداخلي
    $body = trim(htmlspecialchars($_POST['body']));



    // الصورة
    if (isset($_FILES['image']) && $_FILES['image']['name'] && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
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

        $newName = time() . "." . $ext;
    } else {
        $newName = null;
    }

    // Errors handling
    $errors = [];
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

    if (empty($errors)) {

        $query = "INSERT INTO posts(`title`,`body`,`image`,`user_id`) VALUES('$title','$body','$newName','$user_id')";
        $res =  mysqli_query($conn, $query);
        if ($res) {

            if (isset($_FILES['image']) && $_FILES['image']['name']) {
                move_uploaded_file($image_tmpname, "../assets/images/postImage/$newName");
            }

            // مفيش داعي نخزن داخل أراي لأن مفيش غير نتيجة واحدة متخزنة
            $_SESSION['success'] = "Post Inserted successfully";
            header("location:../index.php");
            exit;
        } else {
            // بنخزن داخل أراي لأن لما يعمل لوب مينفعش يلوب على سترنج
            $_SESSION['errors'] = ["Error While Inserting Post"];
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location:../addPost.php");
        exit;
    }
} else {
    header("location:../addPost.php");
    exit;
};
