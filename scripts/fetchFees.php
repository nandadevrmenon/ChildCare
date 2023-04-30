<?php

$feesArray = array();
$sqlString = "SELECT `fee` FROM `service`;";
$statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
$statement->execute();
$result = $statement->get_result();
while ($row = $result->fetch_assoc()) {
  array_push($feesArray, $row['fee']);
}

$halfDay = $feesArray[0];
$fullDay = $feesArray[1];
$threeHalfDay = $feesArray[2];
$threeFullDay = $feesArray[3];
$fiveHalfDay = $feesArray[4];
$fiveFullDay = $feesArray[5];


$feeBoxes = <<<ID
<div class="container mb-3 mt-3" id="feeBoxContainer">
  <div class="card-group">
    <div class="card">
      <img class="card-img" style="filter: brightness(50%);" src="/ChildCare/images/daycare10.jpeg"
        alt="Daycare Image 1">
      <div class="card-img-overlay text-white">
        <h1 class="card-title">One Day</h1>
        <h4>Half Day: €$halfDay</h4>
        <h4>Full Day: €$fullDay</h4>

      </div>
    </div>
    <div class="card">
      <img class="card-img" style="filter: brightness(50%);" src="/ChildCare/images/daycare11.jpg"
        alt="Daycare Image 1">
      <div class="card-img-overlay text-white">
        <h1 class="card-title">Three Days</h1>
        <h4>Half Day: €$threeHalfDay</h4>
        <h4>Full Day: €$threeFullDay</h4>

      </div>
    </div>
    <div class="card">
      <img class="card-img" style="filter: brightness(50%);" src="/ChildCare/images/daycare12.jpg"
        alt="Daycare Image 1">
      <div class="card-img-overlay text-white">
        <h1 class="card-title">Five Days</h1>
        <h4>Half Day: €$fiveHalfDay</h4>
        <h4>Full Day: €$fiveFullDay</h4>
      </div>
    </div>
  </div>
</div>
ID;


echo $feeBoxes;



?>