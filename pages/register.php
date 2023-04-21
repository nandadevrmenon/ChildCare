<?php
require_once("../components/header.php");
require_once("../scripts/validationFunctions.php");
require_once("../database.php"); //require the db 
//below are the lookup arrays that will basically help us cross check tha the model and VIN match the make

// $errors = array();
// $GLOBALS['hideForm']=false;   //variables that holds if the form is to be hideen after registration or not

// if($_SERVER["REQUEST_METHOD"]=="POST"){
//   $fname = cleanInput($_POST["fname"]);   //clean all inputs to corrcet format
//   $lname = cleanInput($_POST["lname"]); 
//   $phone = cleanInput($_POST["phone"]); 
//   $email = cleanInput($_POST["email"]);
//   $pw = password_hash($_POST["password"]);
//   $confirmPw = password_hash($_POST["confirmPassword"]);

//   echo $fname.$lname.$pw. $confirmPw.$phone.$email;
// }
// if(count($errors)==0){
//   $GLOBALS['hideForm']=true;    //if there are no errors we hide the form

// if(!carAlreadyExists($registration,$vin)){    //we check if that car already exists in the table and if not we
//   $sqlString= "INSERT INTO `cars_info` (`registration`,`vin`, `make`, `model`, `year`, `engineSize`, `transmissionType`, `seats`, `doors`, `fuelType`, `color`, `dateOfRegistration`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

//   $statement = $GLOBALS['db']->prepare($sqlString);
//   $statement->bind_param('ssssiisiisss',$registration,$vin,$make,$model,$year,$engineSize,$transmissionType,$seats,$doors,$fuelType,$color,$dateOfRegistration);    //prevents sql injections

//   $statement->execute();      //we inser the car into the database
//   if( $statement->affected_rows==1){    //if a car has been added succesfully 
//     echo "<h4 class='mb-4'>Your car has been added to our database <span class='text-success'>successfully!</span></h4><div class='mt-3 mb-3'><a href='addCar.php'>
//     <button class='btn btn-primary' type='button'>Add New Car</button></a>
//   </div><div class='mt-3 mb-5'><a href='index.html'>
//   <button class='btn btn-primary' type='button'>Back to Home</button></a>
// </div>";
//   }
//   else{   //this else statment is kind of pointless because if no rows are effected it is probably an uncaught sql error taht stop the system and throw a a system error anyway. So this code wont run
//     echo "<h2>An unexpected error occured. Please Try Again later</h2>";
//   }
// }
// else{
//   $GLOBALS['hideForm']=false;   //if that car already exists we sho the form again and tell the user that the car already exists
//   array_push($GLOBALS['errors'],"The VIN and/or Registration Number provided already exists in our database.");
// }


// }
// }

// if(!($GLOBALS['hideForm'])){    //is form is not to be hidden
//   if(count($errors)>0){
//     echo "<div>
//     <h3> You have made some mistakes in the form</h3>";
//     foreach($errors as $error){         //for each error in errors array, display it 
//       echo "<div class='alert alert-danger' role='alert'>$error</div>";
//     }
//     echo "</div>";
//   }
// }
?>
<div class="card w-100 p-5">
  <form class="container">
    <h1>Sign up</h1>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="fname" placeholder="John" value="" length="40">
          <label for="name">First Name</label>
        </div>
      </div>
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="lname" placeholder="Doe" value="" length="40">
          <label for="lname">Last Name</label>
        </div>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <div class="col-md">
        <div class="form-floating">
          <input type="email" class="form-control" id="email" placeholder="name@example.com" value="" length="75">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="phone" placeholder="0899898787" value="" length="10">
          <label for="phone">Irish Phone Number</label>
        </div>
      </div>
    </div>
    <div class="row g-2">
      <div class="col-md">
        <div class="form-floating">
          <input type="password" class="form-control" id="password" placeholder="password" value="" length="50">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="confirmPassword" placeholder="password" value="" length="50">
          <label for="confirmPassword">Confirm Password</label>
        </div>
      </div>
    </div>
    <div class="row g-2 mb-3">
      <?php
      if (true) {
        echo "<span class='text-danger'>Passwords don't match</span>";
      }
      ?>
    </div>
    <div class="row g-2">
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create Account</button>
      </div>
    </div>
  </form>
</div>
<?php
require_once("../components/footer.php");
?>