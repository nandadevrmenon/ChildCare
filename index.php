<?php
require_once(dirname(__FILE__) . "/components/header.php");
require_once(dirname(__FILE__) . "/components/carousel.php");
require_once(dirname(__FILE__) . "/database.php");
echo $carousel;
?>




<div class="layer-1">
  <div class="home-options w-100">
    <div class="options-list mx-auto">
      <div class="option-item">
        <img src="/ChildCare/images/icons/bank.svg" alt="Building Icon">
        <h1 class="my-3">Services</h1>
        <p class="text-center">View our services <br> and offerings.</p>
        <a role="button" href="/ChildCare/pages/services.php" class="btn btn-outline-danger">View Services</a>
      </div>
      <div class="option-item">
        <img src="/ChildCare/images/icons/person-add.svg" alt="Add Child Icon">
        <h1 class="my-3">Register</h1>
        <p class="text-center">Create an account <br>and register a child</p>
        <a role="button" href="/ChildCare/pages/registration.php" class="btn btn-outline-danger">Register Now</a>
      </div>
      <div class="option-item">
        <img src="/ChildCare/images/icons/chat-left-dots.svg" alt="Chat Icon">
        <h1 class="my-3">Contact</h1>
        <p class="text-center">Send us a message</p>
        <a role="button" href="/ChildCare/pages/contact.php" class="btn btn-outline-danger">Contact Us</a>
      </div>
    </div>
  </div>
</div>



<?php
require_once(dirname(__FILE__) . "/scripts/fetchHomeSections.php");
require_once(dirname(__FILE__) . "/components/footer.php");
?>