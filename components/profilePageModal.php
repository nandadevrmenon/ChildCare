<?php


$modal = <<<ID
<div class='modal fade' id='profilePageModal' tabindex='-1' aria-labelledby='profilePageModal' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Confirmation</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        Are you sure you want to unregister 
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Cancel</button>
        <form method='POST' action='profile.php'>
          <button class='btn btn-danger' name='childID' type='submit' value=''>Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
ID;

?>