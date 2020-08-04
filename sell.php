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
        <div class="container">
        <form method="post" action="sell_action.php" enctype='multipart/form-data'>
            <div class="row">
                <h1 style="text-align:center;">SELL</h1>
                <h2 style="text-align:center;"><b><i><q>Everyone lives by selling something</q></i></b></h1>
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <h3 style="text-align:center;"> Item-Details</h3>
                    <div class="sell">
                        <label for="item_name">Name of Item:</label>
                        <input type="text" id="item_name" name="item_name" placeholder="Name of your selling item" required><br><br>
                        <label for="cost">Cost of the Item</label>
                        <input type="text" id="cost" name="cost" placeholder="Cost of your item" required><br><br>
                        <label for="description">Description of the item</label>
                        <input type="text" id="description" name="description" placeholder="Description about your item" required><br>
                        <label for="type_of_item">Type of Item:</label>
                        <select type="text" id="type_of_item" name="type_of_item" required>
                        <option value="" selected hidden disabled>Select</option>
                        <option value="Books">Book</option>
                        <option value="Cycles">Cycle</option>
                        <option value="Earphones">Earphones</option>
                        <option value="Ed_kit">Ed-kit</option>
                        <option value="Headphones">Headphones</option>
                        <option value="Laptops">Laptop</option>
                        <option value="Mobiles">Mobile</option>
                        <option value="Speakers">Speaker</option>
                        <option value="others">Other</option>                    
                        </select><br>
                        <label for="file">Item Photo</label>
                        <input type="file" id="file" name="file" required ><br>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <h3 style="text-align:center;">Seller-Details</h3>
                    <div class="sell">
                        <label for="sellername">Name of the seller:</label>
                        <input type="text" id="sellername" name="sellername" placeholder="Your Name" required><br><br>
                        <label for="mobilenumber">Phone Number 1:</label>
                        <input type="tel" id="mobilenumber" name="mobilenumber" placeholder="Your Mobile number" required><br><br>
                        <label for="altnumber">Phone Number 2:(optional)</label>
                        <input type="tel" id="altnumber" name="altnumber" placeholder="Alternate Number"><br><br>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Your Address" required><br>
                    </div>
                </div>
           </div>
            <div class="row">
                  <div class="col-lg-4"></div>
                    <div class="submit col-lg-4">
                        <input type="submit" value="submit" name="submit"><br>
                    </div>
            </div>
        </form>
        </div>
<?php include('inc/footer.php');?>
