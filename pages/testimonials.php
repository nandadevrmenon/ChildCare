<?php
session_start();
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 


$GLOBALS['errors'] = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $body = cleanText($_POST["body"]);
  $serviceID = cleanInput($_POST['serviceID']);
  validateBigText($body);
  validatePlan($serviceID);

  if (count($errors) == 0 && !isset($_COOKIE['testimonialSent'])) { //if there are no errors  and we havent sent a query in the past 2 minutes we submit the query
    $sqlString = "INSERT INTO `testimonial` ( `user-id`,`body`,`service-id`,`date`,`status`) VALUES (?, ?, ?, ?, false)";
    $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
    $CurrentDate = date("Y-m-d");
    $statement->bind_param('ssis', $_SESSION['userID'], $body, $serviceID, $CurrentDate); //prevents sql injections
    $statement->execute(); //we insert the query into the database
    if ($statement->affected_rows == 1) { //if a row is affected(successful insertion)
      setcookie('testimonialSent', 'true', time() + 86400, '/', '', 0); //we set cookie that an enquiry Has been sent and use that cookie to disable the form for a day
      $_COOKIE['testimonialSent'] = true;
      $GLOBALS['sentNow'] = true;
    }
  }
}

require_once dirname(__FILE__) . "/../components/header.php"; //display the header. We have to display it here becauase we are setting a cookie so we cant send any html before that
require_once dirname(__FILE__) . "/../components/testimonialsHero.php"; //displays the fee information
require_once(dirname(__FILE__) . "/../scripts/fetchTestimonials.php");
?>


<div class="card w-75 p-5 mb-5">
  <h1 class="mb-3">Testimonials</h1>
  <?php echo $viewTestimonials; ?>
</div>


<?php
if (isset($_SESSION['email'])) {
  $serviceInfo = getServiceInfo();

  ?>


  <div class="card w-60 p-5 mx-auto mt-3 mb-5" id="add-testimonial-form">
    <form class=" container" action="/ChildCare/pages/testimonials.php" method="POST" id="testimonial" novalidate>
      <h1 class="mb-3">Add Testimonial</h1>
      <p>Share your experience with us! Your feedback helps us improve our services and provide the best possible care
        for your child. Fill out the form below and help us make more happy parents!</p>
      <div class="row g-2 mb-3">
        <select name="serviceID" id="serviceID" class="col-md form-select form-select-lg registration-select" <?php
        if (isset($_COOKIE['testimonialSent'])) {
          echo "disabled";
        } ?>>
          <option value="" selected disabled>Choose a service</option>
          <?php
          foreach ($serviceInfo['names'] as $id => $name) {
            $selected = "";
            if ($serviceID == $id + 1) {
              $selected = "selected";
            }
            $value = $id + 1;
            echo "<option value='$value' $selected>$name</option>";
          }
          ?>
        </select>
        <?php
        if (isset($GLOBALS["errors"]["plan"])) {
          $message = $GLOBALS['errors']['plan'];
          echo "<span class='text-danger'>$message</span>";
        } ?>
      </div>
      <div class="row g-2 mb-3">
        <textarea required class="form-control form-control-sm" type="text" name="body" id="body" form="testimonial" <?php
        if (isset($_COOKIE['testimonialSent'])) {
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
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3" <?php
          if (isset($_COOKIE['testimonialSent'])) {
            echo "disabled";
          }
          ?>>Submit</button>
        </div>
      </div>
      <?php
      if (isset($GLOBALS['sentNow'])) {
        echo "<span class='text-success'> Your testimonial has been sent to the admin for approval. Thanks! <br></span>";
      }
      if (isset($_COOKIE['testimonialSent'])) {
        echo "<span class='text-danger'>You can only submit one testimonial a day.</span>";
      }
      ?>
    </form>
  </div>

  <?php
}

require_once(dirname(__FILE__) . "/../components/footer.php");
?>