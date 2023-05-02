<?php


$GLOBALS['messageList'] = "<p>You currently have no messages.</p>"; //fallback


$sqlString = "SELECT * FROM `enquiry` ORDER BY `date`;";
$statement = $GLOBALS['db']->prepare($sqlString); //preapre the above statement
$statement->execute();
$result = $statement->get_result();
if ($result->num_rows != 0) {
  $GLOBALS['messageList'] = "";
  while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $name = $row["name"];
    $date = $row["date"];
    $email = $row["email"];
    $subject = $row["subject"];
    $details = $row["details"];
    $phone = $row["phone"];

    $today = date_create();
    $date = date_create($date);

    // Calculates the difference between DateTime objects
    $interval = date_diff($date, $today);
    $interval = $interval->format("%d");

    if ($interval == 0) {
      $interval = "Today";
    } else if ($interval == 1) {
      $interval = "Yesterday";
    } else {
      $interval = $interval . " days ago";
    }

    $GLOBALS['messageList'] = $GLOBALS['messageList'] . "<div class='customerMessage card mb-4'>
  <div class='card-header d-flex '>
    <h4 class='my-0 me-3'>$name</h4>
    <h4 class='my-0 ms-3'>$phone</h4>
  </div>
  <div class='card-body'>
    <h5 class='card-title'>$subject</h5>
    <p class='card-text'>$details</p>
    <a href='mailto:$email' class='btn btn-primary'>Send Reply</a>
    <button type='button' class='btn btn-danger'  data-id='$id' data-bs-toggle='modal' data-bs-target='#deleteMessageModal'>
      Delete Message
    </button>
  </div>
  <div class='card-footer text-muted text-center'>
    $interval
  </div>
</div>";

  }
}

$result->free();



?>