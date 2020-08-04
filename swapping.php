<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require "db.php";
$id=$_GET["id"];
$hash=$_GET["hash"];
if(strcmp(md5($id),$hash)){
    echo "<script>alert('Invalid link');document.location.href=('swap.php');</script>"; 
}
$sql = "SELECT itemtype FROM swapstock where id='$id' ";
$result = $mysqli->query($sql);
if ($result->num_rows > 0){
   while($row = $result->fetch_assoc()) { 
       $type_of_item=$row["itemtype"];
   }
}

?>
 
 
<?php include('inc/header.php');?>
<div class="container">
    <form  method="post" enctype="enctype='multipart/form-data'">
        <div class="row">            
            <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12"></div>
            <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">
                <label for="swapuniqueid">Choose Id:</label>
                <select type="text" id="swapuniqueid" name="swapuniqueid">
                  <?php  
                  require "db.php";
                  if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error); 
                  } 
              
                 
                  $mailer=$_SESSION["mail"];
                  $sql_1 = "SELECT * FROM swapstock WHERE mail='$mailer' AND itemtype='$type_of_item' ";
                  $result = $mysqli->query($sql_1);
                  
                  if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $row["id"]?>"><?php echo $row["id"]?></option>
                    <?php }
                  }?>
                   </select>
                <input type="submit" value="Go" style="width:20%; float:center;" name="submit"><br>
             </div>
    </div>
    </form>
        <div class="row">            
                <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12" style="text-align:center; color:black;">
                <?php
                  
                
                  $sql = "SELECT * FROM swapstock where id='$id' ";
                  $result = $mysqli->query($sql);
                  if ($result->num_rows > 0){
                     while($row = $result->fetch_assoc()) { ?>
                     <h2><?php echo $row["itemname"] ?></h2> 
                     <img src="images/swapstock/<?php echo $row["picture"] ?>" alt="Avatar" style="width:200px;height:200px;">
                      <h3>ITEM ID:<?php echo $row["id"] ?></h3>
                      <h3>TYPE:<?php echo $row["itemtype"] ?></h3>
                     <h2 style="text-decoration:underline;">Swapper-details</h2>
                      <h3><?php echo $row["swapper_name"] ?></h3> 
                      <a class="swap_ref" href="tel:<?php $row["mobilenumber"]?>" ><h3> <?php echo $row["mobilenumber"] ?> </h3></a> 
                      <a class="swap_ref" href="mailto:<?php $row["mail"]?>"><h3> <?php echo $row["mail"] ?> </a><br>
                     <h3> <?php echo $row["address"] ?></h3>
                     <?php $_SESSION["swappername"]= $row["swapper_name"];
                             $_SESSION["swappermail"]=$row["mail"];?>
                <?php   } 
                 } ?>
                 </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12" style="text-align:center; color:black;">
                  <?php if (isset($_POST['submit'])){
                         $ID=$_POST['swapuniqueid'];
                         $sql = "SELECT * FROM swapstock where id='$ID' ";
                         $result = $mysqli->query($sql);
                         if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc()) { ?>
                            <h2><?php echo $row["itemname"] ?></h2> 
                            <img src="images/swapstock/<?php echo $row["picture"] ?>" alt="Avatar" style="width:200px;height:200px;">
                             <h3>ITEM ID:<?php echo $row["id"] ?></h3>
                             <h3>TYPE:<?php echo $row["itemtype"] ?></h3>
                            <h2 style="text-decoration:underline;">Swapper-details</h2>
                             <h3><?php echo $row["swapper_name"] ?></h3>
                          
                             <a class="swap_ref" href="tel:<?php $row["mobilenumber"]?>" ><h3> <?php echo $row["mobilenumber"] ?> </h3></a> 
                             <a class="swap_ref" href="mailto:<?php $row["mail"]?>"><h3> <?php echo $row["mail"] ?> </a><br>
                            <h3> <?php echo $row["address"] ?></h3>
                 </div>
              </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12"></div>
                            <form method="post" action="swapmail"></form>
                            <?php $_SESSION["swapid_1"]=$ID;
                            $_SESSION["swapid_2"]=$id;
                            ?>
                            <form method="post" action="swapmail.php">
                            <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 submit" >
                               <input type="submit" value="exchange" name="exchange"><br>
                            </div>
                            </form>

                            </div>
                
                       <?php   } 
                        } 
                   } ?>
                 
<?php $mysqli->close();
?>
        </div>
                </div>
</div>
<style>a.swap_ref,a.swap_ref:hover{
color:black;
 
}
</style>
<?php include('inc/footer.php'); ?>
