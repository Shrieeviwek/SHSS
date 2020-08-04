<?php
 session_start();
ob_start();
require "db.php";
if (isset($_POST['submit'])){
   $id=$_POST["id"];
    $feedback=$_POST['feedback'];
    $name=$_SESSION["name"];
    $mail=$_SESSION["mail"];
    $sql = "INSERT INTO `feedbacks` (name,mail,id,feedback) VALUES ('$name','$mail','$id', '$feedback')";
    if(!mysqli_query($mysqli,$sql))
       {
          echo "<script>alert('Server Busy>Please Try again');document.location.href=('feedback.php');</script>";
       }

       else
       {
      echo "<script>alert('feedback added successfully');document.location.href=('feedback.php');</script>";   
         
       }

}