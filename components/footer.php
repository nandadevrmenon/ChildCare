</div>

<footer class="site-footer">
  <div class="blue-bottom-border w-100">
    <div class="d-flex px-5 py-3 w-75 mx-auto">
      <div class="ms-5 me-auto d-none d-lg-block">
        <span>Connect with us on these social networks:</span>
      </div>
      <div class="me-5 d-flex w-50 align-items-center justify-content-end">
        <a><img src="/ChildCare/images/icons/instagram.svg" alt="Instagram Logo" class="me-4"></a>
        <a><img src="/ChildCare/images/icons/facebook.svg" alt="Facebook Logo"></a>
        <a><img src="/ChildCare/images/icons/github.svg" alt="Github Logo" class="ms-4"></a>
      </div>
    </div>
  </div>
  <div>
    <div class="container text-center text-md-start mt-4">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4 footer-brand">
            Tiny Treasures
          </h6>
          <p>
            At Tiny Treasures, we're committed to providing a nurturing and fun environment for your child to grow,
            learn, and explore the world around them. Contact us today to learn more.
          </p>
        </div>


        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

          <h6 class="text-uppercase fw-bold mb-4">
            Services
          </h6>
          <p>
            <a href="#!" class="text-reset">Baby</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Wobbler</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Toddler</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Pre-School</a>
          </p>
        </div>
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Testimonials</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Contact Us</a>
          </p>
          <?php
          if (isset($_SESSION['email'])) {
            echo "<p>
              <a href='/ChildCare/pages/dailyLog.php' class='text-reset'>Daily Log</a>
            </p>";
            echo "<p>
              <a href='/ChildCare/pages/profile.php' class='text-reset'>Profile</a>
            </p>";
          } else {
            echo "<p>
            <a href='/ChildCare/pages/login.php' class='text-reset'>Log In</a>
            </p>";
            echo "<p>
            <a href='/ChildCare/pages/services.php' class='text-reset'>Services</a>
            </p>";
          }
          ?>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p>
            <img class="me-3" src="/ChildCare/images/icons/house-fill.svg" alt="Address icon">
            Belgard, Dublin, D24XC2G
          </p>
          <p>
            <img class="me-3" src="/ChildCare/images/icons/envelope-fill.svg" alt="email icon">
            tiny.toddlers.dublin@gmail.com
          </p>
          <p> <img class="me-3" src="/ChildCare/images/icons/telephone-fill.svg" alt="phone icon"> + 01 234 567 88</p>
        </div>
      </div>
    </div>
  </div>
  <div class="blue-bottom-border w-100">
    <div class="d-flex px-5 py-1 w-75 mx-auto">
      <div class="ms-auto me-auto d-none d-lg-block blue-top-border">
        <span> &copy;
          <?php echo date("Y"); ?> Visit Dublin
        </span>
      </div>
    </div>
  </div>
</footer>
<script src="/ChildCare/index.js"></script>
</body>

</html>