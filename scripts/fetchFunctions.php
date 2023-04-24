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
  $sqlString = "SELECT `fname`,`lname`,`phone` FROM `user` WHERE `email` = ?";
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
?>