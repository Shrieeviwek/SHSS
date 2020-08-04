<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "db.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    $otp_post=$_SESSION["otp"];
    $otp = trim($_POST["OTP"]);
    if(!strcmp($otp,$otp_post)){
        $name=$_SESSION["name"];
        $rollnumber=$_SESSION["rollnumber"];
        $email_id=$_SESSION["mail"];
        $mobilenumber= $_SESSION["mobilenumber"] ;
        $password = $_SESSION["password"];
        
        $sql = "INSERT INTO users (name,rollnumber,mail,mobilenumber,password) VALUES ('$name', '$rollnumber','$email_id','$mobilenumber','$password')";
        if(!mysqli_query($mysqli,$sql))
        {
            echo "<script>alert('Server Busy! Please try again');document.location.href=('signup.php');</script>";
            
        }

        else
        {
            SESSION_destroy();
           echo "<script>alert('Succesfully registered');document.location.href=('login.php');</script>";

        }

        
    }
    else
    {
        SESSION_destroy();
        echo "<script>alert('Invalid otp');document.location.href=('signup.php');</script>";
    }
    
    // Close connection
    $mysqli->close();
    
   
}
?>
<?php include('inc/header.php');?>
    <div class="container">
        <h1 style="text-align:center;">OTP</h1>
       <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           <div class="row">
            <div class="col-md-4 col-lg-4 "></div>
            <div class="col-md-4 col-lg-4 col-sm-12">
           <div class="login">
            <label for="OTP">OTP:</label><br>
            <input type="text" id="OTP" name="OTP" placeholder="OTP" required><br><br>
           </div>
           <div class="submit">
           <input type="submit" value="submit"><br>
           </div>
           </div>
        </div>
       </form>
    </div>
    </div>
    <style>
    @media screen and (min-width: 700px) {.f{
                               position:fixed;
                                bottom:0;
                                right:0;
                                left:0;
                            }
                            .content{
                                height:700px !important;
                            }}
    </style>
    <?php include('inc/footer.php');?>