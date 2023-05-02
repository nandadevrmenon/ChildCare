<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

$GLOBALS['errors'] = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = cleanEmail($_POST["email"]); //clean all inputs to correct format
  $password = $_POST["password"];

  validateEmail($email);

  if (count($errors) == 0) {
    if (userAlreadyExists($email)) { //we check if that user already exists in the table and if not we
      $pwInDatabase = getUserPW($email);
      echo password_verify($password, $pwInDatabase);
      if (password_verify($password, $pwInDatabase)) { //if a row is affected(successful insertion)
        $_SESSION['email'] = $email;
        if (userIsAdmin($email))
          $_SESSION['privilege'] = "super";
        header("Location:profile.php?login=successful");
      } else {
        $GLOBALS['errors']['password'] = "Incorrect password";
      }
    } else {
      //if user does not exists we say that the email entered does not belong to an account
      $GLOBALS['errors']['email'] = "This email does not belong to an account";
    }
  }
}
?>
<div class="w-100 min-vh-85 d-flex align-items-center justify-content-center">
  <div class="w-100">
    <div class="card w-40 p-5 mx-auto">
      <form class="container" action="/ChildCare/pages/login.php" method="POST" novalidate>
        <h1 class="text-center mb-4">Log in</h1>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <div class="form-floating">
              <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com" <?php
              if (isset($email))
                echo "value='$email'";
              ?> length="75">
              <label for="email">E-mail</label>
            </div>
            <?php
            if (isset($GLOBALS["errors"]["email"])) {
              $message = $GLOBALS['errors']['email'];
              echo "<span class='text-danger'>$message</span>";
            }
            ?>
          </div>
        </div>
        <div class="row g-2 mb-2">
          <div class="col-md">
            <div class="form-floating">
              <input type="password" class="form-control" id="password" name="password" placeholder=" " length="50">
              <label for="password">Password</label>
              <?php
              if (isset($GLOBALS["errors"]["password"])) {
                $message = $GLOBALS['errors']['password'];
                echo "<span class='text-danger'>$message</span>";
              }
              ?>
            </div>
          </div>
        </div>
        <div class="row g-2 mb-3">
          <span><a href="/ChildCare/pages/signup.php" class="text-secondary">Don't have an account? Create one
              here.</a></span>
        </div>
        <div class="row g-2">
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Log in</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>