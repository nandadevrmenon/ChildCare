
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>daily_details</title>
    <style>
      .grid{
	display: grid;
	place-items: center;
	background-color: whitesmoke;
	padding: 10rem;
	height: 100%;
	position: relative;
	}
    </style>
</head>

<body>
<?php
  require_once("components/header.php");
?>  
<div class="grid">
        <div class = "grid-1" style = " display: flex; justify-content:space-evenly; gap: 15em; font-size: 20px; padding: 3rem;" >
          
          <div class = grid-1-item-1>daily log</div>
          <div class = grid-1-item-2 >search</div>
          <div class = grid-2-item-3>date</div>
        </div>
        
          <div class = "grid-2" style= "background-color:white;">
              <div class="card1" style="width: 50rem; border:1px #ccc solid;">
                  <div class="card-body">

                    <h3 class="card-title"> Childs 1</h3> 
                    <div class = "date" style="text-align: left; display:flex;">Date</div>
                    <div class = card_det style = " display: flex; justify-content:space-evenly; gap: 10em; font-weight:500; font-size:20px; padding:1rem;">
                      <div>Temperature:</div>
                      <div>Breakfast:</div>
                      <div>Lunch:</div>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">veiw childs report</a>
                  </div>
              </div> 

              <div class="card2" style="width: 50rem; border:1px #ccc solid;">
                  <div class="card-body">
                    <h3 class="card-title"> Childs 2</h3>
                    <div class = card_det style = " display: flex; justify-content:space-evenly; gap: 10em;font-weight:500; font-size:20px;">
                      <div>Temperature:</div>
                      <div>Breakfast:</div>
                      <div>Lunch:</div>
                    </div>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">veiw childs report</a>
                  </div>
              </div> 

              
          </div>





        <div>

        </div>


      </div>



<?php  
  require_once("components/footer.php");
?>

</body>
</html>





