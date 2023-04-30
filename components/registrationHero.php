<?php



$heroLink = "<a class='btn btn-primary my-1' href='/Childcare/pages/signup.php' role='button'>Create an account to register</a>"; //will change what the buton does,based on the logged in status 


if (isset($_SESSION['email'])) {
  $heroLink = "<a class='btn btn-primary my-1' href='#registration-form' role='button'>Register</a>";
}


$hero = <<<ID
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
        $heroLink
      </div>
    </div>
  </div>
</div>
ID;

echo $hero;

?>