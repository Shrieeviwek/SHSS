<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$hash=$_GET["hash"];
$hash1=md5($_SESSION["mail"]);
if(strcmp($hash,$hash1)){?>
    <h1 style="text-align:center;">INVALID LINK</h1>  
    <?php
     }
     else{
$id=$_GET["id"];
$flag=$_GET["flag"];
require "db.php";
$sql_1 = "SELECT * FROM stock where id='$id' and orderstatus='3' ";
$result1 = $mysqli->query($sql_1);
     if ($result1->num_rows >0){
        if($flag=='1'){
            $sql_3 = "UPDATE  `stock`
            SET orderstatus='0', buyermail='' 
            WHERE  id ='$id'";
            if(!mysqli_query($mysqli,$sql_3))
            {
                echo "<script>alert('Server Busy.Please Try again')</script>";
                
            }
            else
            {
               echo "<script>alert('Succesfully updated status.Your item added to stock')</script>";
        
            }
        } 
        else{
            $sql_3 = "UPDATE  `stock`
            SET orderstatus='4'
            WHERE  id ='$id'";
            if(!mysqli_query($mysqli,$sql_3))
            {
                echo "<script>alert('Server Busy.Please Try again')</script>";
                
            }
            else
            {
               echo "<script>alert('Succesfully updated status.')</script>";
        
            }
        }    
    } 
    else {?>
        <h1 style="text-align:center;">INVALID LINK</h1>  
        <?php exit();
    }
     }
?>