<?php

// Start localization

if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'ar'], true)) {
    $_SESSION['lang'] = $_GET['lang'];
}

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// المتغير النهائي
$lang = $_SESSION['lang'];


$translations = require_once __DIR__ . "/../locale/$lang.php";
// End localization

?>



<!DOCTYPE html>
<html lang="en" dir=<?= ($lang === 'en') ? 'ltr' : 'rtl' ?>>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="padding-0">
        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <div>
                    <a class="navbar-brand" href="index.php?lang=<?= $lang ?>">
                        <h2> <em>Blog</em></h2>
                    </a>
                </div>

                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class=" navbar-nav m-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php"><?= $translations['all_posts'] ?>
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addPost.php"><?= $translations['add_new_post'] ?></a>
                        </li>


                        <!--Start login Authorization -->
                        <?php
                        require_once "conn.php";
                        if (isset($_SESSION['user_id'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="handle/logout.php"><?= $translations['logout'] ?></a>
                            </li>

                        <?php
                        } else { ?>

                            <li class="nav-item">
                                <a class="nav-link" href="login.php"><?= $translations['login'] ?></a>
                            </li>
                        <?php } ?>
                        <!--End login Authorization -->
                    </ul>

                </div>

                <div>
                    <form name="lang" action="" method="get">
                        <select name="lang" id="langId" onchange="this.form.submit()">
                            <option value="en" <?= ($lang === "en") ? "selected" : "" ?>>En</option>
                            <option value="ar" <?= ($lang  === "ar") ? "selected" : "" ?>>Ar</option>
                        </select>
                    </form>
                </div>
            </div>


        </nav>
    </header>