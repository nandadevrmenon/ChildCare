<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 
require_once dirname(__FILE__) . "/../scripts/fetchChildrenLogs.php";
if (!isset($_SESSION['privilege'])) { //shows error if user is not admin
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}


$GLOBALS['errors'] = array();
$childrenLogsHTML = ""; //contains html cards for each log 
$childNamesArray = fetchAllChildNames(); //fecthed the names and IDs for all children

if ($_SERVER["REQUEST_METHOD"] == "GET") { //on normal page load 
  $childrenLogsHTML = getAllChildrenLogs(0, $date); //we load all children with no specific date
  if ($_GET['log'] == "added") {
    echo "<div class='alert alert-success w-75' role='alert'>
    Log added successfully!
   </div>";
  } else if ($_GET['update'] == "success") {
    echo "<div class='alert alert-success w-75' role='alert'>
    Log updated successfully!
   </div>";
  } else if ($_GET['delete'] == 'success') {
    echo "<div class='alert alert-danger w-75' role='alert'>
    Log deleted successfully!
   </div>";
  }

} else if ($_SERVER["REQUEST_METHOD"] == "POST") { //on submission 
  if (isset($_POST['filter'])) {
    $childID = cleanChildID($_POST['child'], $childNamesArray); //cleans and only gives valid value
    $date = $_POST['date']; //gets date
    validateLogDate($date); //validates date
    if (count($GLOBALS['errors']) == 0) { //if no erors get specific children
      $childrenLogsHTML = getAllChildrenLogs($childID, $date);
    }
  } else if (isset($_POST['add'])) { //if action is add
    $childID = cleanChildID($_POST['childID'], $childNamesArray); //cleans and only gives valid value
    $addDate = cleanAddDate($_POST['addDate']);
    $breakfast = cleanName($_POST['breakfast']); //used cleanName as it has the same functinality and shold work for comma seperated breakfast and lunch
    $lunch = cleanName($_POST['lunch']);
    $temp = cleanInput($_POST['temp']);
    $activity = cleanText($_POST['activity']);


    validateChildID($childID); //after cleaning we only have to check if it is zero
    validateAddDate($addDate); //validate all other fields as well
    validateFood($breakfast, "breakfast");
    validateFood($lunch, "lunch");
    validateActivity($activity);
    validateTemp($temp);

    if (count($errors) == 0) { //if no errors
      if (addChildLog($childID, $addDate, $breakfast, $lunch, $temp, $activity)) {
        header("Location:addLog.php?log=added");
      } else {
        $duplicateEntry = true;
      }

    }
    $childrenLogsHTML = getAllChildrenLogs(0, $date);

  }

}

?>
<div class="main-container">
  <div class="card w-55 p-5 mb-5 mt-3">
    <h1>Child Logs</h1>
    <form action="addLog.php" method="POST" novalidate id="filterForm">
      <div class="row g-2 mb-3">
        <label for="child">Filter by Child</label>
        <select name="child" id="child" class="col-md form-select form-select-lg registration-select">
          <option value="" selected>All</option>
          <?php
          foreach ($childNamesArray as $id => $name) {
            $selected = "";
            if ($childID == $id) {
              $selected = "selected";
            }
            echo "<option value='$id' $selected>$name</option>";
          }
          ?>
        </select>
      </div>
      <div class="row g-2 mb-3">
        <label for="date">Filter by Date (Leave empty for all logs)</label>
        <input name="date" id="date" type="date" min="2020-01-01" max="<?php echo date("Y-m-d") ?>"></input>
        <?php if (isset($GLOBALS['errors']['date']))
          echo "<span class='text-danger'>Date has to be in the past.</span>"; ?>
      </div>
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3" name="filter" id="filter" value="filter">Filter</button>
        </div>
      </div>
    </form>
    <div>
      <?php echo $childrenLogsHTML; ?>
    </div>
  </div>
  <div class="card w-35 p-5 mt-3 mb-5">
    <form action="addLog.php" method="POST" novalidate>
      <h1>Add New Log
      </h1>
      <div class="row g-2 mb-3">
        <label for="childID">Filter by Child</label>
        <select name="childID" id="childID" class="col-md form-select form-select-lg registration-select">
          <option disabled selected>Choose a Child</option>
          <?php
          foreach ($childNamesArray as $id => $name) {
            $selected = "";
            if ($childID == $id) {
              $selected = "selected";
            }
            echo "<option value='$id' $selected>$name</option>";
          }
          ?>
        </select>
        <?php if (isset($GLOBALS['errors']['childID']))
          echo "<span class='text-danger'>" . $GLOBALS['errors']['childID'] . "</span>"; ?>
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
          <input class="form-control form-control-sm" type="number" min="34" max="40" name="temp" id="temp" <?php
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
          <label for="date" class="form-label">Date (Leave empty for current date)</label>
          <input class="form-control form-control-sm" type="date" min="2020-01-01" max="<?php echo date("Y-m-d") ?>"
            name="addDate" <?php
            if (isset($addDate) && isset($_POST['add']))
              echo "value='$addDate'";
            ?>>
        </div>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-md">
          <?php if ($duplicateEntry)
            echo "<span class='text-danger'>That log couldn't be added. A log for the same child and date might already exist.</span>"; ?>
        </div>
      </div>
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3" name="add" ide="add" value="add">Add Log</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>