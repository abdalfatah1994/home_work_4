<?php
session_start();

// إعداد الاتصال بقاعدة البيانات
$dsn = "mysql:host=localhost;dbname=store_data_base;charset=utf8";
$username = "root";
$password = "";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
  $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
  die("فشل الاتصال: " . $e->getMessage());
}

// تأمين الجلسة - تحديد وقت تسجيل الدخول إذا لم يكن محددًا
if (!isset($_SESSION['login_time'])) {
  $_SESSION['login_time'] = time();
}

// حساب مدة الجلسة
$login_time = (int) $_SESSION['login_time'];
$duration = time() - $login_time;
$hours = floor($duration / 3600);
$minutes = floor(($duration % 3600) / 60);
$seconds = $duration % 60;

// معالجة طلبات المستخدم (CRUD)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['update_role'])) {
    $stmt = $pdo->prepare("UPDATE users_table SET role = ? WHERE id_user = ?");
    $stmt->execute([$_POST['new_role'], $_POST['user_id']]);
  }

  if (isset($_POST['delete_user'])) {
    $stmt = $pdo->prepare("DELETE FROM users_table WHERE id_user = ? LIMIT 1");
    $stmt->execute([$_POST['user_id']]);
  }

  if (isset($_POST['add_user'])) {
    $hashedPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users_table (username, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->execute([$_POST['new_username'], $_POST['new_email'], $hashedPassword]);
  }

  if (isset($_POST['update_user'])) {
    $stmt = $pdo->prepare("UPDATE users_table SET username = ?, email = ? WHERE id_user = ?");
    $stmt->execute([$_POST['new_username'], $_POST['new_email'], $_POST['user_id']]);
  }

  header("Location: users.php");
  exit;
}

// جلب قائمة المستخدمين
$stmt = $pdo->prepare("SELECT id_user, username, email, role FROM users_table");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// تسجيل الخروج
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}
?>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: index.php"); // إعادة توجيه لصفحة أخرى
  exit;
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" type="image/x-icon" href="./images/signup.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>إدارة المستخدمين </title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: linear-gradient(to left ,#547792,#ffffff);display: flex;position:fixed;width: 100%;top: 0px ; z-index: 99;">
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


<body>
  <h3 class="admin_hader"> Users Data table / جدول بيانات المستخدمين</h3>
  <table class="admin_table" style="margin: 50px 0px;">
    <tr>
      <th class="admin_table_th">النوع الحالي للحساب <br> Account Type</th>
      <th class="admin_table_th">البريد الإلكتروني / Email</th>
      <th class="admin_table_th">اسم المستخدم / Username</th>
      <th class="admin_table_th">تعديل نوع المستخدم / Edit User Type</th>
      <th class="admin_table_th">حذف المستخدم / Delete User</th>
      <th class="admin_table_th">تعديل بيانات المستخدم / Edit User Info</th>
    </tr> <?php foreach ($users as $user): ?>
      <tr>
        <td th class="admin_table_th"><?= htmlspecialchars($user['role']) ?></td>
        <td th class="admin_table_th"><?= htmlspecialchars($user['email']) ?></td>
        <td th class="admin_table_th"><?= htmlspecialchars($user['username']) ?></td>
        <td th class="admin_table_th">
          <form method="POST">
            <input type="hidden" name="user_id" value="<?= $user['id_user'] ?>">
            <select name="new_role">
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
            <button type="submit" name="update_role"> Edite User / تعديل الدور</button>
          </form>
        </td>
        <td class="admin_table_th">
          <form method="POST">
            <input type="hidden" name="user_id" value="<?= $user['id_user'] ?>">
            <button type="submit" name="delete_user" onclick="return confirm('هل أنت متأكد Are You Sure ؟');"> Deleta / حذف </button>
          </form>
        </td>
        <td class="admin_table_th">
          <form method="POST">
            <input type="hidden" name="user_id" value="<?= $user['id_user'] ?>">
            <input type="text" name="new_username" value="<?= $user['username'] ?>" required>
            <input type="email" name="new_email" value="<?= $user['email'] ?>" required>
            <button type="submit" name="update_user"> Update User / تعديل البيانات </button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <!-- إضافة مستخدم جديد -->
  <h4 style="display: flex; justify-content: space-around; align-items: center;color: #547792;font-weight: 700;font-size: 28px;"> Add New User / إضافة مستخدم جديد</h4>
  <form method="POST" class="admin_new_user" style="padding-bottom: 75px;">
    <input type="text" name="new_username" placeholder="User Name / اسم المستخدم" required>
    <input type="email" name="new_email" placeholder=" E-mail / البريد الإلكتروني" required>
    <input type="password" name="new_password" placeholder="Password / كلمة المرور" required>
    <button type="submit" name="add_user"> Add User / إضافة مستخدم</button>
  </form>
  <span class="element-footer" style="display: flex; justify-content: space-around;">
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

</body>

</html>