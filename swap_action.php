<?php
 session_start();
ob_start();
require "db.php";
if (isset($_POST['addswapitem'])){
    $item_name=$_POST['item_name'];
    $type_of_item=$_POST['type_of_item'];
    $filename=$_FILES['file']['name'];
    $swapper_name                = $_POST['swapper_name'];
    $mobilenumber                 = $_POST['mobilenumber'];
    $mail                = $_SESSION['mail'];
    $address     =$_POST['address'];
    $filename=$_FILES['file']['name'];   
    $directory = getcwd().'/file/';
    $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
    $file_ext = substr($filename, strripos($filename, '.')); // get file name
    $filesize = $_FILES["file"]["size"];
      // Rename file
   $newfilename = $item_name.$file_ext;

   move_uploaded_file($_FILES["file"]["tmp_name"], "./images/swapstock/".$newfilename);
             $sql = "INSERT INTO `swapstock` (itemname,itemtype,picture,swapper_name,mobilenumber,mail,address) VALUES ('$item_name','$type_of_item','$newfilename', '$swapper_name', '$mobilenumber', '$mail', '$address')";
         if(!mysqli_query($mysqli,$sql))
            {
              echo "<script>alert('Server Busy.Please try again.');document.location.href=('swap.php');</script>";
            }
 
            else
            {
              echo "<script>alert('Item added to swapstock.');document.location.href=('welcome.php');</script>"; 
              
            }
}
?>
