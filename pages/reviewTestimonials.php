<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

if (!isset($_SESSION['privilege'])) {
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $testID = $_POST['id'];
  changeVisibility($testID);
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['delete'])) {
    echo "<div class='alert alert-success w-75' role='alert'>
  Testimonial deleted successfully.
 </div>";
  }

}
require_once dirname(__FILE__) . "/../scripts/fetchAllTestimonials.php";
?>
<div class="main-container">
  <div class="card w-75 p-5 mt-3 mb-5">
    <h1>All testimonials</h1>
    <?php echo $GLOBALS['allTestimonials']; ?>
  </div>
</div>
<div class="modal fade" id="deleteTestimonialModal" tabindex="-1" aria-labelledby="deleteTestimonialModal"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
        <form method="POST" action="/ChildCare/scripts/deleteTestimonial.php">
          <button class="btn btn-danger" name='testimonialID' type="submit">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>