<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
$title = 'date_details_edit';

  require_once("components/header.php");
?>
<div class = "grid" style = "display: grid; place-items: center;background-color: whitesmoke;padding: 10rem; height: 100%; position: relative;">
    <h1 class= "text-center">Daily Log Information </h1>
    
<form  action = "success.php"method= "GET" novalidate>
    <div class="mb-3">
        <label for="child_id" class="form-label">Child_id</label>
        <input type="number" class="form-control" id="child_id" name="child_id" aria-describedby="child_id">  
    </div>
    <div class="mb-3">
        <label for="child_name" class="form-label" > Name</label>
        <input type="text" class="form-control" id="child_name"  name="child_name">  
    </div>
    <div class="mb-3">
        <label for="temperature" class="form-label">Temperature</label>
        <input type="temperature" class="form-control" id="temp" name="temp" aria-describedby="temp">  
        <div id="temp" class="form-text"> in Celsius</div>
    </div>
    <div class="mb-3">
        <label for="breakfast" class="form-label">Breakfast</label>
        <input type="text" class="form-control" id="breakfast"  name ="breakfast" aria-describedby="breakfast">  
    </div>
    <div class="mb-3">
        <label for="lunch" class="form-label">Lunch</label>
        <input type="lunch" class="form-control" id="lunch" name ="lunch" aria-describedby="lunch">  
    </div>
    <div class="mb-3">
        <label for="activity" class="form-label">Activities</label>
        <input type="text" class="form-control" id="activity" name ="activity" aria-describedby="activity">  
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name ="date" aria-describedby="date">  
    </div>

    <button type="submit" name = "submit"class="btn btn-primary">Submit</button>
</form> 
</div>





 <?php 
  require_once("components/footer.php");
?>

</body>
</html>