<?php require_once 'inc/header.php' ?>



<!-- Page Content -->
<div class="page-heading products-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>new Post</h4>
                    <h2>add new personal post</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (! isset($_GET['id'])) {
    header("location:index.php");
}
$id = $_GET['id'];

require_once __DIR__ . "/inc/conn.php";

$query = "SELECT * FROM posts WHERE id=$id";
$res = mysqli_query($conn, $query);
if ($res && mysqli_num_rows($res) == 1) {
    $post = mysqli_fetch_assoc($res);
} else {
    $msg = "Post Not Found";
}

?>

<div class="best-features about-features">
    <div class="container">

        <?php require_once __DIR__ . "/inc/success.php" ?>
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Our Background</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-image">
                    <img src="assets/images/postImage/<?php echo $post['image'] ?>" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="left-content">
                    <h4><?php echo $post['title'] ?></h4>
                    <p><?php echo $post['body'] ?></p>
                    <p><?php echo $post['created_at'] ?></p>

                    <!-- Hide Buttons If Not Logged In -->
                    <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="editPost.php?id=<?php echo $post['id'] ?>" class="btn btn-success mr-3 "> edit post</a>



                    <a href="handle/handleDelete.php?id=<?php echo $post['id'] ?>" onclick="alert('Are You Sure ?')"
                        class="btn btn-danger "> delete
                        post</a>

                    <?php } else {
                    ?>
                    <div class="alert alert-danger">You Must Login To Edit Or Delete</div>
                    <a href="login.php">Login Here</a>
                    <br>
                    <span>Don't have an account? </span> <a href="superAdmin/register.php"> Sign Up</a>

                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once 'inc/footer.php' ?>