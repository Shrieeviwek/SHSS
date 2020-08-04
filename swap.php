<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php include('inc/header.php'); ?>
<div class="container">
    <form method="post" action="swap_action.php" enctype='multipart/form-data'>
        <div class="row">
                <div class="col-lg-4 col-md-4"></div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <h3 style="text-align:center;"> Item-Details</h3>
                    <div class="sell">
                        <label for="item_name">Name of Item:</label>
                        <input type="text" id="item_name" name="item_name" placeholder="Name of your selling item"><br><br>
                        <label for="type_of_item">Type of Item:</label>
                        <select type="text" id="type_of_item" name="type_of_item" required>
                        <option value="" selected hidden disabled>Select</option>
                        <option value="Books">Book</option>
                        <option value="Cycles">Cycle</option>
                        <option value="Earphones">Earphones</option>
                        <option value="Ed_kit">Ed-kit</option>
                        <option value="Headphones">Headphones</option>
                        <option value="Laptops">Laptop</option>
                        <option value="Mobiles">Mobile</option>
                        <option value="Speakers">Speaker</option>
                        <option value="others">Other</option>                    
                        </select><br>
                        <label for="file">Item Photo</label>
                        <input type="file" id="file" name="file" ><br>
                    </div>
                    <h3 style="text-align:center;">Your-Details</h3>
                    <div class="sell">
                        <label for="swapper_name">Name:</label>
                        <input type="text" id="swapper_name" name="swapper_name" placeholder="Your Name"><br><br>
                        <label for="mobilenumber">Phone Number</label>
                        <input type="tel" id="mobilenumber" name="mobilenumber" placeholder="Your Mobile number"><br><br>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Your Address"><br>
                    </div>
                    <div class="submit">
                        <input type="submit" value="addswapitem" name="addswapitem"><br>
                    </div>
                 </div>
        </div>
</form>
 


            <h1 style="text-align:center">Swapping List</h1>
            <div class="row">
            <?php
              require_once "db.php";
              if ($mysqli->connect_error) {
                  die("Connection failed: " . $mysqli->connect_error);
                } 
                 $sql="SELECT * FROM swapstock";
                 $result=$mysqli->query($sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { ?>
                     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                     <div class="w3-card-4 col-md-4 col-lg-4 col-xs-12"> 
                            <header class="w3-container w3-light-grey">
                            <h3><?php echo $row["itemname"]?></h3>
                            </header>
                        <div class="w3-container">
                        <p>Item type:<?php echo $row["itemtype"]?> </p>
                        <hr>
                    <div>
                     <img src="images/swapstock/<?php echo $row["picture"]?>" alt="<?php echo $row["picture"] ?>" class="w3-left w3-circle w3-margin-right" style="width:100% ;height:300px; ">
                  </div>
                   <div style="padding: 15px;text-align: center;">
                    <br>
                              <?php
                              echo  "<br>" . $row["swapper_name"] . "<br>";
                              echo   $row["mail"] . "<br>";
                              echo   $row["mobilenumber"] . "<br>";
                              echo   $row["address"] . "<br>";
                              $hash=md5($row["id"]);
                              $ref="swapping.php?id=".$row["id"]."&&hash=".$hash;
                              ?><br>
                    </div>
              </div>
    <?php if(strcmp($_SESSION["mail"],$row["mail"])){?>
    <a href="<?php echo $ref?>"><button class="w3-button w3-block w3-dark-grey">swap</button></a><?php }
    else
    {?>
      <button class="w3-button w3-block w3-dark-grey">Your item</button>
   <?php }?>
  </div>  
<?php   } ?>
<?php } else { ?>
   <h1>Presently out of stock</h1>
<?php } 
$mysqli->close();
?>
</div>
        </div>
       
        <?php include('inc/footer.php');?>
