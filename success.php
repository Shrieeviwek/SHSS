<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$hash=$_GET["hash"];
$id1=$_GET["id1"];
$id2=$_GET["id2"];
$hash1=md5($id1+$id2);
if(strcmp($hash,$hash1)){?>
<h1 style="text-align:center;">INVALID LINK</h1>  
<?php }


require "db.php";
$sql_1 = "SELECT * FROM swapstock where id='$id1' ";
$result1 = $mysqli->query($sql_1);
     if ($result1->num_rows > 0){
        $flag1=1;       
    } 
    else {?>
        <h1 style="text-align:center;">INVALID LINK</h1>  
        <?php exit();
    }
$sql_2 = "SELECT * FROM swapstock where id='$id2' ";
$result2 = $mysqli->query($sql_2);
       if ($result2->num_rows > 0){
            $flag2=1;       
        } 
        else {
            ?>
            <h1 style="text-align:center;">INVALID LINK</h1>  
            <?php
            exit();
        }
if($flag1==1&&$flag2==1){
    $sql_3 = "DELETE  FROM swapstock WHERE id='$id1' or id='$id2'";
    if(!mysqli_query($mysqli,$sql_3))
    {
        echo "<script>alert('Server Busy.Please Try again');document.location.href=('welcome.php');</script>";
        
    }
    else
    {
       echo "<script>alert('Succesfully updated status.');document.location.href=('swap.php');</script>";

    }
    
}

?>