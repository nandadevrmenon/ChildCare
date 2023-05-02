<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 


if (!isset($_SESSION['email'])) { //if not logges in show error and kill php
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") { //handles the re directs to the profile page
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
  if (isset($_GET['child'])) {
    echo "<div class='alert alert-success w-75' role='alert'>
    Your child has been registered successfully!
  </div>";
  }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") { //for deleting children
  deleteChild($_POST['childID']);
}

$email = $_SESSION['email']; //set all the main profile variables before we fetch the children
$userInfo = getUserInfo($email);
$phone = $userInfo['phone'];
$_SESSION['userID'] = $userInfo['id'];


require_once(dirname(__FILE__) . "/../scripts/fetchChildren.php"); //fetch the children after setting id (we set the id here user is redirected to profile after login )

$fname = $userInfo['fname']; //re initalize these beacuse we use the same global variables to fetch children
$lname = $userInfo['lname'];


?>
<div class="main-container">
  <div class="card w-35 p-5">
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
        <button type="submit" class="btn btn-danger mb-3" id="deleteAccount"
          data-id="<?php echo $_SESSION['userID']; ?>" data-action="account" data-bs-toggle='modal'
          data-bs-target='#profilePageModal'>Delete
          Account</button>
      </div>
    </div>
  </div>
  <div class="card w-55 p-5 mb-5">
    <h1>Registered Children</h1>
    <div id="childListContainer">
      <?php
      echo $GLOBALS['childList']; ?>
    </div>
    <a href="/ChildCare/pages/registration.php" class="btn btn-primary w-50 mx-auto mt-3">Register Child</a>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/profilePageModal.php");
echo $modal;
require_once(dirname(__FILE__) . "/../components/footer.php");
?>