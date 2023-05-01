<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

if (!isset($_SESSION['privilege'])) {
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}
$GLOBALS['errors'] = array();
$serviceInfo = getServiceInfo();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['fee'])) {
    echo "<div class='alert alert-success w-75' role='alert'>
    Fees updated successfully!
   </div>";
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($_POST as $key => $value) {
    validateFee($key, $value);
  }
  if (count($GLOBALS['errors']) == 0) {
    $index = 0;
    foreach ($_POST as $key => $value) {
      if ($serviceInfo['fees'][$index] != $value) {
        if (updateFees($index + 1, $value)) {
          $serviceInfo["fees"][$index] = $value;
          header("Location:editFees.php?fee=updated");
        }
      }
      $index++;
    }
  }

}



?>

<div class="w-100 min-vh-85 d-flex align-items-center justify-content-center">
  <div class="w-100">
    <div class="card w-40 p-5 mx-auto mb-5">
      <form class="container" action="/ChildCare/pages/editFees.php" method="POST" novalidate>
        <h1 class="text-center mb-4">Edit Fees</h1>
        <?php
        foreach ($serviceInfo['names'] as $key => $value) {
          $fees = $serviceInfo["fees"][$key];
          $feeID = $key + 1;
          $feeID = "fee" . $feeID;
          $error = "";
          if (isset($GLOBALS['errors'][$feeID]))
            $error = "<span class='text-danger'>" . $GLOBALS['errors'][$feeID] . "</span>";
          echo "<div class='row g-2 mb-3'>
          <div class='col-md'>
            <label for='$feeID' class='form-label'>$value</label>
            <input class='form-control form-control-sm' type='number' min=80 max=2000 name='$feeID' id='$feeID' value='$fees'>
            $error
          </div>
        </div>";

        }
        ?>
        <div class="row g-2">
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" id="updateFees">Update Fees</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>