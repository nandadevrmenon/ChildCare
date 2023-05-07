<?php

function userAlreadyExists($email)
{
  $sqlString = "SELECT `id`,`email` FROM `user` WHERE `email` = ?";
  $statement = $GLOBALS['db']->prepare($sqlString); //we prepare the statement
  $statement->bind_param('s', $email); //we bind the variables into the statemaent
  $statement->execute();
  $result = $statement->get_result();
  $result = $result->fetch_assoc();
  return isset($result); //if we get a result it means that such a user exists so we should prevent the addition of the new car so as to prevent duplicate entries
}

function getUserInfo($email)
{
  $sqlString = "SELECT `id`,`fname`,`lname`,`phone` FROM `user` WHERE `email` = ?";
  $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
  $statement->bind_param('s', $email); //bind the email variable
  $statement->execute();
  $result = $statement->get_result();
  $result = $result->fetch_assoc(); //fetches association
  return $result; //returnt that associative array

}

function getUserPW($email)
{
  $sqlString = "SELECT `password` FROM `user` WHERE `email` = ?";
  $statement = $GLOBALS['db']->prepare($sqlString); //we check if the car with same registrtion or VIN exists already in the db 
  $statement->bind_param('s', $email);
  $statement->execute();
  $result = $statement->get_result();
  $result = $result->fetch_assoc();
  return $result['password']; //if we get a result it means that such a car exists so we should prevent the addition of the new car so as to prevent duplicate entries

}


function userIsAdmin($email)
{
  $sqlString = "SELECT `privilege` FROM `user` WHERE `email` = ?";
  $statement = $GLOBALS['db']->prepare($sqlString); //we check if the car with same registrtion or VIN exists already in the db 
  $statement->bind_param('s', $email);
  $statement->execute();
  $result = $statement->get_result();
  $result = $result->fetch_assoc();
  return $result['privilege'] == "admin"; //if we get a result it means that such a car exists so we should prevent the addition of the new car so as to prevent duplicate entries
}


function childAlreadyExists($fname, $lname)
{
  $sqlString = "SELECT `fname`,`lname`,`user-id` FROM `child` WHERE `fname` = ? AND `lname`=? AND `user-id`=? ;";
  $statement = $GLOBALS['db']->prepare($sqlString); //we prepare the statement
  $statement->bind_param('sss', $fname, $lname, $_SESSION['userID']); //we bind the variables into the statemaent
  $statement->execute();
  $result = $statement->get_result();
  $result = $result->fetch_assoc();
  return isset($result); //if we get a result it means that such a user exists so we should prevent the addition of the new car so as to prevent duplicate entries
}


function getServiceInfo()
{
  $serviceInfo = array("names" => array("One Half Day", "One Full Day", "Three Half Days", "Three Full Days", "Five Half Days", "Five Full Days"), "fees" => array());

  $sqlString = "SELECT `fee` FROM `service`;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->execute();
  $result = $statement->get_result();
  while ($row = $result->fetch_assoc()) {
    array_push($serviceInfo['fees'], $row['fee']);
  }

  return $serviceInfo; //returnt that associative array
}


function updateFees($id, $value)
{
  $sqlString = "UPDATE `service` SET `fee` = ? WHERE `id` = ?;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->bind_param('ss', $value, $id); //we bind the variables into the statemaent
  $statement->execute();
  if (mysqli_affected_rows($GLOBALS['db']) == 1) {
    return true;
  }
  return false;

}

function changeVisibility($id)
{
  $sqlString = "UPDATE `testimonial` SET `status` = !`status` WHERE `id` = ?;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->bind_param('s', $id); //we bind the variables into the statemaent
  $statement->execute();
  if (mysqli_affected_rows($GLOBALS['db']) == 1) {
    return true;
  }
  return false;

}


function fetchHomeSections()
{
  $allSections = array();

  $sqlString = "SELECT E.*, L.text, L.url as `link` FROM (SELECT H.id, H.header, H.body, H.`img-id`, H.`link-id`, I.name, I.url FROM `home` H INNER JOIN `images` I ON H.`img-id` = I.`id` ) E INNER JOIN `link` L ON E.`link-id` = L.`id`;"; //fecthed detials for each feature section in the home page
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->execute();
  $result = $statement->get_result();

  while ($row = $result->fetch_assoc()) {
    array_push($allSections, $row);
  }

  return $allSections; //returnt that associative array


}

function updateHomeSection($id, $header, $body, $link, $image)
{
  $sqlString = "UPDATE `home` SET `header` = ?, `body` = ?, `img-id` = ?, `link-id` = ? WHERE `id` = ?;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->bind_param('ssiis', $header, $body, $image, $link, $id); //we bind the variables into the statemaent
  $statement->execute();
  if (mysqli_affected_rows($GLOBALS['db']) == 1) {
    return true;
  }
  return false;
}


function fetchChildNames()
{
  $childNames = array();
  $sqlString = "SELECT id, fname, lname FROM child WHERE `user-id` = ? ;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->bind_param('s', $_SESSION['userID']); //we bind the variables into the statemaent
  $statement->execute();
  $result = $statement->get_result();

  while ($row = $result->fetch_assoc()) {
    $childNames[$row['id']] = $row['fname'] . " " . $row['lname'];
  }

  return $childNames; //returnt that associative array

}

function fetchAllChildNames()
{
  $childNames = array();
  $sqlString = "SELECT id, fname, lname FROM child;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->execute();
  $result = $statement->get_result();

  while ($row = $result->fetch_assoc()) {
    $childNames[$row['id']] = $row['fname'] . " " . $row['lname'];
  }

  return $childNames; //returnt that associative array

}


function addChildLog($childID, $addDate, $breakfast, $lunch, $temp, $activity)
{
  $sqlString = "INSERT INTO `dailylog`(`child-id`,`date`,`temp`,`breakfast`,`lunch`,`activity`) VALUES (?, ?, ?, ?, ?, ?);";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
  $statement->bind_param('ssisss', $childID, $addDate, $temp, $breakfast, $lunch, $activity); //we bind the variables into the statemaent
  try {
    $statement->execute();
  } catch (mysqli_sql_exception $sqle) {
    return false;
  }

  if ($statement->affected_rows == 1)
    return true;
  return false;
}
?>