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
<h1 style="text-align:center;">Stockin in information</h1>
<form method="post">
 
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/books.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Books" value="0">
        <input type="checkbox"  name="Books" value="1">
        <label for="vehicle1">BOOKS</label>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
   
        <img src="images/cycles.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Cycles" value="0">
        <input type="checkbox"  name="Cycles" value="1">
        <label for="vehicle2">CYCLES</label>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/edkits.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Ed_kit" value="0">
        <input type="checkbox" name="Ed_kit" value="1">
        <label for="vehicle3">Ed-Kits</label>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/headphones.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Headphones" value="0">
        <input type="checkbox" name="Headphones" value="1">
        <label for="vehicle4">Headphones</label>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/earphones.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Earphones" value="0">
        <input type="checkbox" name="Earphones" value="1">
        <label for="vehicle5">Earphones</label>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/laptops.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Laptops" value="0">
        <input type="checkbox" name="Laptops" value="1">
        <label for="vehicle6">Laptops</label>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/mobiles.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Mobiles" value="0">
        <input type="checkbox" name="Mobiles" value="1">
        <label for="vehicle7">Mobiles</label>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/speakers.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="Speakers" value="0">
        <input type="checkbox" name="Speakers" value="1">
        <label for="vehicle8">Speakers</label>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <img src="images/others.JPG" style="height:300px; width:300px;"><br>
        <input type ="hidden" name="others" value="0">
        <input type="checkbox" name="0thers" value="1">
        <label for="vehicle9">Others</label>
    </div>
</div>
 
<div class=" col-lg-4 col-md-4 col-sm-12"></div>
<div class="submit col-lg-4 col-md-4 col-sm-12">
   <div><input type="submit" id="cart" name="cart" value="Submit"></div>
</div>
</form>
<?php
if(isset($_POST["cart"])){
if($_POST["Cycles"]=='1')
 $Cycles=1;
 else 
 $Cycles=0;
 if($_POST["Books"]== '1')
 $Books=1;
 else 
 $Books=0;
 if($_POST["Ed_kit"]== '1')
 $Ed_kit=1;
 else 
 $Ed_kit=0;
 if($_POST["Headphones"]== '1')
 $Headphones=1;
 else 
 $Headphones=0;
 if($_POST["Earphones"]== '1')
 $Earphones=1;
 else 
 $Earphones=0;
 if($_POST["Laptops"]== '1')
 $Laptops=1;
 else 
 $Laptops=0;
 if($_POST["Mobiles"]== '1')
 $Mobiles=1;
 else 
 $Mobiles=0;
 if($_POST["Speakers"]== '1')
 $Speakers=1;
 else 
 $Speakers=0;
 if($_POST["others"]== '1')
 $others=1;
 else 
 $others=0;
 $mail=$_SESSION["mail"];
 require "db.php";
 $sql= "UPDATE  `users`
 SET Cycles= '$Cycles', Books='$Books',Ed_kit='$Ed_kit',Headphones='$Headphones',Earphones='$Earphones',Laptops='$Laptops',Mobiles='$Mobiles',Speakers='$Speakers',others='$others'
 WHERE  mail ='$mail'";
 if(!mysqli_query($mysqli,$sql))
 {
 echo "<script>alert(' Server Busy! Please try again');</script>";
 }
 
 else
 {
 echo "<script>alert('Status updated');</script>";   
 
 } 
}
?>
</div>
</div>
<?php include('inc/footer.php');?>
