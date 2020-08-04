<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}?>

<?php include('inc/header.php');?>
<div class="container">
    <h1 style ="text-align:center;">BUY THE ITEM</h1>
         <form method="post">
            <div class="row">            
                <div class="col-lg-4 col-sm-12 col-md-4"></div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                <label style="font-size:24px;" for="id_name">Enter the ID</label><br>
                <input style="font-size:20px;width:50%;"type="text" id="uniqueid" name="uniqueid" placeholder="ID of the item" required>
                <input type="submit" value="Go" style="width:20%; float:center;" name="submit"><br>
                </div>
            </div>
        </form>
        <div class="row">            
                <div class="col-lg-4 col-sm-12 col-md-4"></div>
                <div class="col-lg-4 col-sm-12 col-md-4" style="text-align:center; color:black;">
                <?php
                 require_once "db.php";
                 // Check connection    
                 if ($mysqli->connect_error) {
                      die("Connection failed: " . $mysqli->connect_error); 
                  } 
                  if (isset($_POST['submit'])){
                           $ID=$_POST['uniqueid'];
                           $sql = "SELECT * FROM stock where id='$ID'";
                           $result = $mysqli->query($sql);
                           if ($result->num_rows > 0) {
                             while($row = $result->fetch_assoc()) { 
                                 if($row["orderstatus"]=='0'){?>
                                 <h2><?php echo $row["itemname"] ?></h2> 
                                 <img src="images/stock/<?php echo $row["picture"] ?>" alt="Avatar" style="width:200px;height:200px;">
                                 <h3>ITEM ID:<?php echo $row["id"] ?></h3>
                                 <?php $_SESSION["buyid"]=$row["id"];?>
                                 <h3>TYPE:<?php echo $row["itemtype"] ?></h3>
                                 <h3 >COST:<?php echo $row["cost"] ?></h3>
                                 <b><p ><?php echo $row["description"] ?></p></b>
                                 <h2 style="text-decoration:underline;">Seller-details</h2>
                                 <h3><?php echo $row["sellername"] ?></h3> 
                                 <a class="buy_ref" href="tel:<?php $row["mobilenumber"]?>" ><h3> <?php echo $row["mobilenumber"] ?> </h3></a> 
                                 <a class="buy_ref" href="mailto:<?php $row["mail"]?>"><h3> <?php echo $row["mail"] ?> </a><br>
                                 <h3> <?php echo $row["address"] ?></h3>
                                 <div class="submit">
                                 <p style="color:red;">Presently we have only cash on delivery as payment options.</p>
                                <?php $_SESSION["sellermail"]=$row["mail"];
                                      $_SESSION["sellername"]=$row["sellername"];?>
                                 <form method="post" action="buymail.php">
                                 <input type="submit" value="Proceed to payment" name="payment"><br>
                                 </form>  
                                  </div>
                                 
                        <?php   } 

                                else if($row["orderstatus"]=='1'){?>
                                    <h3>Sorry,The item has been booked by someoneelse.</h3>
                                    
                             <?php  }
                                else{?>
                                    <h3>Sorry,The item has been sold to someoneelse.</h3>
                               <?php  }
                            } } 
                          else { ?>
                        <h3>Sorry<br>
                         The Item with Team Id: <?php echo $ID ?> is presently out of stock or Invalid Id.<br>
                        You can add the item you require in the cart</h3>
                      <?php }
                    } 
                    else{?>
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
$mysqli->close();
?>

                </div>
        </div>
</div>
</div>
<style>a.buy_ref,a.buy_ref:hover{
color:black;

}
</style>
<?php include('inc/footer.php'); ?>
