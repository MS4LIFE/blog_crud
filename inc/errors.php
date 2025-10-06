  <?php
  require_once __DIR__ . "/conn.php";

  // عرض الايرور في حالة وجوده
  if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) { ?>

  <div class="alert alert-danger"><?php echo $error ?></div>
  <?php
    }
  }
  unset($_SESSION['errors']);
  ?>