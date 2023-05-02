<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/validationFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/scripts/fetchFunctions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/ChildCare/database.php"; //require the db 


$GLOBALS['errors'] = array();
$GLOBALS['hideForm'] = false; //variables that holds if the form is to be hideen after registration or not

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
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST[''])) {

  }
}

if (!$GLOBALS['hideForm']) {
  $email = $_SESSION['email'];
  $userInfo = getUserInfo($email);
  $fname = $userInfo['fname'];
  $lname = $userInfo['lname'];
  $phone = $userInfo['phone'];
  ?>
  
  <div class="profile-container">
    <div class="card w-60 p-5">
      <h1>Registered Children</h1>
      <div>
        <!--- cards ----->

            <div class="card w-90 p-5" style=" border:1px #ccc solid;">
                <div class="card-body">
                  <div class = card_det >
                  <ul style="padding-left:0px">
                    <li class="fs-3" style="display:inline ; padding-right:350px">ID: 23425</li>
                    <li class="fs-5"style="display:inline; padding-right:0px">12/03/23</li>
                  </ul>
                    
                    <p class="fs-4">Name:</p>
                  </div>

                    <div class = card_det >
                    <ul style="padding-left:0px">
                      <li style="display:inline; padding-right:120px">Temperature:</li>
                      <li style="display:inline; padding-right:120px">Breakfast:</li>
                      <li style="display:inline; padding-right:10px">Lunch:</li>
                    </ul>
                    </div>
                    <div>
                      <u class="fs-4"> Activity</u>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">veiw childs report</a>
                    </div>
                  </div>
            </div> 
            <div class="card w-90 p-5" style=" border:1px #ccc solid;">
                <div class="card-body">
                  <div class = card_det >
                  <ul style="padding-left:0px">
                    <li class="fs-3" style="display:inline ; padding-right:350px">ID: 23425</li>
                    <li class="fs-5"style="display:inline; padding-right:0px">12/03/23</li>
                  </ul>
                    
                    <p class="fs-4">Name:</p>
                  </div>

                    <div class = card_det >
                    <ul style="padding-left:0px">
                      <li style="display:inline; padding-right:120px">Temperature:</li>
                      <li style="display:inline; padding-right:120px">Breakfast:</li>
                      <li style="display:inline; padding-right:10px">Lunch:</li>
                    </ul>
                    </div>
                    <div>
                      <u class="fs-4"> Activity</u>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">veiw childs report</a>
                    </div>
                  </div>
            </div> 
      </div>
    </div>
    
    


    <div class="card w-35 p-5">
      <form action="/ChildCare/scripts/deleteAcc.php" method="POST" novalidate>
        <h1>Add New Log
        </h1>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <label for="fname" class="form-label">Child ID</label>
            <input type="number" class="form-control" id="child_id" name="child_id" aria-describedby="child_id">  
          </div>
        </div>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <label for="lname" class="form-label">Child Name</label>
            <input type="text" class="form-control" id="child_name"  name="child_name">  
          </div>
        </div>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <label for="lname" class="form-label">Temperature</label>
            <input type="temperature" class="form-control" id="temp" name="temp" aria-describedby="temp">  
          </div>
        </div>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <label for="lname" class="form-label">Breakfast</label>
            <input type="text" class="form-control" id="breakfast"  name ="breakfast" aria-describedby="breakfast">  
          </div>
        </div>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <label for="lname" class="form-label">Lunch</label>
            <input type="lunch" class="form-control" id="lunch" name ="lunch" aria-describedby="lunch">  
          </div>
        </div>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <label for="lname" class="form-label">Activity</label>
            <input type="text" class="form-control" id="activity" name ="activity" aria-describedby="activity">  
          </div>
        </div>
        <div class="row g-2 mb-3">
          <div class="col-md">
            <label for="lname" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name ="date" aria-describedby="date">          </div>
        </div>
        <div class="row g-2">
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Add Log</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/ChildCare/components/footer.php");
?>