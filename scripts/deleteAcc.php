<?php
session_start();
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userID = $_SESSION['userID'];
  if ($_POST['childID'] != $userID) {
    echo "<div class='alert alert-danger w-75' role='alert'>
   STOP MESSING WITH THE HTML.
   </div>";
    return;
  } else {
    $sqlString = "DELETE FROM `user` WHERE `id` = ?;"; //this prevents malicious parents from deleting other parents' children
    $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
    $statement->bind_param('s', $_SESSION['userID']); //prevents sql injections
    $statement->execute(); //we delete the message from the database
    header("Location:logout.php?delete=success");
  }
}
?>