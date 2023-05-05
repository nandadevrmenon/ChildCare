<?php
require_once dirname(__FILE__) . "/../components/header.php";
require_once dirname(__FILE__) . "/../scripts/validationFunctions.php";
require_once dirname(__FILE__) . "/../scripts/fetchFunctions.php";
require_once dirname(__FILE__) . "/../database.php"; //require the db 

if (!isset($_SESSION['privilege'])) {
  echo "<div class='alert alert-danger w-75' role='alert'>
   You are not authorised to access this page. HOW DARE YOU?
  </div>";
  return;
}

$GLOBALS['errors'] = array();


if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['section'])) {
    echo "<div class='alert alert-success w-75' role='alert'>
    Section updated successfully!
   </div>";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $header1 = cleanText($_POST['header1']);
  $body1 = cleanText($_POST['body1']);
  $link1 = cleanNumber($_POST['link1']);
  $img1 = cleanNumber($_POST['img1']);

  $header2 = cleanText($_POST['header2']);
  $body2 = cleanText($_POST['body2']);
  $link2 = cleanNumber($_POST['link2']);
  $img2 = cleanNumber($_POST['img2']);

  $header3 = cleanText($_POST['header3']);
  $body3 = cleanText($_POST['body3']);
  $link3 = cleanNumber($_POST['link3']);
  $img3 = cleanNumber($_POST['img3']);


  validateHeader($header1, "header1");
  validateHeader($header2, "header2");
  validateHeader($header3, "header3");

  validateBody($body1, "body1");
  validateBody($body2, "body2");
  validateBody($body3, "body3");

  validateLinkID($link1, "link1");
  validateLinkID($link2, "link2");
  validateLinkID($link3, "link3");

  validateImageID($img3, "img1");
  validateImageID($img2, "img2");
  validateImageID($img3, "img3");


  if (count($GLOBALS['errors']) == 0) {
    $updated = updateHomeSection(1, $header1, $body1, $link1, $img1);
    $updated = updateHomeSection(2, $header2, $body2, $link2, $img2) || $updated;
    $updated = updateHomeSection(3, $header3, $body3, $link3, $img3) || $updated;

    if ($updated) {
      header("Location:editHome.php?section=updated");
    }
  }





}


$allSections = fetchHomeSections();

$header1 = $allSections[0]['header'];
$body1 = $allSections[0]['body'];
$link1 = $allSections[0]['link-id'];
$img1 = $allSections[0]['img-id'];

$header2 = $allSections[1]['header'];
$body2 = $allSections[1]['body'];
$link2 = $allSections[1]['link-id'];
$img2 = $allSections[1]['img-id'];

$header3 = $allSections[2]['header'];
$body3 = $allSections[2]['body'];
$link3 = $allSections[2]['link-id'];
$img3 = $allSections[2]['img-id'];
?>

<div class="card w-55 p-5 mb-5 mt-3">
  <form action="/ChildCare/pages/editHome.php" method="POST" novalidate id="editHome">
    <h2>Feature Section 1</h2>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="header1" class="form-label">Header</label>
        <input class="form-control form-control-sm" type="text" name="header1" id="header1" <?php
        if (isset($header1))
          echo "value='$header1'";
        ?>>
        <?php
        if (isset($GLOBALS["errors"]["header1"])) {
          $message = $GLOBALS['errors']['header1'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="body1" class="form-label">Body</label>
        <textarea class="form-control form-control-sm" type="text" name="body1" id="body1" form="editHome"><?php
        if (isset($body1))
          echo $body1;
        ?></textarea>
        <?php
        if (isset($GLOBALS["errors"]["body1"])) {
          $message = $GLOBALS['errors']['body1'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <select name="link1" id="link1" class="col-md form-select form-select-lg registration-select"
        aria-label="Default select example">
        <option value="" selected disabled>Link to </option>
        <option value="1" <?php if ($link1 == "1")
          echo 'selected="selected"'; ?>>Services Page</option>
        <option value="2" <?php if ($link1 == "2")
          echo 'selected="selected"'; ?>>Registration Page</option>
        <option value="3" <?php if ($link1 == "3")
          echo 'selected="selected"'; ?>>Contact Us Page</option>
        <option value="4" <?php if ($link1 == "4")
          echo 'selected="selected"'; ?>>Testimonials Page
        </option>
        <option value="5" <?php if ($link1 == "5")
          echo 'selected="selected"'; ?>>No Link
        </option>
      </select>
      <?php
      if (isset($GLOBALS["errors"]["link1"])) {
        $message = $GLOBALS['errors']['link1'];
        echo "<span class='text-danger'>$message</span>";
      }
      ?>
    </div>
    <div class="row g-2 mb-3">
      <select name="img1" id="img" class="col-md form-select form-select-lg registration-select"
        aria-label="Default select example">
        <option value="" selected disabled>Choose an Image</option>
        <option value="1" <?php if ($img1 == "1")
          echo 'selected="selected"'; ?>>Playground</option>
        <option value="2" <?php if ($img1 == "2")
          echo 'selected="selected"'; ?>>Woman Teaching Kids</option>
        <option value="3" <?php if ($img1 == "3")
          echo 'selected="selected"'; ?>>2 Babies playing</option>
        <option value="4" <?php if ($img1 == "4")
          echo 'selected="selected"'; ?>>Woman Teaching Kids
        </option>
        <option value="5" <?php if ($img1 == "5")
          echo 'selected="selected"'; ?>>Indoor Play Area</option>
        <option value="6" <?php if ($img1 == "6")
          echo 'selected="selected"'; ?>>Kids Painting</option>
        <option value="7" <?php if ($img1 == "7")
          echo 'selected="selected"'; ?>>Man Teaching Kids</option>
        <option value="8" <?php if ($img1 == "8")
          echo 'selected="selected"'; ?>>Girl Writing
        </option>
        <option value="9" <?php if ($img1 == "9")
          echo 'selected="selected"'; ?>>2 Kids Playing Outdoors
        </option>
      </select>
      <?php
      if (isset($GLOBALS["errors"]["img1"])) {
        $message = $GLOBALS['errors']['img1'];
        echo "<span class='text-danger'>$message</span>";
      }
      ?>
    </div>
    <h2>Feature Section 2</h2>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="header2" class="form-label">Header</label>
        <input class="form-control form-control-sm" type="text" name="header2" id="header2" <?php
        if (isset($header2))
          echo "value='$header2'";
        ?>>
        <?php
        if (isset($GLOBALS["errors"]["header2"])) {
          $message = $GLOBALS['errors']['header2'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="body2" class="form-label">Body</label>
        <textarea class="form-control form-control-sm" type="text" name="body2" id="body2" form="editHome"><?php
        if (isset($body2))
          echo $body2;
        ?></textarea>
        <?php
        if (isset($GLOBALS["errors"]["body2"])) {
          $message = $GLOBALS['errors']['body2'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <select name="link2" id="link2" class="col-md form-select form-select-lg registration-select"
        aria-label="Default select example">
        <option value="" selected disabled>Link to </option>
        <option value="1" <?php if ($link2 == "1")
          echo 'selected="selected"'; ?>>Services Page</option>
        <option value="2" <?php if ($link2 == "2")
          echo 'selected="selected"'; ?>>Registration Page</option>
        <option value="3" <?php if ($link2 == "3")
          echo 'selected="selected"'; ?>>Contact Us Page</option>
        <option value="4" <?php if ($link2 == "4")
          echo 'selected="selected"'; ?>>Testimonials Page
        </option>
        <option value="5" <?php if ($link2 == "5")
          echo 'selected="selected"'; ?>>No Link
        </option>
      </select>
      <?php
      if (isset($GLOBALS["errors"]["link2"])) {
        $message = $GLOBALS['errors']['link2'];
        echo "<span class='text-danger'>$message</span>";
      }
      ?>
    </div>
    <div class="row g-2 mb-3">
      <select name="img2" id="img2" class="col-md form-select form-select-lg registration-select"
        aria-label="Default select example">
        <option value="" selected disabled>Choose an Image</option>
        <option value="1" <?php if ($img2 == "1")
          echo 'selected="selected"'; ?>>Playground</option>
        <option value="2" <?php if ($img2 == "2")
          echo 'selected="selected"'; ?>>Woman Teaching Kids</option>
        <option value="3" <?php if ($img2 == "3")
          echo 'selected="selected"'; ?>>2 Babies playing</option>
        <option value="4" <?php if ($img2 == "4")
          echo 'selected="selected"'; ?>>Woman Teaching Kids
        </option>
        <option value="5" <?php if ($img2 == "5")
          echo 'selected="selected"'; ?>>Indoor Play Area</option>
        <option value="6" <?php if ($img2 == "6")
          echo 'selected="selected"'; ?>>Kids Painting</option>
        <option value="7" <?php if ($img2 == "7")
          echo 'selected="selected"'; ?>>Man Teaching Kids</option>
        <option value="8" <?php if ($img2 == "8")
          echo 'selected="selected"'; ?>>Girl Writing
        </option>
        <option value="9" <?php if ($img2 == "9")
          echo 'selected="selected"'; ?>>2 Kids Playing Outdoors
        </option>
      </select>
      <?php
      if (isset($GLOBALS["errors"]["img2"])) {
        $message = $GLOBALS['errors']['img2'];
        echo "<span class='text-danger'>$message</span>";
      }
      ?>
    </div>
    <h2>Feature Section 3</h2>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="header3" class="form-label">Header</label>
        <input class="form-control form-control-sm" type="text" name="header3" id="header3" <?php
        if (isset($header3))
          echo "value='$header3'";
        ?>>
        <?php
        if (isset($GLOBALS["errors"]["header3"])) {
          $message = $GLOBALS['errors']['header3'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <label for="body3" class="form-label">Body</label>
        <textarea class="form-control form-control-sm" type="text" name="body3" id="body3" form="editHome"><?php
        if (isset($body3))
          echo $body3;
        ?></textarea>
        <?php
        if (isset($GLOBALS["errors"]["body3"])) {
          $message = $GLOBALS['errors']['body3'];
          echo "<span class='text-danger'>$message</span>";
        }
        ?>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <select name="link3" id="link3" class="col-md form-select form-select-lg registration-select"
        aria-label="Default select example">
        <option value="" selected disabled>Link to </option>
        <option value="1" <?php if ($link3 == "1")
          echo 'selected="selected"'; ?>>Services Page</option>
        <option value="2" <?php if ($link3 == "2")
          echo 'selected="selected"'; ?>>Registration Page</option>
        <option value="3" <?php if ($link3 == "3")
          echo 'selected="selected"'; ?>>Contact Us Page</option>
        <option value="4" <?php if ($link3 == "4")
          echo 'selected="selected"'; ?>>Testimonials Page
        </option>
        <option value="5" <?php if ($link3 == "5")
          echo 'selected="selected"'; ?>>No Link
        </option>
      </select>
      <?php
      if (isset($GLOBALS["errors"]["link3"])) {
        $message = $GLOBALS['errors']['link3'];
        echo "<span class='text-danger'>$message</span>";
      }
      ?>
    </div>
    <div class="row g-2 mb-3">
      <select name="img3" id="img3" class="col-md form-select form-select-lg registration-select"
        aria-label="Default select example">
        <option value="" selected disabled>Choose an Image</option>
        <option value="1" <?php if ($img3 == "1")
          echo 'selected="selected"'; ?>>Playground</option>
        <option value="2" <?php if ($img3 == "2")
          echo 'selected="selected"'; ?>>Woman Teaching Kids</option>
        <option value="3" <?php if ($img3 == "3")
          echo 'selected="selected"'; ?>>2 Babies playing</option>
        <option value="4" <?php if ($img3 == "4")
          echo 'selected="selected"'; ?>>Woman Teaching Kids
        </option>
        <option value="5" <?php if ($img3 == "5")
          echo 'selected="selected"'; ?>>Indoor Play Area</option>
        <option value="6" <?php if ($img3 == "6")
          echo 'selected="selected"'; ?>>Kids Painting</option>
        <option value="7" <?php if ($img3 == "7")
          echo 'selected="selected"'; ?>>Man Teaching Kids</option>
        <option value="8" <?php if ($img3 == "8")
          echo 'selected="selected"'; ?>>Girl Writing
        </option>
        <option value="9" <?php if ($img3 == "9")
          echo 'selected="selected"'; ?>>2 Kids Playing Outdoors
        </option>
      </select>
      <?php
      if (isset($GLOBALS["errors"]["img3"])) {
        $message = $GLOBALS['errors']['img3'];
        echo "<span class='text-danger'>$message</span>";
      }
      ?>
    </div>
    <div class="row g-2">
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3" <?php
        ?>>Submit</button>
      </div>
    </div>
  </form>
</div>



<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>