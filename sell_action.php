<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

ob_start();
require "db.php";
if (isset($_POST['submit'])){
    
        $item_name                  = $_POST['item_name'];
        $type_of_item                  = $_POST['type_of_item'];
        $description                 = $_POST['description'];
        $cost                 = $_POST['cost'];
        $seller_name                = $_POST['sellername'];
        $mobilenumber                 = $_POST['mobilenumber'];
        $altnumber               = $_POST['altnumber'];
        $mail=$_SESSION["mail"];
        $address                 = $_POST['address'];
        $filename=$_FILES['file']['name'];
        $directory = getcwd().'/file/';
        $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
        $file_ext = substr($filename, strripos($filename, '.')); // get file name
        $filesize = $_FILES["file"]["size"];
           // Rename file
        $newfilename = $item_name.$file_ext;
        $_SESSION["type"]=$type_of_item;
        // Rename file
	

           move_uploaded_file($_FILES["file"]["tmp_name"], "./images/stock/".$newfilename);
				 $sql = "INSERT INTO `stock` (itemname,itemtype,description,cost,sellername,mobilenumber,mail,address,picture,altnumber) VALUES ('$item_name','$type_of_item','$description','$cost', '$seller_name', '$mobilenumber', '$mail', '$address','$newfilename','$altnumber')";
         if(!mysqli_query($mysqli,$sql))
				{
               echo "<script>alert(' Server Busy! Please try again');document.location.href=('sell.php');</script>";
				}

				else
				{
               $sql="SELECT * FROM users WHERE $type_of_item = '1'";
               $result=$mysqli->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  require_once("stockinmail.php");
                }
               }
               
               echo "<script>alert('Item Added');document.location.href=('sell.php');</script>";   
              
            }
            $mysqli->close();
    
}
  

?>