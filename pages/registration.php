<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../scripts/deleteFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 


$heroLink = "<a class='btn btn-primary my-1' href='/Childcare/pages/signup.php' role='button'>Create an account to register</a>";


if (isset($_SESSION['email'])) {
  $heroLink = "<a class='btn btn-primary my-1' href='#registration-form' role='button'>Register</a>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}

?>
<div class="px-5 py-5 " id=registration-hero>
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="/ChildCare/images/daycare8.jpeg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="500"
        height="auto" loading="lazy">
    </div>
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold lh-1 mb-3">Register your child today!</h1>
      <p class="lead">We're excited to welcome your child to our daycare program! Our experienced and caring staff are
        committed to providing a safe, nurturing, and fun environment for your child to learn and grow. Registration is
        quick and easy - just fill out the form on this page and we'll be in touch shortly. Enroll your child today and
        give them the gift of a great start!</p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <?php echo $heroLink; ?>
      </div>
    </div>
  </div>
</div>

<?php
require_once dirname(__FILE__) . "/../scripts/fetchFees.php"; //displas the fee information
?>


<div class="card w-60 p-5 mx-auto mt-3 mb-5" id="registration-form">
  <form class=" container" action="/ChildCare/pages/signup.php" method="POST" novalidate>
    <h1 class="mb-3">Enter your child's details</h1>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="fname" name="fname" placeholder="John" <?php
          if (isset($fname))
            echo "value='$fname'";
          ?> length="40">
          <label for="fname">First Name</label>
        </div>
        <?php
        if (isset($GLOBALS["errors"]["fname"])) {
          $message = $GLOBALS['errors']['fname'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="lname" name="lname" placeholder="Doe" <?php
          if (isset($lname))
            echo "value='$lname'";
          ?> length="40">
          <label for="lname">Last Name</label>
        </div>
        <?php
        if (isset($GLOBALS["errors"]["lname"])) {
          $message = $GLOBALS['errors']['lname'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <select class="col-md form-select form-select-lg registration-select" aria-label="Default select example">
        <option value="0" selected disabled>Age group</option>

        <option value="baby">Baby (6-12 months)</option>
        <option value="wobbler">Wobbler (1-2 years)</option>
        <option value="toddler">Toddler (2-3 years)</option>
        <option value="pre-schooler">Pre-Schooler (3-4 years)</option>
      </select>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="fees" name="fees" placeholder="fees" readonly>
          <label for="password">Fees</label>
        </div>
      </div>
      <select class="col-md form-select form-select-lg registration-select" id="childcare-plan"
        aria-label="Default select example">
        <option value="0" selected disabled>Childcare Plan</option>
        <option value="1">One Half Day</option>
        <option value="2">One Full Day</option>
        <option value="3">Three Half Days</option>
        <option value="4">Three Full Days</option>
        <option value="5">Five Half Days</option>
        <option value="6">Five Full Days</option>
      </select>
    </div>
    <div class="row g-2">
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Add Child</button>
      </div>
    </div>
  </form>
</div>





<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>