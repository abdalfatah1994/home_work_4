<?php
$host = "localhost";
$dbname = "store-data-base";
$username = "root";
$password = "";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PRODUCTS </title>
</head>
<body>
    <h1>pro</h1>
    <?php

$sql = "SELECT * FROM product-table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<h2>" . $row['name'] . "</h2>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>السعر: $" . $row['price'] . "</p>";
        echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
        echo "</div>";
    }
} else {
    echo "لا توجد منتجات متاحة.";
}

$conn->close();
?>

<h1>المنتجات المتاحة</h1>
<div class="products-container">
    <?php include 'products.php'; ?>
</div>


</body>
</html>