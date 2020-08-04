
<?php
session_start();
 
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
$email=$_SESSION["swappermail"];
$name=$_SESSION["swappername"];
$swapid_1=$_SESSION["swapid_1"];
$swapid_2=$_SESSION["swapid_2"];
$name_1=$_SESSION["name"];
$email_1=$_SESSION["mail"];
$hash=md5($swapid_1+$swapid_2);
$mail->AddAddress("$email", "$name");
$mail->SetFrom("keerthanasaikarnam@gmail.com", "KS-Buy,Sell and exchange");
$mail->AddReplyTo("karnamsaikeerthana@gmail.com", "KS"); 
$mail->Subject = "KS-Update Regarding your item";
$content =" <div>  Hello $name ,
PLease login and check if you are ready to swap items with swap ids $swapid_1 and $swapid_2.If you are ready to accept.
<br><p>Click this link to accept.<br>
<br><a href='" . PROJECT_HOME . "success.php?id1=" . $swapid_1 . "&&id2=" . $swapid_2 . "&&hash=" . $hash ."'>Swap</a><br><br></p>
Regards,<br>
KS-Buy,Sell and Exchange.</div>";
$mail->MsgHTML($content);
 
 if(!$mail->Send()) {
    echo "Error while sending Email.";
  } 
    
  else {
    echo "<script>alert('Email sent successfully to your swapper.Contact him/her for updates');document.location.href=('welcome.php');</script>";
    exit();
  }
?>
 

