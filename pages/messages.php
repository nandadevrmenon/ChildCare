<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

$GLOBALS['errors'] = array();

if (!isset($_SESSION['privilege'])) {
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}


$email = $_SESSION['email'];
$userInfo = getUserInfo($email);
$fname = $userInfo['fname'];
$lname = $userInfo['lname'];
$phone = $userInfo['phone'];
?>
<div class="main-container">
  <div class="card w-75 p-5">
    <h1>Messages</h1>
    <div class="card">
      <div class="card-header d-flex ">
        <p class="my-0 me-3">John Doe</p>
        <p class="my-0 ms-3">0899787654</p>
      </div>
      <div class="card-body">
        <h5 class="card-title">Job Opening</h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil id culpa
          perferendis tenetur
          porro earum similique repellat suscipit ex officia iste accusantium adipisci obcaecati corporis possimus odio,
          neque fugit est.</p>
        <a href="mailto:johndoe@fakeemail.com" class="btn btn-primary">Send Reply</a>
        <a href="#" class="btn btn-danger">Delete</a>
      </div>
      <div class="card-footer text-muted text-center">
        2 days ago
      </div>
    </div>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>