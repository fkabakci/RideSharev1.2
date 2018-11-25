<?php
include("navigationbar.php");

        $userId = $_SESSION['login_user_id'];       
        $row_user = RideShareDb::select("select * from carpool_user where id = $userId");
        $row_driver = RideShareDb::select("select * from driver where user_id = $userId");
?>


<!DOCTYPE html>
<html>
    
    <title>Share your ride</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/user_edit.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        <?php include("./css/skin.css") ?>
    </style>
    <body>
        <h3>~ User Information ~</h3><hr>
        <p>Photo: <img src="<?php echo $row_driver['photo']?>" alt="driver" style="margin-left:7em"></p>
            <table>
                <tr><td>Name:</td>
                    <td id="user_edit_name"><?php echo $row_user['name']?></td>
                    <td><input id="user_edit_name2" type="text" hidden></td>
                </tr>
                <tr><td>E-mail:</td>
                    <td id="user_edit_email"><?php echo $row_user['email']?></td>
                    <td><input id="user_edit_email2" type="text" hidden></td>
                </tr>
                <tr>
                    <td>Password:</td><td id="user_edit_password">*******</td>
                    <td><input id="user_edit_password2" type="text" hidden></td>
                </tr>
                <tr>
                    <td>Phone:</td><td id="user_edit_phone"><?php echo $row_user['phone']?></td>
                    <td><input id="user_edit_phone2" type="text" hidden></td>
                </tr>
                <tr>
                    <td><input id="user_edit_edit" value="Edit" type="button" style="width: 150px"></td>
                    <td><input id="user_edit_reset" value="Reset" type="button" style="width: 150px" hidden></td>
                </tr>
            </table>
        <h3>~ Vehicle Information ~</h3><hr>
        <p>Photo: <img src="images/vehicles/1_bmw.JPG" alt="driver" style="margin-left:7em"></p>
        
        <!-- Second Parallax Image with Portfolio Text -->
        <div >
            <div class="w3-display-middle">
            </div>
        </div>

        <!-- Container (Portfolio Section) -->
        <div class="w3-content w3-container w3-padding-64" id="portfolio">
            <p class="w3-center"><em></em></p>

            <!-- Responsive Grid. Four columns on tablets, laptops and desktops. Will stack on mobile devices/small screens (100% width) -->
            <div class="w3-row-padding w3-center">
                <div class="w3-col m3">
                    
                </div>
            </div>

            <div class="w3-row-padding w3-center w3-section">
                <div class="w3-col m3">
                </div>
            </div>
        </div>

        
        <?php include("footer.php") ?>
        
    </body>
</html>