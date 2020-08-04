<?php

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
$email=$row["mail"];
$name=$row["name"];
$type_of_item=$_SESSION["type"];
$name_1=$_SESSION["name"];
$email_1=$_SESSION["mail"];
$mail->AddAddress("$email", "$name");
$mail->SetFrom("keerthanasaikarnam@gmail.com", "KS-Buy and Sell");
$mail->AddReplyTo("karnamsaikeerthana@gmail.com", "KS"); 
$mail->Subject = "KS-Update Regarding your item";
$content =" <div> <br><br><p>Your awaiting item of type " . $type_of_item ." is added  by ". $name_1 ."(" . $email_1 .")</p></div>";
$mail->MsgHTML($content);
 
 $mail->Send();
?>