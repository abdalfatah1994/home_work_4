<?php

$dsn = "mysql:host=localhost;dbname=store_data_base;charset=utf8";
$dbUsername = "root";
$dbPassword = "";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$error_message = "";
try {
  $pdo = new PDO($dsn, $dbUsername, $dbPassword, $options);
} catch (PDOException $e) {
  $error_message .= "فشل الاتصال بقاعدة البيانات: " . $e->getMessage();
}
$products = [];
try {
  $stmt = $pdo->query("SELECT id_product, name_product, price_product, img_url_product FROM product_table");
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $error_message .= "خطأ في جلب المنتجات: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<lang="en">
  <html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" type="image/x-icon" href="./images//icon_home.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title> الصفحة الرئيسية </title>
  </head>
  <?php if (!empty($error_message)): ?>
    <div class="alert alert-danger" role="alert">
      <?= htmlspecialchars($error_message); ?>
    </div>
  <?php endif; ?>

  <body style="background: linear-gradient(to left, #547792, #007074);">

    <div class="row_index">
      <?php if (count($products) > 0): ?>
        <?php foreach ($products as $product): ?>
          <div class="col_index">
            <div class="card_index">
              <?php if (!empty($product['img_url_product'])): ?>
                <a href="product.php?product_id=<?= htmlspecialchars($product['id_product']); ?>">
                  <img src="<?= htmlspecialchars($product['img_url_product']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name_product']); ?>" style="max-height:350px;max-width: 350px; object-fit:cover;">
                  <p class="card-img-top" > <?= htmlspecialchars($product['name_product']); ?> <br> السعر / Price ???</p>
                </a>
              <?php else: ?>
                <div class="card-img-top" style="max-height:400px;">
                  لا توجد صورة
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div>
          <p class="text-center text-white">لا توجد منتجات معروضة حالياً.</p>
        </div>
      <?php endif; ?>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: linear-gradient(to left ,#547792,#007074);display: flex;position:fixed;width: 100%;top: 0px ; z-index: 99;">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="./index.php"> Home Page </a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a Login class="nav-link active" aria-current="page" href="./login.php"> / Login </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./logout.php"> / Logout </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./index.php"> / About Us </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./index.php"> / CATALOGS </a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <span class="element-footer">
      <p>© 2025 All rights reserved </p>
      <p> Developed AND MAINTAINED BY * ONBASHY COMPANEY * </p>
      <p> Contact With Us </p>
      <ul style="display: flex;list-style-type: none;font-size: 20px; ">
        <li class="nav-item" style="margin: 5px;">
          <a class="nav-link" href="https://wa.me/+963951371241"> <i class="fa-brands fa-whatsapp"></i></a>
        </li>
        <li class="nav-item" style="margin: 5px;">
          <a class="nav-link" href="https://t.me/abdalfatah_onbashy"><i class="fa-brands fa-telegram"></i></a>
        </li>
        <li style="margin: 5px;" class="nav-item">
          <a class="nav-link" href="https://www.facebook.com/share/16BY2dqi7T/"> <i class="fa-brands fa-facebook"></i></a>
        </li>
        <li class="nav-item" style="margin: 5px;">
          <a class="nav-link" href="https://www.abdalfatahonbashy1994@gmail.com"> <i class="fa-solid fa-envelope"></i></a>
        </li>
        <!--  github رابط -->
        <li class="nav-item" style="margin: 5px;">
          <a class="nav-link" href="https://github.com/abdalfatah1994"> <i class="fa-brands fa-github"></i> </a>
        </li>
        <li class="nav-item" style="margin: 5px;">
          <a class="nav-link" href="https://www.linkedin.com/in/%D8%B9%D8%A8%D8%AF%D8%A7%D9%84%D9%81%D8%AA%D8%A7%D8%AD-%D8%A7%D9%88%D9%86%D8%A8%D8%A7%D8%B4%D9%8A-7abb16230?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"> <i class="fa-brands fa-linkedin"></i></a>
        </li>
      </ul>
    </span>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>

  </html>