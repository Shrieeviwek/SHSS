<?php
session_start();
if(!strcmp($_SESSION["sellermail"],$_SESSION["mail"])){
    echo "<script>alert('Yon cannot buy the item');document.location.href=('buy.php');</script>";
      exit;
     }
define("PROJECT_HOME","http://localhost/SHSS/");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 0;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "keerthanasaikarnam@gmail.com";
$mail->Password   = "kk13@1019";
$mail->IsHTML(true);
$email=$_SESSION["sellermail"];
$name=$_SESSION["sellername"];
$id=$_SESSION["buyid"];
$name_1=$_SESSION["name"];
$email_1=$_SESSION["mail"];
$mail->AddAddress("$email", "$name");
$mail->SetFrom("keerthanasaikarnam@gmail.com", "KS-Buy,Sell and exchange");
$mail->AddReplyTo("karnamsaikeerthana@gmail.com", "KS"); 
$mail->Subject = "KS-Update Regarding your item";
$content =  " Hello $name ,
<br>Your item with ID: $id is booked by $name_1 ($email_1).<br> <br>
Regards,<br>
KS-Buy,Sell and Exchange.";
$mail->MsgHTML($content);
require "db.php";
$sql= "UPDATE `stock` SET buyermail ='$email_1', orderstatus='1' WHERE id='$id'";
if(!mysqli_query($mysqli,$sql)){
  echo "<script>alert('Serve Busy.Please try again');document.location.href=('buy.php');</script>"; 
}

else{
 if(!$mail->Send()) {
    echo "<script>alert('Error while sending mail.');document.location.href=('buy.php');</script>";
  } 
    else {
    echo "<script>alert('Email sent successfully to your seller.Please contact him/her for further updates');document.location.href=('welcome.php');</script>";
    exit();
  }
}
?>
