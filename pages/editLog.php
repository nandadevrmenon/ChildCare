<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

if (!isset($_SESSION['privilege'])) {
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}

$GLOBALS['errors'] = array();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $breakfast = cleanName($_POST['breakfast']); //used cleanName as it has the same functinality and shold work for comma seperated breakfast and lunch
    $lunch = cleanName($_POST['lunch']);
    $temp = cleanInput($_POST['temp']);
    $activity = cleanText($_POST['activity']);


    validateFood($breakfast, "breakfast");
    validateFood($lunch, "lunch");
    validateActivity($activity);
    validateTemp($temp);


    if (count($errors) == 0) { //if no errors
      updateChildLog($id, $breakfast, $lunch, $activity, $temp);
      header("Location:addLog.php?update=success");

    } else {
      $logInfo = getLogInfo($id);
    }
  } else if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    deleteChildLog($id);
    header("Location:addLog.php?delete=success");
  }


} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $logInfo = getLogInfo($_GET['id']);

}

$id = $logInfo['id'];
$breakfast = $logInfo['breakfast'];
$date = date("d-m-Y", strtotime($logInfo['date']));
$temp = $logInfo['temp'];
$lunch = $logInfo['lunch'];
$activity = $logInfo['activity'];
$fname = $logInfo['fname'];
$lname = $logInfo['lname'];


?>


<div class="card w-35 p-5">
  <h1>Update Log </h1>
  <form action="editLog.php" method="POST" novalidate>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="fname" class="form-label">First Name</label>
        <input class="form-control form-control-sm" type="text" name="fname" readonly disabled <?php
        if (isset($fname))
          echo "value='$fname'";
        ?>>
      </div>
      <div class="col-md">
        <label for="lname" class="form-label">Last Name</label>
        <input class="form-control form-control-sm" type="text" name="lname" readonly disabled <?php
        if (isset($lname))
          echo "value='$lname'";
        ?>>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="breakfast" class="form-label">Breakfast</label>
        <input class="form-control form-control-sm" type="text" name="breakfast" id="breakfast" <?php
        if (isset($breakfast))
          echo "value='$breakfast'";
        ?>>
        <?php if (isset($GLOBALS['errors']['breakfast'])) //show error if exists
            echo "<span class='text-danger'>" . $GLOBALS['errors']['breakfast'] . "</span>"; ?>
      </div>
      <div class="col-md">
        <label for="lunch" class="form-label">Lunch</label>
        <input class="form-control form-control-sm" type="text" name="lunch" id="lunch" <?php
        if (isset($lunch))
          echo "value='$lunch'";
        ?>>
        <?php if (isset($GLOBALS['errors']['lunch'])) //show error if exists
            echo "<span class='text-danger'>" . $GLOBALS['errors']['lunch'] . "</span>"; ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="temp" class="form-label">Temperature in Celcius</label>
        <input class="form-control form-control-sm" type="number" min="34" max="40" name="temp" step="0.1" id="temp"
          <?php
          if (isset($temp))
            echo "value='$temp'";
          ?>>
        <?php if (isset($GLOBALS['errors']['temp'])) //show error if exists
            echo "<span class='text-danger'>" . $GLOBALS['errors']['temp'] . "</span>"; ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="activity" class="form-label">Activity</label>
        <textarea class="form-control form-control-sm" type="text" name="activity" id="activity"><?php
        if (isset($activity))
          echo $activity;
        ?></textarea>
        <?php if (isset($GLOBALS['errors']['activity'])) //show error if exists
            echo "<span class='text-danger'>" . $GLOBALS['errors']['activity'] . "</span>"; ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="date" class="form-label">Date (Cannot be Changed)</label>
        <input class="form-control form-control-sm" type="date" min="2020-01-01" max="<?php echo date("Y-m-d") ?>"
          name="addDate" <?php
          if (isset($addDate))
            echo "value='$addDate'";
          ?> disabled readonly>
      </div>
    </div>
    <div class="row g-2">
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3" value="<?php echo $logInfo['id'] ?>" name="update">Update
        </button>
      </div>
    </div>
    <div class="row g-2">
      <div class="col-auto">
        <button type="submit" class="btn btn-danger mb-3" value="<?php echo $logInfo['id'] ?>" name="delete">Delete
          (Cannot be Undone)
        </button>
      </div>
    </div>
  </form>
</div>

<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>