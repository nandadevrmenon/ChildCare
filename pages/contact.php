<?php
session_start();
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

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

  validateFullName($name); //validate every input 
  validateEmail($email);
  validateSubject($subject);
  validateBigText($details);
  validatePhone($phone);

  $currentDate = date('Y-m-d'); //to get current date string

  if (count($errors) == 0 && !isset($_COOKIE['enquirySent'])) { //if there are no errors  and we havent sent a query in the past 2 minutes we submit the query
    $sqlString = "INSERT INTO `enquiry` ( `date`,`name`, `email`, `phone`, `subject`, `details`) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
    $statement->bind_param('ssssss', $currentDate, $name, $email, $phone, $subject, $details); //prevents sql injections
    $statement->execute(); //we insert the query into the database
    if ($statement->affected_rows == 1) { //if a row is affected(successful insertion)
      setcookie('enquirySent', 'true', time() + 120, '/', '', 0); //we set cookie that an enquiry Has been sent and use that cookie to disable the form for a few minutes
      $_COOKIE['enquirySent'] = true;
      $GLOBALS['setNow'] = true;
    }
  }
}


require_once dirname(__FILE__) . "/../components/header.php"; //display the header. We have to display it here becauase we are setting a cookie so we cant send any html before that
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
  <?php require_once dirname(__FILE__) . "/../components/contactCard.php" //renders the contact info card with map and details?>
  <div class="card w-55 p-5">
    <form action="/ChildCare/pages/contact.php" method="POST" novalidate id="contact">
      <h2>Get in touch
      </h2>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="name" class="form-label"> Name</label>
          <input class="form-control form-control-sm" type="text" name="name" id="name" <?php
          if (isset($name))
            echo "value='$name'"; //makes the form stickt and is done for all inputs
          if (isset($_COOKIE['enquirySent'])) { //we disbale all inputs if form was already submitted less than 2 minutes
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
      if ($GLOBALS['setNow']) {
        echo "<span class='text-success'>Message sent successfully! <br></span>";
      }
      if (isset($_COOKIE['enquirySent'])) {
        echo "<span class='text-danger'>You can only send a message once every 2 minutes. Please Try again Later</span>";
      }
      ?>
    </form>
  </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "<script>
  window.scrollTo(0,560);
</script>";
}
require_once dirname(__FILE__) . "/../components/faqs.php"; // renders the static faqs
require_once(dirname(__FILE__) . "/../components/footer.php");
?>