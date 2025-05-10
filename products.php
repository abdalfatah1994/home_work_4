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

// معالجة طلبات POST للإضافة والحذف والتعديل
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $action = $_POST['action'] ?? '';
  if ($action == 'add') {
    $name    = $_POST['name_product'] ?? '';
    $price   = $_POST['price_product'] ?? 0;
    $img_url = $_POST['img_url_product'] ?? '';
    $desc    = $_POST['discription_product'] ?? '';
    try {
      $stmt = $pdo->prepare("INSERT INTO product_table (name_product, price_product, img_url_product, discription_product) VALUES (:name, :price, :img_url, :desc)");
      $stmt->execute([
        ':name'    => $name,
        ':price'   => $price,
        ':img_url' => $img_url,
        ':desc'    => $desc
      ]);
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
    } catch (PDOException $e) {
      $error_message .= "خطأ في إضافة المنتج: " . $e->getMessage();
    }
  } elseif ($action == 'delete') {
    $product_id = $_POST['product_id'] ?? '';
    try {
      $stmt = $pdo->prepare("DELETE FROM product_table WHERE id_product = :id");
      $stmt->execute([':id' => $product_id]);
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
    } catch (PDOException $e) {
      $error_message .= "خطأ في حذف المنتج: " . $e->getMessage();
    }
  } elseif ($action == 'edit') {
    $product_id = $_POST['product_id'] ?? '';
    $name    = $_POST['name_product'] ?? '';
    $price   = $_POST['price_product'] ?? 0;
    $img_url = $_POST['img_url_product'] ?? '';
    $desc    = $_POST['discription_product'] ?? '';
    try {
      $stmt = $pdo->prepare("UPDATE product_table SET name_product = :name, price_product = :price, img_url_product = :img_url, discription_product = :desc WHERE id_product = :id");
      $stmt->execute([
        ':name'    => $name,
        ':price'   => $price,
        ':img_url' => $img_url,
        ':desc'    => $desc,
        ':id'      => $product_id
      ]);
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
    } catch (PDOException $e) {
      $error_message .= "خطأ في تعديل المنتج: " . $e->getMessage();
    }
  }
}

// جلب كافة المنتجات مع وصف المنتج
$products = [];
try {
  $stmt = $pdo->query("SELECT id_product, name_product, price_product, img_url_product, discription_product FROM product_table");
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <title>عرض المنتجات</title>
</head>

<span class="element-footer">

  <p>© 2025 All rights reserved </p>
  <p> Developed AND MAINTAINED BY ONBASHY COMPANEY </p>
  <p> Contact With Us </p>
  <ul style="display: flex; list-style-type: none; font-size: 20px;">
    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="https://wa.me/+963951371241"> <i class="fa-brands fa-whatsapp"></i></a>
    </li>
    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="https://t.me/abdalfatah_onbashy"><i class="fa-brands fa-telegram"></i></a>
    </li>
    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="https://www.facebook.com/share/16BY2dqi7T/"> <i class="fa-brands fa-facebook"></i></a>
    </li>
    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="mailto:abdalfatahonbashy1994@gmail.com"> <i class="fa-solid fa-envelope"></i></a>
    </li>
    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="#"> <i class="fa-brands fa-github"></i> </a>
    </li>
    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="#"> <i class="fa-brands fa-linkedin"></i> </a>
    </li>
  </ul>
</span>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: linear-gradient(to left, #547792, #ffffff); display: flex; position: fixed; width: 100%; top: 0; z-index: 99;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="./index.php"> Home Page </a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="./login.php"> / Login </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./logout.php"> / Logout </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./index.php"> / About Us </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./index.php"> / CATALOGS </a>
        </li>
      </ul>
      <form class="d-flex">
        <!-- <input class="form-control me-2" type="search" placeholder="Search"> -->
        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
        <h2 style="color: red;text-decoration: double;"> ( <?= htmlspecialchars($_SESSION['username']) ?> ) </h2>
        <h2 for="username"> : User Name / اسم المستخدم </h2>
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

    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="https://github.com/abdalfatah1994"> <i class="fa-brands fa-github"></i> </a>
    </li>

    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="https://www.linkedin.com/in/%D8%B9%D8%A8%D8%AF%D8%A7%D9%84%D9%81%D8%AA%D8%A7%D8%AD-%D8%A7%D9%88%D9%86%D8%A8%D8%A7%D8%B4%D9%8A-7abb16230?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"> <i class="fa-brands fa-linkedin"></i></a>
    </li>
  </ul>
</span>


<body style="background: linear-gradient(to left, #547792, #007074); padding-top: 100px;">

  <?php if (!empty($error_message)): ?>
    <div class="alert alert-danger" role="alert">
      <?= $error_message; ?>
    </div>
  <?php endif; ?>
  <?php if (isset($_GET['edit_id'])):
    $edit_id = intval($_GET['edit_id']);
    $edit_product = false;
    try {
      $stmt = $pdo->prepare("SELECT * FROM product_table WHERE id_product = :id");
      $stmt->execute([':id' => $edit_id]);
      $edit_product = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      $error_message .= "خطأ في جلب بيانات المنتج للتعديل: " . $e->getMessage();
    }
  ?>
    <?php if ($edit_product): ?>
      <h2 class="mt-4">تعديل المنتج / Edit Product</h2>
      <form method="post" class="mb-4">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="product_id" value="<?= $edit_product['id_product']; ?>">
        <div class="form-group mb-2">
          <label>اسم المنتج / Product Name:</label>
          <input type="text" name="name_product" value="<?= htmlspecialchars($edit_product['name_product']); ?>" class="form-control" required>
        </div>
        <div class="form-group mb-2">
          <label>السعر / Price:</label>
          <input type="number" step="0.01" name="price_product" value="<?= htmlspecialchars($edit_product['price_product']); ?>" class="form-control" required>
        </div>
        <div class="form-group mb-2">
          <label>رابط الصورة / Image URL:</label>
          <input type="text" name="img_url_product" value="<?= htmlspecialchars($edit_product['img_url_product']); ?>" class="form-control">
        </div>
        <div class="form-group mb-2">
          <label>وصف المنتج / Product Description:</label>
          <textarea name="discription_product" class="form-control" rows="3"><?= htmlspecialchars($edit_product['discription_product']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">تعديل / Edit Product</button>
        <a href="<?= $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">إلغاء / Cancel</a>
      </form>
    <?php else: ?>
      <p>المنتج غير موجود.</p>
    <?php endif; ?>
  <?php endif; ?>

  <!-- جدول عرض المنتجات -->
  <table class="admin_table" style="margin:65px; width: 200vh;">
    <tr>
      <th class="admin_table_th">PRODUCT NAME / اسم المنتج</th>
      <th class="admin_table_th">$ : PRICE السعر</th>
      <th class="admin_table_th">IMAGE / الصورة</th>
      <th class="admin_table_th">ACTIONS / الإجراءات</th>
    </tr>
    <?php if (count($products) > 0): ?>
      <?php foreach ($products as $product): ?>
        <tr>
          <td class="admin_table_th"><?= strtoupper(htmlspecialchars($product['name_product'])); ?></td>
          <td class="admin_table_th"><?= htmlspecialchars($product['price_product']); ?></td>
          <td class="admin_table_th">
            <?php if (!empty($product['img_url_product'])): ?>
              <img loading="lazy" src="<?= htmlspecialchars($product['img_url_product']); ?>" alt="<?= htmlspecialchars($product['name_product']); ?>" style="max-width:200px;">
            <?php else: ?>
              لا توجد صورة
            <?php endif; ?>
          </td>
          <td class="admin_table_th">
            <a href="product.php?product_id=<?= htmlspecialchars($product['id_product']); ?>" class="btn btn-primary">
              Show Details / عرض التفاصيل
            </a>
            <a href="?edit_id=<?= htmlspecialchars($product['id_product']); ?>" class="btn btn-success">
              Edit / تعديل
            </a>
            <form method="post" style="display:inline-block;">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id_product']); ?>">
              <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج?');">
                Delete / حذف
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="4" class="admin_table_th">لا توجد منتجات معروضة حالياً.</td>
      </tr>
    <?php endif; ?>
  </table>

  <h2 style="text-align: center;">إضافة منتج جديد / Add New Product</h2>
  <form method="post" class="admin_new_user">
    <input type="hidden" name="action" value="add">
    <div class="form-group mb-2">
      <label>اسم المنتج / Product Name:</label>
      <input type="text" name="name_product" class="form-control" required>
    </div>
    <div class="form-group mb-2">
      <label>السعر / Price:</label>
      <input type="number" step="0.01" name="price_product" class="form-control" required>
    </div>
    <div class="form-group mb-2">
      <label>رابط الصورة / Image URL:</label>
      <input type="text" name="img_url_product" class="form-control">
    </div>
    <div class="form-group mb-2">
      <label>وصف المنتج / Product Description:</label>
      <input type="text" name="discription_product" class="form-control">
    </div>
    <button type="submit" name="add_user">أضف المنتج / Add Product</button>
  </form>
  <br>
  <br>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>