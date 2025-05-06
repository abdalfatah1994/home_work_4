<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

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
    $stmt = $pdo->query("SELECT id_product , name_product, price_product, img_url_product FROM product_table");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message .= "خطأ في جلب المنتجات: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" type="image/x-icon" href="./images/user_icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>عرض المنتجات</title>
</head>
<body style="background: linear-gradient(to left, #547792, #007074);">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: linear-gradient(to left, #547792, #ffffff); display: flex; position: fixed; width: 100%; top: 0px; z-index: 99;">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
         <a class="navbar-brand" href="./index.php"> Home Page </a>
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="./login.php"> / Login </a>
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
    <p> Developed AND MAINTAINED BY ONBASHY COMPANEY </p>
    <p> Contact With Us </p>
    <ul style="display: flex; list-style-type: none; font-size: 20px;">
      <li class="nav-item" style="margin: 5px;">
        <a class="nav-link" href="https://wa.me/+963951371241">
          <i class="fa-brands fa-whatsapp"></i>
        </a>
      </li>
      <li class="nav-item" style="margin: 5px;">
        <a class="nav-link" href="https://t.me/abdalfatah_onbashy">
          <i class="fa-brands fa-telegram"></i>
        </a>
      </li>
      <li class="nav-item" style="margin: 5px;">
        <a class="nav-link" href="https://www.facebook.com/share/16BY2dqi7T/">
          <i class="fa-brands fa-facebook"></i>
        </a>
      </li>
      <li class="nav-item" style="margin: 5px;">
        <a class="nav-link" href="mailto:abdalfatahonbashy1994@gmail.com">
          <i class="fa-solid fa-envelope"></i>
        </a>
      </li>
      <li class="nav-item" style="margin: 5px;">
        <a class="nav-link" href="#">
          <i class="fa-brands fa-github"></i>
        </a>
      </li>
      <li class="nav-item" style="margin: 5px;">
        <a class="nav-link" href="#">
          <i class="fa-brands fa-linkedin"></i>
        </a>
      </li>
    </ul>
  </span>
  
  <div style="margin-top:100px;">
    <?php if (!empty($error_message)): ?>
      <div class="alert alert-danger" role="alert">
        <?= $error_message; ?>
      </div>
    <?php endif; ?>
    
    <table class="admin_table" >
      <tr>
        <th class="admin_table_th"> PRODUCT NAME / اسم المنتج</th>
        <th class="admin_table_th"> $ : PRICE  السعر</th>
        <th class="admin_table_th"> IMAGE / الصورة</th>
        <th class="admin_table_th"> GO TO DETAILS /  عرض التفاصيل</th>
      </tr>
      <?php if (count($products) > 0): ?>
        <?php foreach ($products as $product): ?>
          <tr>
            <td class="admin_table_th"><?= strtoupper(htmlspecialchars($product['name_product'])); ?></td>
            <td class="admin_table_th"><?= htmlspecialchars($product['price_product']); ?></td>
            <td class="admin_table_th">
              <?php if (!empty($product['img_url_product'])): ?>
                <img src="<?= htmlspecialchars($product['img_url_product']); ?>" alt="<?= htmlspecialchars($product['name_product']); ?>" style="max-width:100px;">
              <?php else: ?>
                لا توجد صورة
              <?php endif; ?>
            </td>
            <td class="admin_table_th">
              <a href="product.php?product_id=<?= htmlspecialchars($product['id_product']); ?>" class="btn btn-primary">عرض المنتج</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
          <tr>
            <td colspan="4" class="admin_table_th">لا توجد منتجات معروضة حالياً.</td>
          </tr>
      <?php endif; ?>
    </table>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>