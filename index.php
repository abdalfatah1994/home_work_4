<?php
$host = "localhost";
$dbname = "store_db";
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
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" type="image/x-icon" href="./images/icon_home.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title> HOME PAGE </title>
</head>

<body style="padding-top: 50px;width: 100%;">
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
  </div>
  <!-- <H1 class="title_home_page"> HOME PAGE</H1> -->
  <div class="cards">
    <a href="./products.php" class="card" target="_blank">
      <div>GO TO PRODUCTS PAGE <br> الذهاب الى صفحة المنتجات</div>
    </a>
    <a href="./login.php" class="card">
      <div> GO TO LOGIN PAGE <br> الذهاب الى صفحة تسجيل الدخول</div>
    </a>
    <a href="./users.php" class="card" target="_blank">
      <div>GO TO USERS PAGE <br> الذهاب الى صفحة المستخدمين</div>
    </a>
  </div>
  <!-- 
$num = 3.14159;
echo number_format($num, 2); // الناتج: "3.14"
-->
  <div class="products-element">
    <ul class="products-element-list">


      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
      <li class="product-img"> <a href="#"><img src="./images/ppr/CLIP-2.jpg" alt=" CLIP " loading="lazy" width="400" height="400" srcset="" sizes="(max-width: 500px) 100vw, 500px">
          <h2> Adaptor Boxes </mark></h2>
        </a></li>
    </ul>
    <span class="element-footer">
      <p>© 2025 All rights reserved </p>
      <p> Developed AND MAINTAINED BY ONBASHY COMPANEY </p>
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
          <a class="nav-link" href="#"> <i class="fa-brands fa-github"></i> </a>
        </li>
        <!--  linkedin رابط -->
        <li class="nav-item" style="margin: 5px;">
          <a class="nav-link" href="#"> <i class="fa-brands fa-linkedin"></i></i> </a>
        </li>
      </ul>
    </span>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</html>