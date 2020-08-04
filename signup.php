<?php
// Include config file
require_once "db.php";
 // Initialize the session
session_start();
// Define variables and initialize with empty values
$name=$rollnumber=$email_id=$mobilenumber=$password=$confirm_password="";
$name_err=$rollnumber_err=$mail_err=$mobilenumber_err=$password_err=$confirm_password_err="";
 
 
 
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
$mail->SetFrom("keerthanasaikarnam@gmail.com", "KS-Buy and Sell");
$mail->AddReplyTo("karnamsaikeerthana@gmail.com", "KS");
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
   
    
    if(empty(trim($_POST["mail"]))){
        $mail_err = "Please enter a email id.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE mail = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_mail);
            
            // Set parameters
            $param_mail = trim($_POST["mail"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $mail_err = "This Email is already taken.";
                } else{
                    $email_id = trim($_POST["mail"]);
                   
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
 
            // Close statement
            $stmt->close();
        }
    }
    if(empty(trim($_POST["rollnumber"]))){
        $mail_err = "Please enter Campus id.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE rollnumber = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_rollnumber);
            
            // Set parameters
            $param_rollnumber = trim($_POST["rollnumber"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $rollnumber_err = "This ID is already taken.";
                } else{
                    $rollnumber = trim($_POST["rollnumber"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
 
            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    
    if(empty(trim($_POST["mobilenumber"]))){
        $mobilenumber_err = "Please enter your mobile number.";     
    }
     else{
        $mobilenumber = trim($_POST["mobilenumber"]);
        if(strlen($mobilenumber)!=10){
            $mobilenumber_err="Invalid mobilenumber";
        }
    }
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";     
    }
     else{
        $name = trim($_POST["name"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
   
    // Check input errors before inserting in database
    if(empty($name_err) &&empty($rollnumber_err)&&empty($mail_err)&&empty($mobilenumber_err)&& empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
      
        
            // Set parameters
            $_SESSION["name"]=$name;
            $_SESSION["rollnumber"]=$rollnumber;
            $_SESSION["mail"]=$email_id;
            $_SESSION["mobilenumber"] =$mobilenumber;
            $_SESSION["password"]= password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $rndno=rand(100000, 999999);//OTP generate
            $_SESSION["otp"]=$rndno;
            $mail->Subject = " KS : otp number" . $rndno ;
            $mail->AddAddress("$email_id", "$name");
            $content = "<b>Please enter OTP to move further. otp number is '$rndno'</b>";
            $mail->MsgHTML($content); 
            // Attempt to execute the prepared statement
            
             if(!$mail->Send()) {?>
                 <script> alert('Error while sending Email.')</script>
               <?php var_dump($mail);
               } else {
                echo "<script>alert('Thank you for registrating. Verification of your registration has been be mailed to you.');document.location.href=('otp.php');</script>";
                
              }
          
 
      
    
    }
    
    // Close connection
    $mysqli->close();
 
}
?>
<?php include('inc/header.php');?>
<div class="content">
    <div class="container">
        <h1 style="text-align:center;">SIGN-UP</h1>
        
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
            <div class="col-md-3 col-lg-3 "></div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <p style="color:red;font-size:20px;">Please fill all the details</p>
                <div class="signup">
                   
                    <label for="name">Name:</label><?php echo (!empty($name_err)) ? $name_err : ''; ?><br>
                    <input type="text" id="name" name="name" placeholder="Your Name" required><br>
                
                    <label for="rollnumber">Campus-Id:</label><?php echo (!empty($rollnumber_err)) ? $rollnumber_err : ''; ?><br>
                    <input type="text" id="rollnumber" name="rollnumber" placeholder="Your Campus roll id" required><br>
                
                    <label for="mail">Email-Id:</label><?php echo (!empty($mail_err)) ? $mail_err : ''; ?><br>
                    <input type="email" id="mail" name="mail" placeholder="Your Email-Id" required><br>
            
                    <label for="mobilenumber">Phone Number:</label><?php echo (!empty($mobilenumber_err)) ? $mobilenumber_err : ''; ?><br>
                    <input type="tel" id="mobilenumber" name="mobilenumber" placeholder="Your Mobile number" required><br>
                
                    <label for="password">Password:</label><?php echo (!empty($password_err)) ? $password_err : ''; ?><br>
                    <input type="password" id="password" name="password" placeholder="Create password" required><br>
        
                    <label for="confirm_password">Confirm Password:</label><?php echo (!empty($confirm_password_err)) ? $confirm_password_err : ''; ?><br>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Your Password" required><br>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4"></div>
                    <div class="submit col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <input type="submit" value="Submit"><br>
                    </div>
                </div>
        </div>
    </form>
    </div>
</div>
<?php include('inc/footer.php');?>
 
