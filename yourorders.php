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
<div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            
                
                <div>
                <img src="images/person.png" alt="" style="width:150px;height:150px;border-radius:50%">
                <h4 style="color:black"><?php echo htmlspecialchars($_SESSION["name"]) ?></h4>
                <a href="tel:<?php $_SESSION["mobilenumber"]?>"><h4 style="color:black"><i class="fa fa-phone"></i>+91 <b><?php echo htmlspecialchars($_SESSION["mobilenumber"]); ?></b></h4></a>
                <a href="mailto:<?php $_SESSION["mail"]?>"><h4 style="color:black"><i style="font-size:18px;"  class="material-icons">email</i><?php echo htmlspecialchars($_SESSION["mail"])?></h4></a>
                <a href="editprofile.php"><h4 style="color:black"><i class="fa fa-edit"></i> Edit Profile</h4></a>
                </div>
            
        </div>
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
        <h1 style="margin-top:100px;text-align:center;color:black">Your Orders and Items</h1>
        </div>
</div>
<hr>
<h1 style="text-align:center;">Your Orders</h1>
        <?php
        require_once "db.php";
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$myemail=$_SESSION["mail"];
$sql = "SELECT * FROM stock WHERE buyermail='$myemail'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {?>
    <?php while($row = $result->fetch_assoc()) { 
                                            if($row["orderstatus"]=='1'){?>
                                                     <div class="row">
                                                     <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div>
                                                     <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12"> 
       
                                                    <div>
                                                        <img src="images/stock/<?php echo $row["picture"] ?>" alt="<?php echo $row["itemname"] ?>" style="width:200px;height:200px">
                                                        <h3 style="color:black">Item name:<?php echo $row["itemname"] ?></h3>
                                                        <h3 style="color:black">Item Id:<?php echo $row["id"]?></h3>
                                                        <h3 style="color:black">OrderStatus:Will be delivered by<br>
                                                        <?php echo $row["sellername"] ?> <br>
                                                        <?php echo $row["mail"] ?><br>
                                                        <?php echo $row["mobilenumber"] ?></h3>
                                                        <?php $id=$row["id"];?>
                                                        <form method="post">
                                                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                        <input type="submit" id="Cancel" name="<?php echo $id?>" value="Cancel">
                                                        <hr>
                                                        </div>
                                                        </form>
                                                        <?php if (isset($_POST[$id])){
                                                                        $email=$_SESSION["mail"];
                                                                        $sql="UPDATE `stock` SET orderstatus ='0', buyermail='' WHERE id='$id' ";
                                                                        if(!mysqli_query($mysqli,$sql))
                                                                                {
                                                                                echo "<script>alert(' Server Busy! Please try again');document.location.href=('yourorders.php');</script>";
                                                                                }
                                                                                else
                                                                                {
                                                                                require_once("cancelmail.php"); 
                                                                                }   
                                                              } ?>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        <?php }
                                            else if($row["orderstatus"]=='2'){?>
                                                <div class="row">
                                                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div>
                                                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12"> 
                                                    <div>
                                                        <img src="images/stock/<?php echo $row["picture"] ?>" alt="<?php echo $row["itemname"] ?>" style="width:200px;height:200px">
                                                        <h3 style="color:black">Item name:<?php echo $row["itemname"] ?></h3>
                                                        <h3 style="color:black">Item Id:<?php echo $row["id"]?></h3>
                                                        <h3 style="color:black">OrderStatus:Delivered on <?php echo $row["date"] ?> by:<br>
                                                        <?php echo $row["sellername"] ?> <br>
                                                        <?php echo $row["mail"] ?><br>
                                                        <?php echo $row["mobilenumber"] ?></h3>
                                                        <?php $id=$row["id"];
                                                      
                                                         $date=date("Y-m-d");
                                                       
                                                         $date2=date_create($date);
                                                         $date1=date_create($row["date"]);
                                                         $diff=date_diff($date2,$date1);
                                                        if($diff->d<10){?>
                                                        <form method="post">
                                                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                        <input type="submit" id="Return" name="<?php echo $id?>" value="Return">
                                                        <hr>
                                                        </div>
                                                        </form>
                                                        <?php if (isset($_POST[$id])){
                                                                        $email=$_SESSION["mail"];
                                                                        $sql="UPDATE `stock` SET orderstatus ='3' WHERE id='$id' ";
                                                                        if(!mysqli_query($mysqli,$sql))
                                                                                {
                                                                                echo "<script>alert(' Server Busy! Please try again');document.location.href=('yourorders.php');</script>";
                                                                                }
                                                                                else
                                                                                {
                                                                                require_once("returnmail.php"); 
                                                                                }   
                                                              } }?>
                                                    </div>
                                                    
                                                </div>
                                            
                                        </div>
                                            <?php 
                                            }
                                         else if($row["orderstatus"]=='3'){?>
                                            <div class="row">
                                            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div>
                                            <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12"> 
                                                <div>
                                                    <img src="images/stock/<?php echo $row["picture"] ?>" alt="<?php echo $row["itemname"] ?>" style="width:200px;height:200px">
                                                    <h3 style="color:black">Item name:<?php echo $row["itemname"] ?></h3>
                                                        <h3 style="color:black">Item Id:<?php echo $row["id"]?></h3>
                                                        <h3 style="color:black">OrderStatus:Return requested</h3>
                                                    <?php $id=$row["id"];?>
                                                </div>
                                                
                                            </div>
                                        </div>
                                         <?php }
                                         else{?>
                                            <div class="row">
                                            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div>
                                            <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12"> 
                                                <div>
                                                    <img src="images/stock/<?php echo $row["picture"] ?>" alt="<?php echo $row["itemname"] ?>" style="width:200px;height:200px">
                                                    <h3 style="color:black">Item name:<?php echo $row["itemname"] ?></h3>
                                                        <h3 style="color:black">Item Id:<?php echo $row["id"]?></h3>
                                                        <h3 style="color:black">OrderStatus:Delivered</h3>
                                                    <?php $id=$row["id"];?>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <?php }
                                   }
                                    } ?>
<hr>
<h1 style="text-align:center">MYORDERS </h1><br>

<?php $sql_1 = "SELECT * FROM stock WHERE mail='$myemail'";
$result_1 = $mysqli->query($sql_1);?>

<?php
if ($result_1->num_rows > 0) {?>
   <?php while($row = $result_1->fetch_assoc()) { 
                                            if($row["orderstatus"]=='1'){?>
                                                    <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"></div>
                                                    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12"> 
                                                    <div>
                                                    <img src="images/stock/<?php echo $row["picture"] ?>" alt="<?php echo $row["itemname"] ?>" style="width:200px;height:200px"><br>
                                                        <h3 style="color:black">Item name:<?php echo $row["itemname"] ?></h3>
                                                        <h3 style="color:black">Item Id:<?php echo $row["id"]?></h3>
                                                        <?php $id=$row["id"];?>
                                                        <form method="post">
                                                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                        <input type="submit" id="Delivered" name="<?php echo $id?>" value="Delivered">
                                                        <hr>
                                                        </div>
                                                        </form>
                                                        <?php if (isset($_POST[$id])){
                                                                        $email=$_SESSION["mail"];
                                                                        $date=date("Y-m-d");
                                                                        $sql="UPDATE `stock` SET orderstatus ='2', date='$date' WHERE id='$id' ";
                                                                        if(!mysqli_query($mysqli,$sql))
                                                                                {
                                                                                echo "<script>alert(' Server Busy! Please try again');document.location.href=('yourorders.php');</script>";
                                                                                }
                                                                    
                                                                                else
                                                                                {
                                                                                echo "<script>alert('Status updated');document.location.href=('yourorders.php');</script>";   
                                                                                
                                                                                }   
                                                              } ?>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            
                                        <?php } ?>
                                        
                                    <?php } ?>
                            <?php }
                           
                            
$mysqli->close();
?>
</div>
</div>
</div>
</div>
<?php include('inc/footer.php');?>