<style>

</style>
<?php
  $title = 'success';

  require_once("components/header.php");
?>


<h1 class= "text-center text-success place-items: center mt-3"> You Have Been Registered</h1>

<div class="card1" style="width: 50rem; border:1px #ccc solid;">
                  <div class="card-body">

                    <h3 class="card-title">ID : <?php echo $_GET['child_id'];?></h3> 
                    <div class = "date" style="text-align: left; display:flex;">Date : <?php echo $_GET['date'];?></div>
                    <div class = card_det style = " display: flex; justify-content:space-evenly; gap: 10em; font-weight:500; font-size:20px; padding:1rem;">
                      <div>Temperature: <?php echo $_GET['temp'];?></div>
                      <div>Breakfast: <?php echo $_GET['breakfast'];?></div>
                      <div>Lunch: <?php echo $_GET['lunch'];?></div>
                    </div>
                    <p class="card-text"><?php echo $_GET['activity'];?>.</p>
                    <a href="#" class="btn btn-primary">veiw childs report</a>
                  </div>
              </div> 
<?php

  echo $_GET['child_name'];
  echo $_GET['temp']; 
  echo $_GET['breakfast'];
  echo $_GET['lunch'];
  echo $_GET['date'];
  echo $_GET['activity'];

?>

<?php
  require_once("components/footer.php");
?>