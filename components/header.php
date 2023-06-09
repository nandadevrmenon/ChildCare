<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$isAtHomePage = preg_match("/index.php/", $_SERVER['REQUEST_URI']);
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

<body <?php if ($isAtHomePage)
  echo "class='home-page-body'" ?>>
    <header class="navbar navbar-start">
      <div class="navbar-brand">
        <a href="/ChildCare/index.php"><img src="/ChildCare/images/icons/logo.png" alt="LOGO" /></a>
        <a href="/ChildCare/index.php">Tiny
          Treasures</a>
      </div>
      <nav class="nav-list-container" id="navbarLinks">
        <ul class="nav-list">
          <?php
if (!isset($_SESSION['email'])) { //for public
  echo "<li class='nav-item mx-3'>
            <a class='nav-link' href='/ChildCare/pages/services.php'>Services</a>
          </li>";
  echo "<li class='nav-item mx-3'>
          <a class='nav-link' href='/ChildCare/pages/registration.php'>Register</a>
            </li>";
  echo "<li class='nav-item mx-3'>
            <a class='nav-link' href='/ChildCare/pages/contact.php'>Contact Us</a>
          </li>";
  echo " <li class='nav-item mx-3'>
            <a class='nav-link' href='/ChildCare/pages/testimonials.php'>Testimonials</a>
          </li>";
  echo "<li class='nav-item mx-3'>
            <a class='nav-link' href='/ChildCare/pages/login.php'>Log In</a>
          </li>";
} else {
  if (((isset($_SESSION['privilege'])) && $_SESSION['privilege'] == "super")) { //for admin
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/editHome.php'>Edit Home</a>
            </li>";
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/addLog.php'>Add Log</a>
            </li>";
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/messages.php'>Messages</a>
            </li>";
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/editFees.php'>Edit Fees</a>
            </li>";
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/reviewTestimonials.php'>Testimonials</a>
            </li>";
  } else { //for user(parent)
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/services.php'>Services</a>
            </li>";
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/registration.php'>Register</a>
            </li>";
    echo "<li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/dailyLog.php'>Daily Log</a>
            </li>";
    echo " <li class='nav-item mx-3'>
              <a class='nav-link' href='/ChildCare/pages/testimonials.php'>Testimonials</a>
            </li>";
    echo "<li class='nav-item mx-3'>
             <a class='nav-link' href='/ChildCare/pages/contact.php'>Contact Us</a>
            </li>";
  } //for logged in users in general
  echo "<li class='nav-item mx-3'>
            <a class='nav-link' href='/ChildCare/pages/profile.php'>Profile</a>
          </li>";
  echo "<li class='nav-item mx-3'>
            <a class='nav-link' href='/ChildCare/scripts/logout.php'>Log Out</a>
          </li>";
}
?>
      </ul>
    </nav>
  </header>

  <div class="page">