<?php
function cleanInput($input){    //trims removes tags and makes first letter uppercase
  return ucwords(trim(htmlentities(strip_tags($input))));
}
?>