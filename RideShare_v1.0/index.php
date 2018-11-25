<?php
include "db/RideShareDb.php";

session_start();
$user_id = $_SESSION['login_user_id'];
$row_driver = RideShareDb::select("select * from driver where user_id = $user_id");
?>

<!DOCTYPE html>
<html>
    <title>Share your ride</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/place_finder.css">
    
    <style><?php include("./css/skin.css") ?></style>
    <script type="text/javascript" src="js/place_finder.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnzR-kc9lTpfzedJwcGlC--QGDqe7EIng&libraries=places&callback=initMap" async defer></script>
    <body>
        <?php include("navigationbar.php") ?>
        
        <!-- Second Parallax Image with Portfolio Text -->
        <div >
            <div class="w3-display-middle">
                
            </div>
        </div>

        <!-- Container (Portfolio Section) -->
        <div class="w3-content w3-container w3-padding-64" id="portfolio">
        
            <p class="w3-center"><em></em></p>
                        <h3>Trip Schedule</h3>
                        <form action="direction_line.php" method="<?php if(isset($row_driver['id'])) { echo "post"; } else { echo "get"; } ?>">
                        <table>
                            <tr>
                                <td>From:</td>
                                <td><input id="pac-from" name="from" class="controls" type="text" placeholder="Enter a location" value="<?php if(isset($_POST['tfrom'])) { echo $_POST['tfrom']; } ?>"></td>
                            </tr>
                            <tr>
                                <td>To:</td>
                                <td><input id="pac-to" name="to" class="controls" type="text" placeholder="Enter a location" value="<?php if(isset($_POST['tto'])) { echo $_POST['tto']; } ?>"></td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td style="padding-left:1.25em"><input id="tdate" type="date" name="date"></td>
                            </tr>
                            <tr>
                                <td>Time:</td>
                                <td style="padding-left:1.25em"><input type="time" name="time1"> - <input type="time" name="time2"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input name="action" type="submit" value="Submit" style="margin-top: 1.25em"></td>                   
                            </tr>
                        </table>
                      </form>
                        <div id="map"></div>

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
