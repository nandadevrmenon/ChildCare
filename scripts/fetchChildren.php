<?php


$GLOBALS['childList'] = "<p>You currently have no registered children.</p>"; //fallback


$sqlString = "SELECT * FROM `child` WHERE `user-id`=?";
$statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
$statement->bind_param('s', $_SESSION['userID']); //prevents sql injections
$statement->execute();
$result = $statement->get_result();

if ($result->num_rows != 0) {
  $GLOBALS['childList'] = "";
  $serviceInfo = getServiceInfo();

  $count = 0;
  while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $fname = $row["fname"];
    $lname = $row["lname"];
    $age = $row["age-category"];
    $planID = $row["service-id"];

    $planName = $serviceInfo["names"][$planID - 1];
    $planFees = $serviceInfo['fees'][$planID - 1];

    if ($count % 2 == 0) {
      $GLOBALS['childList'] = $GLOBALS['childList'] . "<div class='row mb-3'>";
    }


    $GLOBALS["childList"] = $GLOBALS['childList'] . " <div class='col-sm-6'>
      <div class='card'>
        <div class='card-body'>
          <h5 class'card-title'>$fname $lname</h5>
          <p class='card-text mb-1'>Age Category: $age</p>
          <p class='card-text mb-1'>ChildCare Plan: $planName</p>
          <p class='card-text'>Fees: €$planFees</p>
          <button type='button' class='btn btn-danger'  data-action='child' data-id='$id' data-bs-toggle='modal' data-bs-target='#profilePageModal'>
            Unregister
          </button>
        </div>
      </div>
    </div>";


    if ($count % 2 == 1) {
      $GLOBALS['childList'] = $GLOBALS['childList'] . "</div>";
    }
    $count = $count + 1;
  }

  if ($count % 2 == 1) {
    $GLOBALS['childList'] = $GLOBALS['childList'] . "</div>";
  }
}

$result->free();

?>