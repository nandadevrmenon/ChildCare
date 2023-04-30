<?php
//EVERY input is run through some kind of cleaning and then some kind of validation using the functions in this file
function cleanInput($input)
{ //trims removes tags and makes first letter uppercase
  ucwords(trim(htmlentities(htmlspecialchars(strip_tags($input))))); //removes html entities trims ad strips tags from input
  $input = preg_replace('/\s+/', '', $input); //removes whitespace
  $input = preg_replace('/-/', '', $input); //removes hyphens
  return $input;
}

function cleanName($name)
{
  return ucwords(trim(htmlentities(strip_tags($name)))); //do eveything that clean input does and also make first letters uppercase
}

function cleanText($text)
{
  return trim(htmlentities(strip_tags($text)));
}

function cleanEmail($email)
{
  return strtolower(cleanInput($email));
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
  trim($name);
  echo $name;
  if (empty($name)) { //if empty show an error
    $GLOBALS["errors"]["lname"] = "Field cannot be empty.";
  } else if (count(explode(" ", $name)) > 3) { //if there are more than 2 words in the last name show an error(people with long names are out of luck.)
    $GLOBALS["errors"]["lname"] = "Cannot contain more than 2 space char.";
  } else if (strlen($name) > 40) { //if name is too long
    $GLOBALS['errors']["lname"] = "Name length should be less than 50.";
  } else if (!preg_match("/^[a-zA-Z]+( ?[a-zA-Z]+)*$/", $name)) { //if it does matcht he regex show an error
    $GLOBALS['errors']["lname"] = "Illegal Characacter Found. Only english alphabets and spaces allowed.";
  }
}

function validateFullName($name)
{
  if (empty($name)) { //if empty show an error
    $GLOBALS["errors"]["name"] = "Field cannot be empty.";
  } else if (count(explode(" ", $name)) > 3) { //if there are more than 3 words in the  name show an error(people with long names are out of luck.)
    $GLOBALS["errors"]["name"] = "Cannot contain more than 2 space characters.";
  } else if (strlen($name) > 80) { //if name is too long
    $GLOBALS['errors']["name"] = "Name length should be less than 80.";
  } else if (!preg_match('/^[a-zA-Z]+( ?[a-zA-Z]*)*$/', $name)) { //if it does match the regex show an error
    $GLOBALS['errors']["name"] = "Illegal Character Found.";
  }
}

function validatePhone($phone)
{
  if (empty($phone)) {
    $GLOBALS["errors"]["phone"] = "Field cannot be empty.";
  } else if (!is_numeric($phone)) {
    $GLOBALS["errors"]["phone"] = "Only numbers allowed";
  } else if (strlen($phone) > 10) { //if too long
    $GLOBALS['errors']["phone"] = "Phone number length should be less then 10 ";
  } else if (!preg_match("/^(01[0-9]{7})|(0[1-9][0-9]{8})$/", $phone)) { //if doesnt match irish phone number regex
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

function validateSubject($subject)
{
  if (empty($subject)) {
    $GLOBALS["errors"]["subject"] = "Feild Cannot be empty";
  } else if (strlen($subject) > 200) {
    $GLOBALS["errors"]["subject"] = "Must be shorter than 200 characters.";
  } else if (!preg_match("/^[A-Za-z.,' ;:!@€$%&*()+=}{<>-s]*$/", $subject)) {
    $GLOBALS["errors"]["subject"] = "Illegal Character Found.Please write in plain english.";
  }
}
function validateBigText($text)
{
  $regex = <<<ID
  /\A[A-Za-z0-9.,\s;:#!@€\$%&\(*)=\+}{<>-s]*\z$/m
  ID;
  if (empty($text)) {
    $GLOBALS["errors"]["details"] = "Feild Cannot be empty";
  } else if (strlen($text) > 700) {
    $GLOBALS["errors"]["details"] = "Must be shorter than 700 characters.";
  } else if (!preg_match($regex, $text)) {
    $GLOBALS["errors"]["details"] = "Illegal Character Found.Please write in plain english.";
  }
}


function validateAge($age)
{
  $ageLookup = array("Baby", "Wobbler", "Toddler", "PreSchooler");
  if (empty($age)) {
    $GLOBALS["errors"]["age"] = "Please select an age category.";
  } else if (!in_array($age, $ageLookup)) {
    $GLOBALS["errors"]["age"] = "Illegal value for plan.Don't mess with html.";
  }
}

function validatePlan($plan)
{
  if (empty($plan)) {
    $GLOBALS["errors"]["plan"] = "Please select an plan.";
  } else if ($plan > 6 || $plan < 1) {
    $GLOBALS["errors"]["plan"] = "Illegal value for plan.Don't mess with html.";
  }
}

?>