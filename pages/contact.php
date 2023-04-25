<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/validationFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/fetchFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/database.php"; //require the db 

$GLOBALS['errors'] = array(); //errors in the contact form
$GLOBALS['hideForm'] = false; //variable that holds if the form is to be hidden after sending message

$signupLink = ""; //will hold the link to sign up page if user is not signed in
$linkDivClass = "justify-content-center"; //changes class(based on user being logged in or not) to make sure styling stays good

if (!isset($_SESSION['email'])) { //if user has not signed in we show a sign up link else we show an epmty string
  $signupLink = "<a class='btn btn-primary my-1' href='/Childcare/pages/signup.php' role='button'>Sign up</a>";
  $linkDivClass = "justify-content-between";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = cleanName($_POST["name"]); //clean all inputs to correct format
  $email = cleanEmail($_POST["email"]);
  $details = cleanInput($_POST['details']);
  $subject = cleanInput($_POST["subject"]);

  validateFullName($name);
  validateEmail($email);

  // if (count($errors) == 0) {
  //   $GLOBALS['hideForm'] = true; //if there are no errors we hide the form
  //   if (!userAlreadyExists($email)) { //we check if that user already exists in the table and if not we
  //     $sqlString = "INSERT INTO `user` (`fname`, `lname`, `email`, `phone`, `password`, `privilege`) VALUES (?, ?, ?, ?, ?, 'user')";
  //     $password = password_hash($password, PASSWORD_DEFAULT);
  //     $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
  //     $statement->bind_param('sssss', $fname, $lname, $email, $phone, $password); //prevents sql injections

  //     $statement->execute(); //we insert the user into the database
  //     if ($statement->affected_rows == 1) { //if a row is affected(successful insertion)
  //       $_SESSION['email'] = $email;
  //       sendConfirmationMail($fname, $email);
  //       header("Location:profile.php?signup=successful");
  //     }
  //   } else {
  //     $GLOBALS['hideForm'] = false; //if that user already exists we show the form again and tell the user that the car already exists
  //     $GLOBALS['errors']['email'] = "This email already belongs to an account";
  //   }
  // }
}

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
    <!-- <iframe class="mb-3"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d38122.96434163284!2d-6.30216616676781!3d53.330988312212234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670c1833b915c7%3A0x4f83acae16f5062e!2sGriffith%20College!5e0!3m2!1sen!2sie!4v1682433358078!5m2!1sen!2sie"
      width="auto" height="400" style="border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe> -->
    <div class="row">
      <p><img class="me-3 contact-icon" src="/ChildCare/images/icons/house-fill.svg" alt="email icon">
        Belgard, Dublin, D24XC2G</p>
    </div>
    <div class="row">
      <p><img class="me-3 contact-icon" src="/ChildCare/images/icons/envelope-fill.svg" alt="email icon">
        tiny.toddlers.dublin@gmail.com</p>
    </div>
    <div class="row">
      <p><img class="me-3 contact-icon" src="/ChildCare/images/icons/telephone-fill.svg" alt="phone icon">
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
          <label for="subject" class="form-label">Subject</label>
          <input class="form-control form-control-sm" type="text" name="subject" id="subject" <?php
          if (isset($subject))
            echo "value='$subject'";
          ?>>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="details" class="form-label">Details</label>
          <textarea class="form-control form-control-sm" type="text" name="details" id="details" form="contact" <?php
          if (isset($details))
            echo "value='$details'";
          ?>></textarea>
        </div>
      </div>
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/footer.php");
?>