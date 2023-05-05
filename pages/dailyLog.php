<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 
require_once dirname(__FILE__) . "/../scripts/fetchChildrenLogs.php";

if (!isset($_SESSION['email'])) { //shows error if user is not logged in
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}

$errors = array();

$childrenLogsHTML = ""; //contains html cards for each log 
$childNamesArray = fetchChildNames(); //fecthed the names and IDs for given parent

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $childID = cleanChildID($_POST['child'], $childNamesArray); //cleans and only gives valid value
  $date = $_POST['date']; //gets date
  validateLogDate($date); //validates date

  if (count($GLOBALS['errors']) == 0) {
    $childrenLogsHTML = getChildrenLogs($childID, $date);
  }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") { //on normal page load


  $childrenLogsHTML = getChildrenLogs(0, $date); //we load all children with no specific date
}



?>
<div class="main-container">
  <div class="card w-75 p-5 mt-3 mb-5">
    <h1>Child Daily Logs</h1>
    <form action="" method="POST" novalidate>
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
        <label for="date">Filter by Date</label>
        <input name="date" id="date" type="date" min="2020-01-01" max="<?php echo date("Y-m-d") ?>"></input>
      </div>
      <div class="row g-2">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3">Filter</button>
        </div>
      </div>
    </form>
    <?php echo $childrenLogsHTML; ?>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>