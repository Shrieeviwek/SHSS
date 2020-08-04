
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
$email=$row["mail"];
$name=$row["sellername"];
$id=$row["id"];
$name_1=$_SESSION["name"];
$email_1=$_SESSION["mail"];
$mail->AddAddress("$email", "$name");
$mail->SetFrom("keerthanasaikarnam@gmail.com", "KS-Buy and Sell");
$mail->AddReplyTo("karnamsaikeerthana@gmail.com", "KS"); 
$mail->Subject = "KS-Update Regarding your item";
$content =" <div>  Hello $name ,<br><br><p>Your item with id:". $id. " has been cancelled by ". $name_1 ."(" . $email_1 .")</p>
<br>
Regards,<br>
KS-Buy,Sell and Exchange.
</div>";
$mail->MsgHTML($content);
 
 if(!$mail->Send()) {
    echo "Error while sending Email.";
  } 
    else {
    echo "<script>alert('Status updated and update sent to seller');document.location.href=('yourorders.php');</script>";
    exit();
  }
?>
 

