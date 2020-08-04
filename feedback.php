<?php
// Initialize the session
// Check if the user is logged in, if not then redirect him to login page
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php include('inc/header.php'); ?>
<div class=container>
    <form method="post" action="feedback_action.php" enctype='multipart/form-data'>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12"></div>
        <div class="col-lg-4 col-md-4 col-cm-12">
        <label for="id"><h3>Choose Item Id:</h3></label>
        <select type="text" id="id" name="id" required>
                  <?php  
                  require "db.php";
                  if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error); 
                  } 
              
                 
                  $mailer=$_SESSION["mail"];
                  $sql_1 = "SELECT * FROM stock WHERE buyermail='$mailer' AND orderstatus='2' ";
                  $result = $mysqli->query($sql_1);
                  
                  if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $row["id"]?>"><?php echo $row["id"]?></option>
                    <?php }
                  }?>
                   </select>
            <h3 style="text-align:centre">Feedback</h3>
            <textarea id="feedback" type="text" name="feedback" rows="10" cols="50"></textarea>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5"></div>
            <div class="submit col-lg-2">
                <input type="submit" value="submit" name="submit"><br>
            </div>
         </div>
    </div>
    </form>
</div>
    <?php include('inc/footer.php'); ?>
