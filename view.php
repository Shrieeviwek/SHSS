<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php include('inc/header.php');?>

         <div class="container" style="text-align:center;">
        <h1 style="text-align:center;">Stock</h1>
        <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4" style="font-size:20px;">
        <form method="post">
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
                        </select>
        <input type="submit" value="Go" style="width:30%;" name="submit"><br>
        </form>
        </div>
        <div class="col-lg-4"></div>
        </div>

<div class="row">
<?php
require_once "db.php";
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
   
  if (isset($_POST['submit'])){
         $type_of_item=$_POST['type_of_item'];?>
          <h1 ><?php echo $type_of_item;?></h1>
          <?php $sql = "SELECT * FROM stock WHERE itemtype='$type_of_item' AND orderstatus= '0'";
          $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
             // output data of each row
                 while($row = $result->fetch_assoc()) { ?>
                        <div class="flip-card col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          <div class="flip-card-inner">
                            <div class="flip-card-front">
                                    <h4><?php echo $row["itemname"] ?></h4> 
                                    <img src="images/stock/<?php echo $row["picture"] ?>" alt="<?php echo $row["itemname"]?>" style="width:200px;height:200px;">
                                     <h5 style="font-size:16px;"><b>Item Id:<?php echo $row["id"] ?></b></h5>
                                     <b><p style="font-size:16px;">Cost:<?php echo $row["cost"] ?></p>
                                     <p ><?php echo $row["description"] ?></p></b>
                             </div>
                             <div class="flip-card-back">
                                      <h2 style="text-decoration:underline;">Seller-details</h2>
                                      <h4><?php echo $row["sellername"] ?></h4> 
                                      <a class="flip_ref" href="tel:<?php $row["mobilenumber"]?>" ><p> <?php echo $row["mobilenumber"] ?> </p></a> 
                                      <?php if($row["altnumber"]>0){?>
                                      <a class="flip_ref" href="tel:<?php $row["altnumber"]?>" ><p> <?php echo $row["altnumber"] ?> </p></a> <?php }?>
                                      <a class="flip_ref" href="mailto:<?php $row["mail"]?>"><p> <?php echo $row["mail"] ?> </p></a>
                                     <address><?php echo $row["address"] ?></address>
                             </div>
                            </div>
                         </div>
              <?php   } ?>
      <?php } 
else { ?>
   <h1>Presently out of stock</h1>
   <style>
   @media screen and (min-width: 700px) {.f{
                               position:fixed;
                                bottom:0;
                                right:0;
                                left:0;
                            }
                            .content{
                                height:700px !important;
                            }}
                            </style>
<?php } 
  }
else {
     $sql = "SELECT * FROM stock WHERE orderstatus= '0'";
     $result = $mysqli->query($sql);
     if ($result->num_rows > 0) {
      // output data of each row
          while($row = $result->fetch_assoc()) { ?>
                 <div class="flip-card col-lg-4 col-md-4 col-sm-12 col-xs-12">
                   <div class="flip-card-inner">
                     <div class="flip-card-front">
                             <h4><?php echo $row["itemname"] ?></h4> 
                             <img src="images/stock/<?php echo $row["picture"] ?>" alt="<?php echo $row["itemname"]?>" style="width:200px;height:200px;">
                              <h5 style="font-size:16px;"><b>Item Id:<?php echo $row["id"] ?></b></h5>
                              <b><p style="font-size:16px;">Cost:<?php echo $row["cost"] ?></p>
                              <p ><?php echo $row["description"] ?></p></b>
                      </div>
                      <div class="flip-card-back">
                               <h2 style="text-decoration:underline;">Seller-details</h2>
                               <h4><?php echo $row["sellername"] ?></h4> 
                               <a class="flip_ref" href="tel:<?php $row["mobilenumber"]?>" ><p> <?php echo $row["mobilenumber"] ?> </p></a>
                               <?php if($row["altnumber"]>0){?>
                               <a class="flip_ref" href="tel:<?php $row["altnumber"]?>" ><p> <?php echo $row["altnumber"] ?> </p></a> <?php }?>
                               <a class="flip_ref" href="mailto:<?php $row["mail"]?>"><p> <?php echo $row["mail"] ?> </p></a>
                              <address><?php echo $row["address"] ?></address>
                      </div>
                     </div>
                  </div>
       <?php   } ?>
<?php } 
   else{?>
    <h1>Presently out of stock</h1>
    <style>
    @media screen and (min-width: 1100px) {.f{
                                position:fixed;
                                 bottom:0;
                                 right:0;
                                 left:0;
                             }
                             .content{
                                 height:700px !important;
                             }}
                             </style>
   <?php }
}

$mysqli->close();
?>
</div>
</div>

<?php include('inc/footer.php');?>