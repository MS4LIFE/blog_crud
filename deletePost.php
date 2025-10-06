<?php require_once __DIR__ . "/inc/conn.php";



// <!--Start Authorization handle-->
if (!isset($_SESSION['user_id'])) {
    $_SESSION['errors'] = ['You Must Login First'];
    header("location:login.php");
    exit;
}
?>


<?php require_once 'inc/header.php'; ?>


<div class="page-heading products-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h6><?php require_once "inc/success.php"; ?></h6>
                    <a href="index.php">Return To Back home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>