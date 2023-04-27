<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 


$GLOBALS['errors'] = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['signup'])) {
    echo "<div class='alert alert-success w-75' role='alert'>
    Your account has been created successfully!
  </div>";
  }
  if (isset($_GET['login'])) {
    echo "<div class='alert alert-success w-75' role='alert'>
    You have logged in successfully!
  </div>";
  }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") { //delete account and/or children
  if (isset($_POST[''])) {

  }
}


$email = $_SESSION['email'];
$userInfo = getUserInfo($email);
$fname = $userInfo['fname'];
$lname = $userInfo['lname'];
$phone = $userInfo['phone'];
?>
<div class="main-container">
  <div class="card w-35 p-5">
    <form action="/ChildCare/scripts/deleteAcc.php" method="POST" novalidate>
      <h1>Hi,
        <?php echo $fname; ?>
      </h1>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="fname" class="form-label">First Name</label>
          <input class="form-control form-control-sm" type="text" name="fname" readonly <?php
          if (isset($fname))
            echo "value='$fname'";
          ?>>
        </div>
        <div class="col-md">
          <label for="lname" class="form-label">Last Name</label>
          <input class="form-control form-control-sm" type="text" name="lname" readonly <?php
          if (isset($lname))
            echo "value='$lname'";
          ?>>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="lname" class="form-label">Email</label>
          <input class="form-control form-control-sm" type="text" name="lname" readonly <?php
          echo "value='$email'";
          ?>>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <label for="lname" class="form-label">Phone Number</label>
          <input class="form-control form-control-sm" type="text" name="lname" readonly <?php
          if (isset($phone))
            echo "value='$phone'";
          ?>>
        </div>
      </div>
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-danger mb-3">Delete Account</button>
        </div>
      </div>
    </form>
  </div>
  <div class="card w-55 p-5">
    <h1>Registered Children</h1>
    <div>
    </div>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>