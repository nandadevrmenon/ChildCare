<?php
require_once dirname(__FILE__) . "/fetchFunctions.php";
$allSections = fetchHomeSections();


$sec1_header = $allSections[0]['header'];
$sec1_body = $allSections[0]['body'];
$sec1_img = $allSections[0]['url'];
$sec1_link = getLink($allSections[0]['link'], $allSections[0]['text']);
$sec1_alt = "";

$sec2_header = $allSections[1]['header'];
$sec2_body = $allSections[1]['body'];
$sec2_img = $allSections[1]['url'];
$sec2_link = getLink($allSections[1]['link'], $allSections[1]['text']);
$sec2_alt = "";

$sec3_header = $allSections[2]['header'];
$sec3_body = $allSections[2]['body'];
$sec3_img = $allSections[2]['url'];
$sec3_link = getLink($allSections[2]['link'], $allSections[2]['text']);
$sec3_alt = "";


$sectionsHTML = "<div class='layer-2'>
<div class='px-5 py-4 feature'>
  <div class='row flex-lg-row-reverse align-items-center g-5 py-5'>
    <div class='col-10 col-sm-8 col-lg-6'>
      <img src='$sec1_img' class='d-block mx-lg-auto img-fluid' alt='$sec1_alt'
        width='500' height='auto' loading='lazy'>
    </div>
    <div class='col-lg-6'>
      <h2 class='fw-bold lh-1 mb-3'>$sec1_header</h2>
      <p class='lead'>$sec1_body</p>
      <div class='d-grid gap-2 d-md-flex justify-content-md-start'>
        $sec1_link
      </div>
    </div>
  </div>
</div>
</div>

<div class='layer-3'>
<div class='px-5 py-4 feature'>
  <div class='row flex-lg-row-reverse align-items-center g-5 py-5'>
    <div class='col-lg-6'>
      <h2 class='fw-bold lh-1 mb-3'>$sec2_header</h2>
      <p class='lead'>$sec2_body</p>
      <div class='d-grid gap-2 d-md-flex justify-content-md-start'>
        $sec2_link
      </div>
    </div>
    <div class='col-10 col-sm-8 col-lg-6'>
      <img src='$sec2_img' class='d-block mx-lg-auto img-fluid' alt='$sec2_alt'
        width='500' height='auto' loading='lazy'>
    </div>
  </div>
</div>
</div>

<div class='layer-4'>
<div class='px-5 py-4 feature'>
  <div class='row flex-lg-row-reverse align-items-center g-5 py-5'>
    <div class='col-10 col-sm-8 col-lg-6'>
      <img src='$sec3_img' class='d-block mx-lg-auto img-fluid' alt='Bootstrap Themes'
        width='500' height='auto' loading='lazy'>
    </div>
    <div class='col-lg-6'>
      <h2 class='fw-bold lh-1 mb-3'>$sec3_header</h2>
      <p class='lead'>$sec3_body</p>
      <div class='d-grid gap-2 d-md-flex justify-content-md-start'>
        $sec3_link
      </div>
    </div>
  </div>
</div>
</div>";


echo $sectionsHTML;


function getLink($href, $text)
{
  if (empty($href))
    return "";
  return "<a class='btn btn-primary my-1' href='$href' role='button'>$text</a>";
}

?>