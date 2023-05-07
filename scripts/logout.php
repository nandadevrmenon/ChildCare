<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/ChildCare/bootstrap.css" />
  <link rel="stylesheet" href="/ChildCare/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DynaPuff&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300&display=swap"
    rel="stylesheet">
  <title>Tiny Treaures</title>
</head>

<body>
  <header class="navbar navbar-start">
    <div class="navbar-brand">
      <a href="/ChildCare/index.php"><img src="/ChildCare/images/icons/logo.png" alt="LOGO" /></a>
      <a href="/ChildCare/index.php">Tiny
        Treasures</a>
    </div>
    <nav class="nav-list-container" id="navbarLinks">
      <ul class="nav-list">
        <li class='nav-item mx-3'>
          <a class='nav-link' href='/ChildCare/pages/services.php'>Services</a>
        </li>
        <li class='nav-item mx-3'>
          <a class='nav-link' href='/ChildCare/pages/registration.php'>Register</a>
        </li>
        <li class='nav-item mx-3'>
          <a class='nav-link' href='/ChildCare/pages/contact.php'>Contact Us</a>
        </li>
        <li class='nav-item mx-3'>
          <a class='nav-link' href='/ChildCare/pages/testimonials.php'>Testimonials</a>
        </li>
        <li class='nav-item mx-3'>
          <a class='nav-link' href='/ChildCare/pages/login.php'>Log In</a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="page">
    <?php
    unset($_SESSION['email']);
    unset($_SESSION['privilege']);
    unset($_SESSION['userID']);
    if ($_GET['delete'] == "success") {
      echo "<div class='alert alert-success w-75' role='alert'>
     Your Account has been Deleted. Sad to see you go : (
    </div>";
    } else {
      echo "<div class='alert alert-success w-75' role='alert'>
      You have logged out sucessfully!
    </div>";
    }
    echo "<a class='btn btn-primary' href='/ChildCare/' role='button'>Go to Home Page</a>";
    ?>

  </div>

  <footer class="site-footer">
    <div class="blue-bottom-border blue-top-border w-100">
      <div class="d-flex px-5 py-4 w-75 mx-auto">
        <div class="ms-5 me-auto d-none d-lg-block">
          <span>Connect with us on these social networks:</span>
        </div>
        <div class="me-5 d-flex w-50 align-items-center justify-content-end">
          <a><img src="/ChildCare/images/icons/instagram.svg" alt="Instagram Logo" class="me-4"></a>
          <a><img src="/ChildCare/images/icons/facebook.svg" alt="Facebook Logo"></a>
          <a><img src="/ChildCare/images/icons/github.svg" alt="Github Logo" class="ms-4"></a>
        </div>
      </div>
    </div>
    <div>
      <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4 footer-brand">
              Tiny Treasures
            </h6>
            <p>
              At Tiny Treasures, we're committed to providing a nurturing and fun environment for your child to grow,
              learn, and explore the world around them. Contact us today to learn more.
            </p>
          </div>

          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

            <h6 class="text-uppercase fw-bold mb-4">
              Services
            </h6>
            <p>
              <a href="#!" class="text-reset">Baby</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Wobbler</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Toddler</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Pre-School</a>
            </p>
          </div>
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">
              Useful links
            </h6>
            <p>
              <a href="/ChildCare/pages/Testimonials.php" class="text-reset">Testimonials</a>
            </p>
            <p>
              <a href="/ChildCare/pages/contact.php" class="text-reset">Contact Us</a>
            </p>
            <p>
              <a href='/ChildCare/pages/registration.php' class='text-reset'>Registration</a>
            </p>
            <p>
              <a href="/ChildCare/pages/services.php" class="text-reset">Services</a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p>
              <img class="me-3" src="/ChildCare/images/icons/house-fill.svg" alt="Address icon">
              Belgard, Dublin, D24XC2G
            </p>
            <p>
              <img class="me-3" src="/ChildCare/images/icons/envelope-fill.svg" alt="email icon">
              info@example.com
            </p>
            <p> <img class="me-3" src="/ChildCare/images/icons/telephone-fill.svg" alt="phone icon"> + 01 234 567 88</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="/ChildCare/index.js"></script>
</body>

</html>