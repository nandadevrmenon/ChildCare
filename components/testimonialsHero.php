<?php
$heroLink = ""; //does not print out anything if user isnt logged in 


if (isset($_SESSION['email'])) {
  $heroLink = "<a class='btn btn-primary my-1' href='#add-testimonial-form' role='button'>Add testimonial</a>";
}


$hero = <<<ID
<div class="px-5 py-5 " id=registration-hero>
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="/ChildCare/images/daycare12.jpg" class="d-block mx-lg-auto img-fluid" alt="Children playing" width="500"
        height="auto" loading="lazy">
    </div>
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold lh-1 mb-3">Hear what our happy parents have to say</h1>
      <p class="lead"> We're proud to have helped so many families over the years. But don't just take our word for it - hear what some of our happy parents have to say! We're thrilled that our efforts have made a positive impact on so many families. Take a moment to read some of our testimonials below, and see what parents are saying about our daycare center. Thank you for considering us as your child's home away from home.</p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        $heroLink
      </div>
    </div>
  </div>
</div>
ID;

echo $hero;
?>