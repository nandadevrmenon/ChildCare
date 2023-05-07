<?php


$GLOBALS['viewTestimonials'] = "<p>No testimonials made visible by admin yet.</p>"; //fallback


$sqlString = "SELECT  `testimonial`.`id`, `testimonial`.`body`,`user`.`fname`,`testimonial`.`date`,`service`.`name` FROM `testimonial` INNER JOIN `user` on `testimonial`.`user-id` = `user`.`id`  INNER JOIN `service` ON `testimonial`.`service-id` = `service`.`id` WHERE status = true ORDER BY `id`;";
$statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
$statement->execute();
$result = $statement->get_result();
if ($result->num_rows != 0) {
  $GLOBALS['viewTestimonials'] = "";

  while ($row = $result->fetch_assoc()) {
    $body = $row['body'];
    $fname = $row['fname'];
    $date = date("d-m-Y", strtotime($row['date']));
    $service = $row['name'];

    $GLOBALS['viewTestimonials'] = $GLOBALS['viewTestimonials'] . "<div class='customerMessage card mb-4'>
  <div class='card-header d-flex justify-content-between'>
    <h4 class='my-0 me-3 text-center'>$fname</h4>
    <p class='my-0 text-center'> $date </p>
    <p class='my-0 text-center'>Service :  $service </p>
  </div>
  <div class='card-body p-5'  style='text-align: justify; font-size:17px;'>
    <p class='card-text'>$body</p>
  </div>
</div>";

  }
}

$result->free();



?>