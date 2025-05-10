<?php
session_start();
$dsn = "mysql:host=localhost;dbname=store_data_base;charset=utf8";
$username = "root";
$password = "";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
  $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
  die("فشل الاتصال: " . $e->getMessage());
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = htmlspecialchars($_POST['username']);

  $stmt = $pdo->prepare("SELECT id_user, username, role, password FROM users_table WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($_POST['password'], $user['password'])) {
    $_SESSION['user_id'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['admin'] = ($user['role'] === 'admin');
    $_SESSION['login_time'] = time();

    $update_stmt = $pdo->prepare("UPDATE users_table SET login_time = ? WHERE id_user = ?");
    $update_stmt->execute([$_SESSION['login_time'], $user['id_user']]);

    header("Location: " . ($_SESSION['admin'] ? "users.php" : "products.php"));
    exit;
  } else {
    $error_message = "اسم المستخدم أو كلمة المرور غير صحيحة.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" type="image/x-icon" href="./images/icon_home.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title> LOG IN </title>
</head>
<div class="background" style="width: 100%;height: 95%;">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: linear-gradient(to right ,#547792,#ffffff);display: flex;position:fixed;width: 100%;top: 0px ; z-index: 99;">
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

    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="https://github.com/abdalfatah1994"> <i class="fa-brands fa-github"></i> </a>
    </li>

    <li class="nav-item" style="margin: 5px;">
      <a class="nav-link" href="https://www.linkedin.com/in/%D8%B9%D8%A8%D8%AF%D8%A7%D9%84%D9%81%D8%AA%D8%A7%D8%AD-%D8%A7%D9%88%D9%86%D8%A8%D8%A7%D8%B4%D9%8A-7abb16230?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"> <i class="fa-brands fa-linkedin"></i></a>
    </li>
  </ul>
</span>
<body >
  <div class="container">
    <div class="header_login">
      <form class="login_form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1 class="header_login_h1">Welcome to MY STORE Page</h1>
        <?php if (!empty($error_message)) : ?>
          <p class="error"><?= $error_message; ?></p>
        <?php endif; ?>
        <label for="username" class="label_login"> User Name / اسم المستخدم</label>
        <input class="input-login" type="text" name="username" required>
        <label for="password" class="label_login"> Password / كلمة المرور </label>
        <input class="input-login" type="password" name="password" required>
        <button class="button_login" type="submit"> Signin / تسجيل الدخول </button>
        <a href="./register.php" class="new_user" target="_blank">
          <div> Create New Account / إنشاء حساب</div>
        </a>
      </form>
    </div>
  </div>
</body>
</html>