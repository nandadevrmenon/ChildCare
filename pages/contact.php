<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/validationFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/fetchFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/database.php"; //require the db 

$GLOBALS['errors'] = array();
?>

<div class="px-4 py-5 text-center w-100" id="contact-hero">
  <img class="d-block mx-auto mb-4" src="/ChildCare/images/icons/logo.png" alt="Tiny Treasures Logo" width="72"
    height="72">
  <h1 class="display-5 fw-bold">Contact Us</h1>
  <div class="col-lg-6 mx-auto">
    <p class="lead mb-4">Get in touch with us! We'd love to hear from you and answer any questions you have about our
      daycare center. Contact us today to schedule a tour and see our facility, learn more about our programs, or enroll
      your child. We look forward to hearing from you!</p>
    <div class="d-flex flex-wrap justify-content-between w-35 mx-auto">
      <a class="btn btn-primary my-1" href="#contact-form" role="button">Make Enquiry</a>
      <a class="btn btn-primary my-1" href="/Childcare/pages/signup.php" role="button">Sign up</a>
    </div>
  </div>
</div>

<h1>"here"</h1>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/footer.php");
?>