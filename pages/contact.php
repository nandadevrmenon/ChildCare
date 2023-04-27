<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/validationFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/fetchFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/database.php"; //require the db 

$GLOBALS['errors'] = array(); //errors in the contact form

$signupLink = ""; //will hold the link to sign up page if user is not signed in
$linkDivClass = "justify-content-center"; //changes class(based on user being logged in or not) to make sure styling stays good

if (!isset($_SESSION['email'])) { //if user has not signed in we show a sign up link else we show an epmty string
  $signupLink = "<a class='btn btn-primary my-1' href='/Childcare/pages/signup.php' role='button'>Sign up</a>";
  $linkDivClass = "justify-content-between";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = cleanName($_POST["name"]); //clean all inputs to correct format
  $email = cleanEmail($_POST["email"]);
  $phone = cleanInput($_POST['phone']);
  $details = cleanText($_POST['details']);
  $subject = cleanText($_POST["subject"]);

  validateFullName($name);
  validateEmail($email);
  validateSubject($subject);
  validateBigText($details);
  validatePhone($phone);

  if (count($errors) == 0) { //if there are no errors we submit the query
    $sqlString = "INSERT INTO `enquiry` ( `name`, `email`, `phone`, `title`, `message`) VALUES (?, ?, ?, ?, ?)";
    $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
    $statement->bind_param('sssss', $name, $email, $phone, $subject, $details); //prevents sql injections
    $statement->execute(); //we insert the query into the database
    if ($statement->affected_rows == 1) { //if a row is affected(successful insertion)
      setcookie('enquirySent', 'true', time() + 120, '/', '', 0); //we set cookie that an enquiryHas been sent and use that cookie to disable the form for a few minutes
      $_COOKIE['enquirySent'] = true;
    }
  }
}


require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/header.php"; //display the header. We ahve to display it here becauase we are setting a cookie so we cant send any html before that
?>

<div class="px-4 py-5 text-center w-100" id="contact-hero">
  <img class="d-block mx-auto mb-4" src="/ChildCare/images/icons/logo.png" alt="Tiny Treasures Logo" width="72"
    height="72">
  <h1 class="display-5 fw-bold">Contact Us</h1>
  <div class="col-lg-6 mx-auto">
    <p class="lead mb-4">Get in touch with us! We'd love to hear from you and answer any questions you have about our
      daycare center. Contact us today to schedule a tour and see our facility, learn more about our programs, or enroll
      your child. We look forward to hearing from you!</p>
    <div class="d-flex flex-wrap <?php echo $linkDivClass ?> w-35 mx-auto">
      <a class="btn btn-primary my-1" href="#contact-form" role="button">Make Enquiry</a>
      <?php
      echo $signupLink;
      ?>
    </div>
  </div>
</div>

<div class="main-container my-5" id="contact-form">
  <div class="card w-35 p-5">
    <iframe class="mb-3"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d38122.96434163284!2d-6.30216616676781!3d53.330988312212234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670c1833b915c7%3A0x4f83acae16f5062e!2sGriffith%20College!5e0!3m2!1sen!2sie!4v1682433358078!5m2!1sen!2sie"
      width="auto" height="400" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="row">
      <p><img class="me-3 contact-icon" src="/ChildCare/images/icons/house-fill.svg" alt="email icon">
        Belgard, Dublin, D24XC2G</p>
    </div>
    <div class="row">
      <p><img class="me-3 contact-icon" src="/ChildCare/images/icons/envelope-fill.svg" alt="email icon">
        tiny.toddlers.dublin@gmail.com</p>
    </div>
    <div class="row">
      <p class="my-0"><img class="me-3 contact-icon" src="/ChildCare/images/icons/telephone-fill.svg" alt="phone icon">
        + 01 234 567 88</p>
    </div>
  </div>
  <div class="card w-55 p-5">
    <form action="/ChildCare/pages/contact.php" method="POST" novalidate id="contact">
      <h2>Get in touch
      </h2>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="name" class="form-label"> Name</label>
          <input class="form-control form-control-sm" type="text" name="name" id="name" <?php
          if (isset($name))
            echo "value='$name'";
          if (isset($_COOKIE['enquirySent'])) {
            echo " disabled";
          }
          ?>>
          <?php
          if (isset($GLOBALS["errors"]["name"])) {
            $message = $GLOBALS['errors']['name'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
        <div class="col-md">
          <label for="email" class="form-label">Your Email</label>
          <input class="form-control form-control-sm" type="text" name="email" id="email" <?php
          if (isset($email))
            echo "value='$email'";
          if (isset($_COOKIE['enquirySent'])) {
            echo " disabled";
          }
          ?>>
          <?php
          if (isset($GLOBALS["errors"]["email"])) {
            $message = $GLOBALS['errors']['email'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="phone" class="form-label">Irish Phone Number</label>
          <input class="form-control form-control-sm" type="text" name="phone" id="phone" <?php
          if (isset($phone))
            echo "value='$phone'";
          if (isset($_COOKIE['enquirySent'])) {
            echo " disabled";
          }
          ?>>
          <?php
          if (isset($GLOBALS["errors"]["phone"])) {
            $message = $GLOBALS['errors']['phone'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="subject" class="form-label">Subject</label>
          <input class="form-control form-control-sm" type="text" name="subject" id="subject" <?php
          if (isset($subject))
            echo "value='$subject'";
          if (isset($_COOKIE['enquirySent'])) {
            echo " disabled";
          }

          ?>>
          <?php
          if (isset($GLOBALS["errors"]["subject"])) {
            $message = $GLOBALS['errors']['subject'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="details" class="form-label">Details</label>
          <textarea class="form-control form-control-sm" type="text" name="details" id="details" form="contact" <?php
          if (isset($_COOKIE['enquirySent'])) {
            echo "disabled";
          }
          ?>><?php
          if (isset($details))
            echo $details;
          ?></textarea>
          <?php
          if (isset($GLOBALS["errors"]["details"])) {
            $message = $GLOBALS['errors']['details'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
      </div>
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3" <?php
          if (isset($_COOKIE['enquirySent'])) {
            echo "disabled";
          }
          ?>>Submit</button>
        </div>
      </div>
      <?php
      if (isset($_COOKIE['enquirySent'])) {
        echo "<span class='text-danger'>Sorry but you can only send a query once every 2 minutes.Please Try again Later</span>";
      }
      ?>
    </form>
  </div>
</div>

<div class="faq">
  <h2 class="col-lg-6 mx-auto fw-bold text-center py-3 my-0">Frequenty Asked Questions</h2>
  <div class="px-4 py-3 w-100">
    <h4 class="col-lg-6 mx-auto fw-bold">What are your hours of operation?</h4>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Our daycare center is open Monday through Friday from 7:00 am to 6:00 pm. We understand that
        many parents have busy schedules, so we offer flexible drop-off and pick-up times within those hours. If you
        need to drop off your child early or pick them up late, we can accommodate your needs for an additional fee.</p>
    </div>
  </div>
  <div class="px-4 py-3 w-100">
    <h4 class="col-lg-6 mx-auto fw-bold">What is your curriculum?</h4>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">We have a play-based curriculum that is designed to promote social, emotional, physical, and
        cognitive development. Our curriculum is tailored to each age group, and we focus on activities that are both
        fun and educational. We incorporate activities such as music, art, sensory play, and outdoor play to help
        children learn and grow.</p>
    </div>
  </div>
  <div class="px-4 py-3 w-100">
    <h4 class="col-lg-6 mx-auto fw-bold">What qualifications do your staff members have?
    </h4>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">All of our staff members are trained in early childhood education and have experience working
        with children. They are required to undergo a background check and obtain a CPR/First Aid certification. We also
        provide ongoing training to ensure that our staff members are up-to-date with the latest best practices in
        childcare.</p>
    </div>
  </div>
  <div class="px-4 py-3 w-100">
    <h4 class="col-lg-6 mx-auto fw-bold">What is your policy on sick children?
    </h4>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">We have a strict sick child policy to ensure the health and safety of all children in our
        care. Children who exhibit signs of illness, such as fever, vomiting, diarrhea, or a contagious illness, are not
        permitted to attend our daycare until they are symptom-free for at least 24 hours. If your child becomes ill
        while in our care, we will contact you immediately to arrange for their pickup.</p>
    </div>
  </div>
  <div class="px-4 py-3 w-100">
    <h4 class="col-lg-6 mx-auto fw-bold">What is your security protocol?
    </h4>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4 ">We take the safety and security of our children very seriously. Our daycare center is
        equipped with security cameras, and all visitors are required to sign in and show identification before
        entering. Only authorized personnel are allowed to pick up children from our center, and we have a strict
        protocol in place to ensure that all children are released only to authorized individuals.</p>
    </div>
  </div>

</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/footer.php");
?>