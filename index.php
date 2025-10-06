<?php require_once 'inc/header.php' ?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text" dir="ltr">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
            <div class="text-content">
                <!-- <h4>Best Offer</h4> -->
                <!-- <h2>New Arrivals On Sale</h2> -->
            </div>
        </div>
        <div class="banner-item-02">
            <div class="text-content">
                <!-- <h4>Flash Deals</h4> -->
                <!-- <h2>Get your best products</h2> -->
            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <!-- <h4>Last Minute</h4> -->
                <!-- <h2>Grab last minute deals</h2> -->
            </div>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->



<?php

require_once __DIR__ . "/inc/conn.php";

// Pagination Start
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$limit = 3;
$offset = ($page - 1) * $limit;
$numOfPostsQuery = "SELECT count(id) as total FROM posts";
$numOfPostsRes = mysqli_query($conn, $numOfPostsQuery);
if ($numOfPostsRes && mysqli_num_rows($numOfPostsRes) == 1) {
    $total = mysqli_fetch_assoc($numOfPostsRes)['total'];
}

$numOfPages = ceil($total / $limit);
// echo $numOfPages;

if ($page < 1) {
    header("location:" . $_SERVER['PHP_SELF'] . "?page=1");
}
if ($page > $numOfPages) {
    header("location:" . $_SERVER['PHP_SELF'] . "?page=" . $numOfPages);
}


// Pagination End




// Fetch All Data From Database
$query = "SELECT id, image, title, created_at FROM posts ORDER BY id limit $limit OFFSET $offset";
$res = mysqli_query($conn, $query);
if ($res && mysqli_num_rows($res) > 0) {
    $posts = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
    $msg = "Posts Not Found";
}

?>



<div class="latest-products">
    <div class="container">

        <?php require_once __DIR__ . "/inc/success.php" ?>
        <?php require_once __DIR__ . "/inc/errors.php" ?>

        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Posts</h2>
                </div>
            </div>


            <!-- Loop Posts From Database -->
            <?php
            if (!empty($posts)):
                foreach ($posts as $post):
            ?>

            <div class="col-md-4">
                <div class="product-item">
                    <a href="#"><img src="assets/images/postImage/<?php echo $post['image'] ?>" alt=""></a>
                    <div class="down-content">
                        <a href="#">
                            <h4><?php echo $post['title'] ?></h4>
                        </a>
                        <p><?php echo $post['created_at'] ?></p>
                        <div class="d-flex justify-content-end">
                            <a href="viewPost.php?id=<?php echo $post['id'] ?>" class="btn btn-info "> view</a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Print $msg If No Posts In Database -->
            <?php
                endforeach;
            else:
                echo $msg;
            endif;
            ?>
        </div>
    </div>
</div>


<!-- Start Front Paginate -->
<div class="container d-flex justify-content-center" dir="ltr">
    <nav aria-label="Page navigation example">
        <ul class="pagination  ">

            <?php
            if ($page == 1) {
            ?>
            <li class="page-item disabled">
                <a class="page-link disabled" href="index.php?page=<?php echo $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>

                </a>
                <?php
            } else {
                ?>
                <a class="page-link" href="index.php?page=<?php echo $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>

                </a>
                <?php
            }
                ?>
            </li>



            <li class="page-item"><a class="page-link"><?php echo $page . " Of " . $numOfPages ?></a></li>
            <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li> -->
            <?php
                if ($page >= $numOfPages) {
                ?>
            <li class="page-item disabled">
                <a class="page-link disabled" href="index.php?page=<?php echo $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <?php
                } else {
                ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <?php
                }
                ?>
        </ul>
    </nav>
</div>
<!-- End Front Paginate -->

<?php require_once 'inc/footer.php' ?>