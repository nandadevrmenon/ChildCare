<?php


$GLOBALS['allTestimonials'] = "<p>No testimonials.</p>"; //fallback


$sqlString = "SELECT `testimonial`.`id`,`testimonial`.`body`,`user`.`fname`,`testimonial`.`status` FROM `testimonial` INNER JOIN `user` on `testimonial`.`user-id` = `user`.`id`;";
$statement = $GLOBALS['db']->prepare($sqlString); //prepare the above statement
$statement->execute();
$result = $statement->get_result();
if ($result->num_rows != 0) {
  $GLOBALS['allTestimonials'] = "";
  while ($row = $result->fetch_assoc()) {
    $body = $row['body'];
    $fname = $row['fname'];
    $id = $row['id'];
    $status = $row['status'];
    $statusHTML = "<h4 class='text-danger my-0 ms-4'> Not Visible </h4>";

    if ($status) {
      $statusHTML = "<h4 class='text-success my-0 ms-4'>Visible </h4>";
    }

    $GLOBALS['allTestimonials'] = $GLOBALS['allTestimonials'] . "<div class='testimonial card mb-4'>
    <div class='card-header d-flex '>
      <h4 class='my-0 me-3'>$fname</h4>
      $statusHTML
    </div>
    <div class='card-body'>
      <p class='card-text'>$body</p>
        <form action='/ChildCare/pages/reviewTestimonials.php' method='POST' novalidate id='changeVisibility'>
          <button type='submit' class='btn btn-primary mb-3' name='id' id='id' value='$id'>
            Change Visibility
          </button>
        </form>
        <button type='button' class='btn btn-danger mb-3' data-id='$id' data-bs-toggle='modal'
          data-bs-target='#deleteTestimonialModal'>
          Delete Testimonial
        </button>
      </div>
  </div>";

  }
}

$result->free();



?>