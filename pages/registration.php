<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 


$GLOBALS['errors'] = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = cleanInput($_POST["fname"]); //clean all inputs to correct format
  $lname = cleanName($_POST["lname"]);
  $planID = cleanInput($_POST["plan"]);
  $age = cleanInput($_POST["age"]);

  validateFirstName($fname);
  validateLastName($lname);
  validatePlan($planID);
  validateAge($age);

  if (count($errors) == 0) {
    if (!childAlreadyExists($fname, $lname)) { //we check if that user already exists in the table and if not we
      $sqlString = "INSERT INTO `child` (`fname`, `lname`, `age-category`, `user-id`, `service-id`) VALUES (?, ?, ?, ?, ?)";
      $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
      $statement->bind_param('sssss', $fname, $lname, $age, $_SESSION['userID'], $planID); //prevents sql injections

      $statement->execute(); //we insert the user into the database
      if ($statement->affected_rows == 1) { //if a row is affected(successful insertion)
        header("Location:profile.php?child=added");
      }
    } else {
      $GLOBALS['errors']['name'] = "You already have a child with the same name.";
    }
  }
}


require_once dirname(__FILE__) . "/../components/registrationHero.php"; //displays the fee information
require_once dirname(__FILE__) . "/../scripts/fetchFees.php"; //displays the fee information



if (isset($_SESSION['email'])) {
  ?>


  <div class="card w-60 p-5 mx-auto mt-3 mb-5" id="registration-form">
    <form class=" container" action="/ChildCare/pages/registration.php" method="POST" novalidate>
      <h1 class="mb-3">Enter your child's details</h1>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <div class="form-floating">
            <input type="text" class="form-control" id="fname" name="fname" placeholder="John" <?php
            if (isset($fname))
              echo "value='$fname'";
            ?> length="40">
            <label for="fname">First Name</label>
          </div>
          <?php
          if (isset($GLOBALS["errors"]["fname"])) {
            $message = $GLOBALS['errors']['fname'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
        <div class="col-md">
          <div class="form-floating">
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Doe" <?php
            if (isset($lname))
              echo "value='$lname'";
            ?> length="40">
            <label for="lname">Last Name</label>
          </div>
          <?php
          if (isset($GLOBALS["errors"]["lname"])) {
            $message = $GLOBALS['errors']['lname'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
        <?php
        if (isset($GLOBALS["errors"]["name"])) {
          $message = $GLOBALS['errors']['name'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
      <div class="row g-2 mb-3">
        <select name="age" id="age" class="col-md form-select form-select-lg registration-select"
          aria-label="Default select example">
          <option value="" selected disabled>Age group</option>
          <option value="Baby" <?php if ($age == "Baby")
            echo 'selected="selected"'; ?>>Baby (6-12 months)</option>
          <option value="Wobbler" <?php if ($age == "Wobbler")
            echo 'selected="selected"'; ?>>Wobbler (1-2 years)</option>
          <option value="Toddler" <?php if ($age == "Toddler")
            echo 'selected="selected"'; ?>>Toddler (2-3 years)</option>
          <option value="PreSchooler" <?php if ($age == "PreSchooler")
            echo 'selected="selected"'; ?>>Pre-Schooler (3-4
            years)
          </option>
        </select>
        <?php
        if (isset($GLOBALS["errors"]["age"])) {
          $message = $GLOBALS['errors']['age'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
      <div class="row g-2 mb-3">

        <select name="plan" id="plan" class="col-md form-select form-select-lg registration-select"
          aria-label="Default select example">
          <option value="" selected disabled>Childcare Plan</option>
          <option value="1">One Half Day</option>
          <option value="2">One Full Day</option>
          <option value="3">Three Half Days</option>
          <option value="4">Three Full Days</option>
          <option value="5">Five Half Days</option>
          <option value="6">Five Full Days</option>
        </select>
        <div class="col-md">
          <div class="form-floating">
            <input type="text" class="form-control" id="fees" name="fees" placeholder="fees" readonly>
            <label id="fee-label" for="password">Fees</label>
          </div>
        </div>
        <?php
        if (isset($GLOBALS["errors"]["plan"])) {
          $message = $GLOBALS['errors']['plan'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3">Add Child</button>
        </div>
      </div>
    </form>
  </div>

  <?php
} else { //if user isnt logged in 
  ?>
  <div class="card mt-3 mb-5">
    <h5 class="card-header">You are not signed in.</h5>
    <div class="card-body">
      <p class="card-text">Sorry, but you will need to create an account before registering your child in our daycaer</p>
      <a href="/ChildCare/pages/signup.php" class="btn btn-primary">Create Account</a>
    </div>
  </div>
  <?php
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "<script>
  window.scrollTo(0,700);
</script>";
}
require_once(dirname(__FILE__) . "/../components/footer.php");
?>