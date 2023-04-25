<?php
function cleanInput($input)
{ //trims removes tags and makes first letter uppercase
  ucwords(trim(htmlentities(strip_tags($input)))); //removes html entities trims ad strips tags from input
  $input = preg_replace('/\s+/', '', $input); //removes whitespace
  $input = preg_replace('/-/', '', $input); //removes hyphens
  return $input;
}

function cleanName($name)
{
  return ucwords(trim(htmlentities(strip_tags($name)))); //do eveything that clean input does and also make first letters uppercase
}

function validateFirstName($name)
{
  if (empty($name)) { //if name field is empty show an error
    $GLOBALS["errors"]["fname"] = "Field cannot be empty.";
  } else if (strlen($name) > 40) { //if name is too long show an error
    $GLOBALS['errors']["fname"] = "Name length should be less than 50.";
  } else if (!preg_match('/^[a-zA-z]*$/', $name)) { //if name doesnt match regex (This regex is a bit limiting bit if you have a normal name 2 word or 3 word name it should work)
    $GLOBALS['errors']["fname"] = "Illegal Character Found.";
  }
}

function validateLastName($name)
{
  if (empty($name)) { //if empty show an error
    $GLOBALS["errors"]["lname"] = "Field cannot be empty.";
  } else if (count(explode(" ", $name)) > 2) { //if there are more than 2 words in the last name show an error(people with long names are out of luck.)
    $GLOBALS["errors"]["lname"] = "Cannot contain more than 1 space char.";
  } else if (strlen($name) > 40) { //if name is too long
    $GLOBALS['errors']["lname"] = "Name length should be less than 50.";
  } else if (!preg_match('/^[a-zA-Z]+ ?[a-zA-Z]*$/', $name)) { //if it does matcht he regex show an error
    $GLOBALS['errors']["lname"] = "Illegal Character Found.";
  }
}

function validatePhone($phone)
{
  if (empty($phone)) {
    $GLOBALS["errors"]["phone"] = "Field cannot be empty.";
  } else if (strlen($phone) > 10) {
    $GLOBALS['errors']["phone"] = "Phone number length should be less then 10 ";
  } else if (!preg_match("/^(01[0-9]{7})|(0[1-9][0-9]{8})$/", $phone)) {
    $GLOBALS['errors']["phone"] = "Not an Irish number";
  }
}


function validateEmail($email)
{
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    $GLOBALS['errors']["email"] = "Not a valid email.";
  }
}
function validatepasswords($pw, $confirmPw)
{
  if (empty($pw) || empty(($confirmPw))) {
    $GLOBALS["errors"]["password"] = "Password cannot be empty.";
  } else if ($pw != $confirmPw) {
    $GLOBALS['errors']["password"] = "Passwords do not match";
  }
}

?>