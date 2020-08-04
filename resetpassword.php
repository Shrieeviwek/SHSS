<?php
$mailer= md5($_GET["mail"]);
$hash=$_GET["hash"];
if(strcmp($mailer,$hash)){?>
<h1 style="text-align:center;">INVALID LINK</h1>
<?php 
exit();
}

    if(isset($_POST["reset-password"])) {
        require_once "db.php";
        $password=$_POST["member_password"];
        $mail= $_GET["mail"];
        $passwordhash=password_hash($password, PASSWORD_DEFAULT); 
        $sql =  "UPDATE  `users`
        SET  `password`='$passwordhash' 
        WHERE  `mail` ='$mail'";
        if(!mysqli_query($mysqli,$sql)){
        $success_message = "Server Busy ";
        }
        else
          echo "<script>alert('Password is reset');document.location.href=('login.php');</script>";
    }
?>
<link href="demo-style.css" rel="stylesheet" type="text/css">
<script>
function validate_password_reset() {
    if((document.getElementById("member_password").value == "") && (document.getElementById("confirm_password").value == "")) {
        document.getElementById("validation-message").innerHTML = "Please enter new password!"
        return false;
    }
    if(document.getElementById("member_password").value  != document.getElementById("confirm_password").value) {
        document.getElementById("validation-message").innerHTML = "Both password should be same!"
        return false;
    }
    
    return true;
}
</script>
<?php include('inc/header.php');?>
<div class="container">
<div class="row">
<div class="col-md-4 col-lg-4 "></div>
<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
<form name="frmReset" id="frmReset" method="post" onSubmit="return validate_password_reset();">
<h1 style="text-align:center;">Reset Password</h1>
    <?php if(!empty($success_message)) { ?>
    <div class="success_message"><?php echo $success_message; ?></div>
    <?php } ?>
 
    <div id="validation-message">
        <?php if(!empty($error_message)) { ?>
    <?php echo $error_message; ?>
    <?php } ?>
    </div>
 
    <div class="login">
        <div><label for="Password">Password</label></div>
        <div>
        <input type="password" name="member_password" id="member_password" class="input-field" required></div>
    </div>
    
    <div class="login">
        <div><label for="email">Confirm Password</label></div>
        <div><input type="password" name="confirm_password" id="confirm_password" class="input-field" required></div>
    </div>
    
    <div class="submit">
        <div><input type="submit" name="reset-password" id="reset-password" value="Reset Password" class="form-submit-button"></div>
    </div>  
</form>
        </div>
        </div>
        </div>
        </div>
<?php include('inc/footer.php');?>
