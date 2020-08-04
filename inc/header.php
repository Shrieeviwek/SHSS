<!DOCTYPE html>
<html>
    <head>
      <title>KS-buy,sell and exchange</title>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
              x.className += " responsive";
            } else {
              x.className = "topnav";
            }
          }
          </script>
    </head>
   <body>
       <div class="content">
       
        <div class="topnav" id="myTopnav">
        <a href="welcome.php">Home</a>
        <?php
              if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { // check if session named 'id' is exist
         ?>
         <a href="login.php">Log in</a>
         <a href="signup.php">Sign Up</a>
              <?php } 
          else { ?>
           <a href="sell.php">Sell</a>
           <a href="view.php" >View Stock</a>
           <a href="buy.php">Buy</a>
           <a href="swap.php">Swapping</a>
           <a href="yourorders.php">Your Orders</a>
           <a href="cart.php">Cart</a>
           <a href="feedback.php">Feedback</a>
           <a href="logout.php">Log Out</a>
         <?php }?>
          
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
        </div>
