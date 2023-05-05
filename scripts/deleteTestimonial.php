<?php
require_once dirname(__FILE__) . "/../database.php"; //require the db 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  var_dump($_POST);
  $testID = $_POST['testimonialID'];
  $sqlString = "DELETE FROM `testimonial` WHERE `id` =?;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
  $statement->bind_param('s', $testID); //prevents sql injections
  $statement->execute(); //we delete the message from the database
  header("Location:../pages/reviewTestimonials.php?delete=success");
}

?>