<?php

function getChildrenLogs($index, $date)
{
  $childrenLogHTML = "";

  if ($index == 0) { //no specific child 
    if (!empty($date)) { //and specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id WHERE C.`user-id` = ? && D.date = ? ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
      $statement->bind_param('ss', $_SESSION['userID'], $date); //we bind the variables into the statemaent
    } else { ///no specific child but no specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id WHERE C.`user-id` = ? ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
      $statement->bind_param('s', $_SESSION['userID']); //we bind the variables into the statemaent
    }

  } else { //specific child 
    if (!empty($date)) { //and specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id WHERE C.`user-id` = ? AND D.`child-id` = ? AND D.date= ? ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
      $statement->bind_param('iis', $_SESSION['userID'], $index, $date); //we bind the variables into the statemaent
    } else { /// specific child but no specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id WHERE C.`user-id` = ? AND D.`child-id` = ? ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
      $statement->bind_param('ii', $_SESSION['userID'], $index); //we bind the variables into the statemaent
    }

  }

  $statement->execute();
  $result = $statement->get_result();
  if ($result->num_rows != 0) { //if result exists
    while ($row = $result->fetch_assoc()) {
      $fname = $row['fname'];
      $lname = $row['lname']; //we get all the values from records
      $temp = $row['temp'];
      $breakfast = $row['breakfast'];
      $lunch = $row['lunch'];
      $date = $row['date'];
      $activity = $row['activity'];
      $date = date("d-m-Y", strtotime($date)); //format the date

      $childrenLogHTML = $childrenLogHTML . "<div class='card mb-4'>
        <div class='card-header d-flex justify-content-between'>
          <h4 class='my-0 me-3'>$fname $lname</h4>
          <h6 class='my-0 ms-3'>$date</h6 >
        </div>
        <div class='card-header d-flex justify-content-between'>
        <span>Temperature : $temp &#8451;</span>
        <span>Breakfast : $breakfast</span>
        <span>Lunch : $lunch</span>
      </div>
        <div class='card-body'>
        <h5 class='card-title'>Activity</h5>
          <p class='card-text'>$activity</p>
        </div>
      </div>";
      //add it as pretty html cards to the cards variable


    }
    $result->free();
    return $childrenLogHTML;
  } else {
    return "<p>No logs to show.</p>";
  }

}


function getAllChildrenLogs($index, $date)
{
  $childrenLogHTML = "";

  if ($index == 0) { //no specific child 
    if (!empty($date)) { //and specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id WHERE D.date = ? ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
      $statement->bind_param('s', $date); //we bind the variables into the statemaent
    } else { ///no specific child but no specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
    }

  } else { //specific child 
    if (!empty($date)) { //and specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id WHERE D.`child-id` = ? AND D.date= ? ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
      $statement->bind_param('is', $index, $date); //we bind the variables into the statemaent
    } else { /// specific child but no specific date
      $sqlString = "SELECT D.*,C.fname,C.lname,C.`user-id` FROM `dailylog` D INNER JOIN CHILD C ON D.`child-id`=C.id WHERE  D.`child-id` = ? ORDER BY D.date DESC, D.id DESC;";
      $statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
      $statement->bind_param('i', $index); //we bind the variables into the statemaent
    }

  }

  $statement->execute();
  $result = $statement->get_result();
  if ($result->num_rows != 0) { //if result exists
    while ($row = $result->fetch_assoc()) {
      $fname = $row['fname'];
      $lname = $row['lname']; //we get all the values from records
      $temp = $row['temp'];
      $breakfast = $row['breakfast'];
      $lunch = $row['lunch'];
      $date = $row['date'];
      $activity = $row['activity'];
      $date = date("d-m-Y", strtotime($date)); //format the date

      $childrenLogHTML = $childrenLogHTML . "<div class='card mb-4'>
        <div class='card-header d-flex justify-content-between'>
          <h4 class='my-0 me-3'>$fname $lname</h4>
          <h6 class='my-0 ms-3'>$date</h6 >
        </div>
        <div class='card-header d-flex justify-content-between'>
        <span>Temperature : $temp &#8451;</span>
        <span>Breakfast : $breakfast</span>
        <span>Lunch : $lunch</span>
      </div>
        <div class='card-body'>
        <h5 class='card-title'>Activity</h5>
          <p class='card-text'>$activity</p>
        </div>
      </div>";
      //add it as pretty html cards to the cards variable


    }
    $result->free();
    return $childrenLogHTML;
  } else {
    return "<p>No logs to show.</p>";
  }

}



?>