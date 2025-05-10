<?php
session_start();
$servername   = "localhost";
$username_db  = "root";
$password_db  = "";
$dbname       = "store_data_base";
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
<?php
$username     = "";
$email        = "";
$password     = "";
$config       = "";
$errors_array = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $config   = trim($_POST["config"]);
    if (empty($username)) {
        $errors_array['username'] = "اسم المستخدم مطلوب.";
    }
    if (empty($email)) {
        $errors_array['email'] = "البريد الإلكتروني مطلوب.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors_array['email'] = "تنسيق البريد الإلكتروني غير صالح.";
    }
    if (empty($errors_array['email'])) {
        $stmt_check = $conn->prepare("SELECT id_user FROM users_table WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();
        if ($stmt_check->num_rows > 0) {
            $errors_array['email'] = "هذا البريد الإلكتروني مسجّل مسبقًا.";
        }
        $stmt_check->close();
    }
    if (empty($password)) {
        $errors_array['password'] = "كلمة المرور مطلوبة.";
    } elseif (strlen($password) < 8) {
        $errors_array['password'] = "يجب أن تكون كلمة المرور 8 أحرف على الأقل.";
    }
    if (empty($config)) {
        $errors_array['config'] = "تأكيد كلمة المرور مطلوب.";
    } elseif ($password !== $config) {
        $errors_array['config'] = "كلمتا المرور غير متطابقتين.";
    }
    if (empty($errors_array)) {
        $stmt = $conn->prepare("INSERT INTO users_table (username, email, password) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("خطأ في إعداد الاستعلام: " . $conn->error);
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        if ($stmt->execute()) {
            $_SESSION['success'] = "تم التسجيل بنجاح!";
            header("Location: login.php");
            exit();
        } else {
            $errors_array['db'] = "حدث خطأ أثناء التسجيل.";
        }

        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" type="image/x-icon" href="./images/signup.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

<body>
    <div class="header_home">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors_array)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors_array as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="signup_form" method="POST" action="">
            <h1>New User / مستخدم جديد </h1>
            <label for="username"> User Name / اسم المستخدم</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>">
            <div class="erorrs_attention">
                <?php if (isset($errors_array['username'])): ?>
                    <p style="color: red;"><?= $errors_array['username'] ?></p>
                <?php endif; ?>
            </div>

            <label for="email"> E-mail /  البريد الإلكتروني </label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
            <div class="erorrs_attention">
                <?php if (isset($errors_array['email'])): ?>
                    <p style="color: red;"><?= $errors_array['email'] ?></p>
                <?php endif; ?>
            </div>

            <label for="password"> Password / كلمة المرور </label>
            <input type="password" name="password" id="password">
            <div class="erorrs_attention">
                <?php if (isset($errors_array['password'])): ?>
                    <p style="color: red;"><?= $errors_array['password'] ?></p>
                <?php endif; ?>
            </div>

            <label for="config"> ReWrite Password / تأكيد كلمة المرور </label>
            <input type="password" name="config" id="config">
            <div class="erorrs_attention">
                <?php if (isset($errors_array['config'])): ?>
                    <p style="color: red;"><?= $errors_array['config'] ?></p>
                <?php endif; ?>
            </div>
            <button class="button_login" type="submit"> Signup / تسجيل</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>