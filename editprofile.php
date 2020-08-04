<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php include('inc/header.php');?>
<div class="content">
    <div class="container">
    <form  method="post"  onSubmit="return validate_password_reset();">
        <div class="row">
             <div class="col-md-3 col-lg-3 "></div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
        <div class="signup">
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" value="<?php echo $_SESSION["name"]?>" required> <br>
           
            <label for="rollnumber">Campus-Id</label><br>
            <input type="text" id="rollnumber" name="rollnumber" value="<?php echo $_SESSION["rollnumber"]?>" required><br>
       
            <label for="mobilenumber">Phone Number</label><br>
            <input type="tel" id="mobilenumber" name="mobilenumber"value="<?php echo $_SESSION["mobilenumber"]?>"required><br>
            
            <div class="login">
             <div><label for="Password">Change Password:</label></div>
             <div>
             <input type="password" name="member_password" id="member_password" class="input-field" ></div>
           </div>
 
        </div>
         <div class="submit">
            <input type="submit" name="submit" value="Update Profile"><br>
        </div>
        </div>
    </form>
    
    <?php
                 require_once "db.php";
                 // Check connection    
                 
                 if ($mysqli->connect_error) {
                      die("Connection failed: " . $mysqli->connect_error); 
                  } 
                 if(isset($_POST['submit'])){
                    $name=$_POST["name"];
                    $roll_err="";
                    $rollnumber=$_POST["rollnumber"];
                    $mobilenumber= $_POST["mobilenumber"];
                    $password=$_POST["member_password"];
                    if(empty($password)){
                        $passwordhash=$_SESSION["password"];
                    }
                    else{
                        $passwordhash= password_hash($password, PASSWORD_DEFAULT);
                    }
                 
                    $id=$_SESSION["id"];
                    
                    if(strcmp($rollnumber,$_SESSION["rollnumber"])){
                        $check_roll = "SELECT rollnumber FROM users WHERE rollnumber = '$rollnumber'";
 
                        $find_roll = $mysqli->query($check_roll);
    
 
                       if($find_roll->num_rows)
                         {
                                 echo "$rollnumber already exists in our database! Please try again with a different Campus id.";
                                 $roll_err="invalid";
                         }
                    }
                    if(empty($roll_err)){
                    $sql= "UPDATE  `users`
                        SET name= '$name', rollnumber='$rollnumber', mobilenumber='$mobilenumber',password='$passwordhash' 
                        WHERE  id ='$id'";
                       
                     if(!mysqli_query($mysqli,$sql))
                    {
                        echo "Server Busy! Please try again";
                    } 
    
                    else
                    {
                        $_SESSION["name"]=$name;
                        $_SESSION["rollnumber"]=$rollnumber;
                        $_SESSION["mobilenumber"] =$mobilenumber;
                        $_SESSION["password"]=$password;
                       echo "<script>alert('Succesfully Edited');document.location.href='yourorders.php';</script>";
                    }
                     
                 }
                 
  
                   
                 }
    ?>
    </div>
</div>
<?php include('inc/footer.php');?>
 
