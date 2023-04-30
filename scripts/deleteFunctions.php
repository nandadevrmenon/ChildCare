<?php

function deleteMessage($id)
{
  $sqlString = "DELETE FROM `enquiry` WHERE `id` =?;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
  $statement->bind_param('s', $id); //prevents sql injections
  $statement->execute(); //we delete the message from the database
}

function deleteChild($childID)
{
  $sqlString = "DELETE FROM `child` WHERE `id` = ? AND `user-id` = ?;"; //this prevents malicious parents from deleting other parents' children
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
  $statement->bind_param('ss', $childID, $_SESSION['userID']); //prevents sql injections
  $statement->execute(); //we delete the message from the database
}

?>