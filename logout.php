<?php
session_start();

// التحقق من أن المستخدم مسجل دخول
if (!isset($_SESSION['username']) || !isset($_SESSION['login_time'])) {
    die("لم يتم العثور على جلسة نشطة.");
}

// حساب مدة الجلسة
$login_time = $_SESSION['login_time'];
$duration = time() - $login_time; // الفرق بالثواني
$hours = floor($duration / 3600);
$minutes = floor(($duration % 3600) / 60);
$seconds = $duration % 60;

// إنهاء الجلسة عند تسجيل الخروج
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>تسجيل الخروج</title>
</head>

<body style="background: linear-gradient(to left, #547792, #007074); text-align: center;">
    <h2>تفاصيل الجلسة</h2>

    <table border="1" style="width: 50%; margin: auto; text-align: center;">
        <tr>
            <th>اسم المستخدم</th>
            <th>مدة تسجيل الدخول</th>
        </tr>
        <tr>
            <td><?= htmlspecialchars($_SESSION['username']) ?></td>
            <td><?= sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds) ?></td>
        </tr>
    </table>

    <form method="POST">
        <button type="submit" name="logout" style="margin-top: 20px; padding: 10px 20px; font-size: 18px;">تسجيل الخروج</button>
    </form>
</body>
</html>