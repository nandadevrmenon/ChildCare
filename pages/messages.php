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
  deleteMessage($_POST['messageID']);
}



require_once dirname(__FILE__) . "/../scripts/fetchMessages.php";
?>
<div class="main-container">
  <div class="card w-75 p-5 mt-3 mb-5">
    <h1>Messages</h1>
    <?php echo $GLOBALS['messageList']; ?>
  </div>
</div>
<div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteMessageModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete that message?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
        <form method="POST" action="messages.php">
          <button class="btn btn-danger" name='messageID' type="submit" value="">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
require_once(dirname(__FILE__) . "/../components/footer.php");
?>