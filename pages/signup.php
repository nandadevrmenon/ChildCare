<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/header.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/validationFunctions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/fetchFunctions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/database.php"); //require the db 

$GLOBALS['errors'] = array();
$GLOBALS['hideForm'] = false; //variables that holds if the form is to be hideen after registration or not

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = cleanInput($_POST["fname"]); //clean all inputs to corrcet format
  $lname = cleanName($_POST["lname"]);
  $phone = cleanInput($_POST["phone"]);
  $email = cleanInput($_POST["email"]);
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  validateFirstName($fname);
  validateLastName($lname);
  validatePhone($phone);
  validateEmail($email);
  validatepasswords($password, $confirmPassword);

  if (count($errors) == 0) {
    $GLOBALS['hideForm'] = true; //if there are no errors we hide the form
    if (!userAlreadyExists($email)) { //we check if that user already exists in the table and if not we
      $sqlString = "INSERT INTO `user` (`fname`, `lname`, `email`, `phone`, `password`, `privilege`) VALUES (?, ?, ?, ?, ?, 'user')";
      $password = password_hash($password, PASSWORD_DEFAULT);
      $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
      $statement->bind_param('sssss', $fname, $lname, $email, $phone, $password); //prevents sql injections

      $statement->execute(); //we insert the user into the database
      if ($statement->affected_rows == 1) { //if a user has been added succesfully 
        //       echo "<h4 class='mb-4'>Your car has been added to our database <span class='text-success'>successfully!</span></h4><div class='mt-3 mb-3'><a href='addCar.php'>
        //   <button class='btn btn-primary' type='button'>Add New Car</button></a>
        // </div><div class='mt-3 mb-5'><a href='index.html'>
        // <button class='btn btn-primary' type='button'>Back to Home</button></a>
        // </div>";
        //     } else { //this else statment is kind of pointless because if no rows are effected it is probably an uncaught sql error taht stop the system and throw a a system error anyway. So this code wont run
        //       echo "<h2>An unexpected error occured. Please Try Again later</h2>";

        $_SESSION['email'] = $email;
        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        header("Location:profile.php?signup=successful");
      }
    } else {
      $GLOBALS['hideForm'] = false; //if that user already exists we show the form again and tell the user that the car already exists
      $GLOBALS['errors']['email'] = "This email already belongs to an account";
    }
  }
}

// }
// }
if (!$GLOBALS['hideForm']) {
  ?>
  <div class="w-100">
    <div class="card w-75 p-5 mx-auto">
      <form class="container" action="/ChildCare/pages/signup.php" method="POST" novalidate>
        <h1>Sign up</h1>
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
        </div>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <div class="form-floating">
              <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com" <?php
              if (isset($email))
                echo "value='$email'";
              ?> length="75">
              <label for="email">Email</label>
              <?php
              if (isset($GLOBALS["errors"]["email"])) {
                $message = $GLOBALS['errors']['email'];
                echo "<span class='text-danger'>$message</span>";
              }
              ?>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating">
              <input type="text" class="form-control" id="phone" name="phone" placeholder="0899898787" <?php
              if (isset($phone))
                echo "value='$phone'";
              ?> length="10">
              <label for="phone">Irish Phone Number</label>
            </div>
            <?php
            if (isset($GLOBALS["errors"]["phone"])) {
              $message = $GLOBALS['errors']['phone'];
              echo "<span class='text-danger'>$message</span>";
            }
            ?>
          </div>
        </div>
        <div class="row g-2">
          <div class="col-md">
            <div class="form-floating">
              <input type="password" class="form-control" id="password" name="password" placeholder="password" <?php
              if (isset($password))
                echo "value='$password'";
              ?> length="50">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="col-md">
            <div class="form-floating">
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                placeholder="password" <?php
                if (isset($confirmPassword))
                  echo "value='$confirmPassword'";
                ?> length="50">
              <label for="confirmPassword">Confirm Password</label>
            </div>
          </div>
        </div>
        <div class="row g-2 mb-3">
          <?php
          if (isset($GLOBALS["errors"]["password"])) {
            $message = $GLOBALS['errors']['password'];
            echo "<span class='text-danger'>$message</span>";
          }
          ?>
        </div>
        <div class="row g-2">
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Create Account</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/footer.php");
?>