<?php
require_once(dirname(__FILE__) . "/../components/header.php");

if (isset($_SESSION['email'])) { //if logged in 
  $link1 = "<a class='btn btn-primary my-1' href='/ChildCare/pages/registration.php' role='button'>Register Your Child</a>";
  $link3 = "<a class='btn btn-primary my-1' href='/ChildCare/pages/dailyLog.php' role='button'>View Daily Logs</a>";
} else {
  $link1 = "<a class='btn btn-primary my-1' href='/ChildCare/pages/login.php' role='button'>Log In to Register Your Child</a>";
  $link3 = "<a class='btn btn-primary my-1' href='/ChildCare/pages/login.php' role='button'>Log In to View Daily Logs </a>";
}

$link2 = "<a class='btn btn-primary my-1' href='/ChildCare/pages/registration.php' role='button'>Contact Us</a>";
?>
<div class="accordion mx-autp mt-3 mb-5">
  <div class="accordion-item" id="daycare">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordian1"
        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        <h4 class="my-0">Full and Half Day Childcare Programs:<h4>
      </button>
    </h2>
    <div id="accordian1" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body lh-lg w-75 mx-auto">
        Our full-day and half-day childcare programs provide a safe and nurturing environment for your child to learn,
        grow, and explore. Our trained and experienced staff will provide your child with educational and developmental
        opportunities that encourage social, emotional, and cognitive growth. We offer a flexible schedule to meet the
        needs of busy families.Register Now to avail offers.
        <p>
          <?php echo $link1; ?>
        </p>
      </div>
    </div>
  </div>
  <div class="accordion-item" id="summer">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordian2"
        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        <h4 class="my-0">Summer Camp for School-Aged Children<h4>
      </button>
    </h2>
    <div id="accordian2" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body lh-lg w-75 mx-auto">
        Our summer camp programs offer an exciting and enriching experience for school-aged children. Our engaging and
        educational activities are designed to promote creativity, teamwork, and self-confidence. Your child will have
        the opportunity to participate in sports, arts and crafts, science experiments, and much more. Our experienced
        staff will ensure your child has a safe and fun summer! Contact our team to recieve a brochure.
        <p>
          <?php echo $link2; ?>
        </p>
      </div>
    </div>
  </div>
  <div class="accordion-item" id="snacks">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordian3"
        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        <h4 class="my-0">
          Nutritious meals and snacks provided daily<h4>
      </button>
    </h2>
    <div id="accordian3" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body lh-lg w-75 mx-auto">
        We believe that good nutrition is essential for children's physical and mental development. Our experienced
        cooks prepare balanced and nutritious meals and snacks daily using fresh, high-quality ingredients. We
        accommodate dietary restrictions and allergies and strive to expose children to a variety of healthy foods.And
        with our daily logs, you can stay up-to-date on what your child does and eats throughout the day.
        <p>
          <?php echo $link3; ?>
        </p>
      </div>
    </div>
  </div>
  <div class="accordion-item" id="play">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordian4"
        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        <h4 class="my-0">Indoor and Outdoor play Areas and Activities: <h4>
      </button>
    </h2>
    <div id="accordian4" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
      <div class="accordion-body lh-lg w-75 mx-auto">
        Our full-day and half-day childcare programs provide a safe and nurturing environment for your child to learn,
        grow, and explore. Our trained and experienced staff will provide your child with educational and developmental
        opportunities that encourage social, emotional, and cognitive growth. We offer a flexible schedule to meet the
        needs of busy families.Register Now to avail offers.
        <p>
          <?php echo $link2; ?>
        </p>
      </div>
    </div>
  </div>


</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>