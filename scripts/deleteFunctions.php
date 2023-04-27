<?php

function deleteMessage($id)
{
  $sqlString = "DELETE FROM `enquiry` WHERE `id` =?;";
  $statement = $GLOBALS['db']->prepare($sqlString); //prepare the statement
  $statement->bind_param('s', $id); //prevents sql injections
  $statement->execute(); //we delete the message from the database
}

?>