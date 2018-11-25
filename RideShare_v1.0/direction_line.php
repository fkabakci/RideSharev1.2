<?php
include "db/RideShareDb.php";
include "google/DistanceMatrix.php";
include "google/LatLong.php";
include "trip/Trip.php";
include "helper/Sorter.php";

session_start();

$action = filter_input(INPUT_POST, 'action');
$action_get = filter_input(INPUT_GET, 'action');
$user_id = $_SESSION['login_user_id'];
$row_driver = RideShareDb::select("select * from driver where user_id = $user_id");
$row_rider = RideShareDb::select("select * from rider where user_id = $user_id");

switch($action) {
            case 'Submit':
                if(isset($row_driver['id'])) {
                    $from = urldecode(filter_input(INPUT_POST, 'from'));
                    $to = urldecode(filter_input(INPUT_POST, 'to'));
                    $date = urldecode(filter_input(INPUT_POST, 'date'));
                    $time1 = urldecode(filter_input(INPUT_POST, 'time1'));
                    $time2 = urldecode(filter_input(INPUT_POST, 'time2'));
                    
                    $driver_id = $row_driver['id'];

                    $trip = Trip::getDistance($from, $to);

                    $distance = $trip['distance']; // trim($trip['distance'], ' mi');
                    $duration = $trip['time']; // trim($trip['time'], ' mins');

                    $row = RideShareDb::select("SELECT model_id FROM vehicle WHERE driver_id = ". $driver_id);
                    $model_id = $row['model_id'];
                    $row = RideShareDb::select("SELECT mpg FROM vehicle_model WHERE id = ". $model_id);
                    $mpg = $row['mpg'];

                    $cost = round(($distance / $mpg) * 5.50, 2);

                    $query = "INSERT INTO trip_offer (driver_id, tfrom, tto, ttime1, ttime2, tdate, tmile, tduration, tcost) 
                    VALUES ($driver_id, '$from', '$to', '$time1', '$time2', CAST('". $date ."' AS DATE), $distance, $duration, $cost)";

                    RideShareDb::insert($query);
                    
                    $title = "Your trip has been scheduled !";                   
                    $content = "You will earn $". $cost. " in about ". round($duration, 2) ." mins for this trip !";
                }
            break;
    }
    
switch($action_get) {
            case 'Submit':
                if(isset($row_rider['id'])) {
                    
                    $from = urldecode(filter_input(INPUT_GET, 'from'));
                    $to = urldecode(filter_input(INPUT_GET, 'to'));
                    $date = urldecode(filter_input(INPUT_GET, 'date'));
                    $time1 = urldecode(filter_input(INPUT_GET, 'time1'));
                    $time2 = urldecode(filter_input(INPUT_GET, 'time2'));
                    
                    $rider_id = $row_rider['id'];
                    
                    $query = "SELECT * FROM trip_offer";
                    $select = RideShareDb::selectRows($query);
                    $matchedTrips = array();
                    
                    while($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        $tripId = $row['id'];
                        $driverId = $row['driver_id'];
                        $driverFrom = $row['tfrom'];
                        $driverTo = $row['tto'];
                        $driverTime1 = $row['ttime1'];
                        $driverTime2 = $row['ttime2'];
                        $driverDate = $row['tdate'];
                        $driverMile = $row['tmile'];
                        $driverDuration = $row['tduration'];
                        $driverCost = $row['tcost'];
                        
                      //  $objTrip = new Trip($tripId, $driverId, $driverFrom, $driverTo, $driverTime1, $driverTime2, $driverDate, $driverMile, $driverDuration, $driverCost);

                        // pickup rider
                        $tripPickupForRider = Trip::getDistance($driverFrom, $from);                     
                        $tripDistanceForPickup = $tripPickupForRider['distance']; // trim($tripPickupForRider['distance'], ' mi');
                        $tripTimeForPickup = $tripPickupForRider['time']; // trim($tripPickupForRider['time'], ' mins');
                        
                        // ride share and drop rider off
                        $tripDropForRider = Trip::getDistance($from, $to);
                        $tripDistanceForDrop = $tripDropForRider['distance']; // trim($tripDropForRider['distance'], ' mi');
                        $tripTimeForDrop = $tripDropForRider['time']; // trim($tripDropForRider['time'], ' mins');
                        
                        // rest of trip for driver himself for his final destination
                        $tripForDriver = Trip::getDistance($to, $driverTo);
                        $tripDistanceForDriver = $tripForDriver['distance']; // trim($tripForDriver['distance'], ' mi');
                        $tripTimeForDriver = $tripForDriver['time']; // trim($tripForDriver['time'], ' mins');
                        
                        $totalTripDistance = $tripDistanceForPickup + $tripDistanceForDrop + $tripDistanceForDriver;
                        $totalTripTime = $tripTimeForPickup + $tripTimeForDrop;
 
                        if($totalTripDistance - $driverMile < 5) {
                            
                            $matchedTrips[] = new Trip($tripId, $driverId, $driverFrom, $driverTo, $driverTime1, $driverTime2, 
                                $driverDate, $driverMile, $totalTripTime, $driverCost, Trip::getDistance($driverFrom, $from));

                            $matchedTrips = Sorter::insertionSort($matchedTrips);
                            
                            $matchedTripArray[] = $tripId;
                            $matchedDriverArray[] = $driverId;
                        }
                    }
                }
            break;
    }

?>

<html>
    <title>Rides</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        <?php include("./css/skin.css") ?>
    </style>
    <style>
        .button {
        display: table-cell;
        width: 100%;       /* set to 100% */
        height: 100%;      /* set to 100% */
        margin-bottom: 0.5em;
        padding-top: .6em;
        padding-bottom: .6em;
        color: #fff;
        background-color: #aaabbb;
        border-radius: 5px;
        border: solid #cccccc 1px;
        box-shadow: 2px 2px 1px #888888;
        clear:right;
        float:right;   
            
    }
    </style>
    <style>
      .dir {
          height: 50%;
          width: 50%;
      }
  </style>
    <body>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnzR-kc9lTpfzedJwcGlC--QGDqe7EIng"></script>
        <script>
                <?php
                    if(!isset($matchedTripArray)) {
                        echo 'document.getElementById("trip_list").style.visibility = "hidden"';
                    }
                ?>              
        </script>
        <?php include("navigationbar.php") ?>

        <!-- Second Parallax Image with Portfolio Text -->
        <div >
            <div class="w3-display-middle">
            </div>
        </div>

        <!-- Container (Portfolio Section) -->
        <div class="w3-content w3-container w3-padding-64" id="portfolio">
            <h3 class="w3-center"><?php if(isset($title)) { echo $title; } ?></h3>
            <p class="w3-center">
                <em><?php if(isset($content)) { echo $content; } ?></em>
            <center>
                <div id="map" class="dir"></div><br>

                <div id="trip_list" style = "float:left;">
                    <form action="trip_success.php" method="post">
                    <table style = "border: 3px solid black; width: 100%; ">                       
                        <?php
                            if(isset($matchedTrips)) {
                                echo "<input name=\"rider_id\" type=\"hidden\" value=\"$rider_id\">";
                                echo "<input name=\"from\" type=\"hidden\" value=\"$from\">";
                                echo "<input name=\"to\" type=\"hidden\" value=\"$to\">";
                                echo "<input name=\"time1\" type=\"hidden\" value=\"$time1\">";
                                echo "<input name=\"time2\" type=\"hidden\" value=\"$time2\">";
                                echo "<input name=\"date\" type=\"hidden\" value=\"$date\">";
                                for($i = 0; $i < count($matchedTrips); $i++) {
                                    $matchedTrip = $matchedTrips[$i];
                                    echo "<th>Send Request</th>";
                                    echo "<th>Driver</th>";
                                    echo "<th>Languages</th>";
                                    echo "<th>Rating</th>";
                                    echo "<th>Direction</th>";
                                    /*echo "<th>Time</th>";
                                    echo "<th>Date</th>";*/                                   
                                    echo "<th>Cost</th>";
                                    echo "<th>Duration</th>";
                                    echo "<th>Miles Away</th>";
                                    echo "<th>Vehicle</th>";
                                    echo "<tr>";

                                        echo "<td>";                                     
                                            echo "<input class=\"button\" name=\"req.$matchedTrip->id\" type=\"submit\" value=\"Request\">";
                                        echo "</td>";
                                            $row = RideShareDb::select("SELECT user_id, firstname, lastname, review FROM driver WHERE id = ".$matchedTrip->driverId);
                                            $driverUserId = $row['user_id'];
                                            $driverFirstName = $row['firstname'];
                                            $driverLastName = $row['lastname'];
                                            $driverReview = $row['review'];
                                            $select = RideShareDb::selectRows("SELECT language_id FROM driver_language WHERE driver_id = ".$matchedTrip->driverId);
                                            $languageIds = array();
                                            while($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                                $languageIds[] = $row['language_id'];
                                            }
                                            $languageNames = array();
                                            foreach($languageIds as $languageId) {
                                                $row = RideShareDb::select("SELECT * FROM language WHERE id = ".$languageId);
                                                $languageNames[] = $row['lang'];
                                            }
                                            $row = RideShareDb::select("SELECT * FROM vehicle WHERE driver_id = ".$matchedTrip->driverId);
                                            $driverLicensePlate = $row['license_plate'];
                                            $driverVehicleYear = $row['year'];
                                            $model_id = $row['model_id'];
                                            $color_id = $row['color_id'];
                                            $row_model = RideShareDb::select("SELECT description FROM vehicle_model WHERE id = ".$model_id);
                                            $driverVehicleModel = $row_model['description'];
                                            $row_color = RideShareDb::select("SELECT color FROM color WHERE id = ".$color_id);
                                            $driverVehicleColor = $row_color['color'];    
                                        echo "<td>";
                                            echo "<img src=\"images/drivers/".$driverUserId."_driver.jpg\" alt=\"\"/>"."<br><b>$driverFirstName - $driverLastName</b>";
                                        echo "</td>";
                                        
                                        echo "<td>";
                                            echo "<ol>";
                                                foreach($languageNames as $lang) {
                                                    echo "<li>". $lang. "</li><br>";
                                                }
                                            echo "</ol>";
                                        echo "</td>";
                                        
                                        echo "<td>";
                                            echo $driverReview;
                                        echo "</td>";                                      
                                
                                        $tripDirectionFrom = substr($matchedTrip->from, 0, strrpos($matchedTrip->from, ", CA, USA"));
                                        $tripDirectionTo = substr($matchedTrip->to, 0, strrpos($matchedTrip->to, ", CA, USA"));
                                        echo "<td>";
                                               echo $tripDirectionFrom . " -> ". $tripDirectionTo;
                                        echo "</td>";
                                        
                                      /*  echo "<td>";
                                               echo $matchedTrip->time1 . " - ". $matchedTrip->time2;
                                        echo "</td>";
                                        
                                        echo "<td>";
                                               echo $matchedTrip->date;
                                        echo "</td>";*/

                                        echo "<td>";
                                               echo "$". $matchedTrip->cost;
                                        echo "</td>";
                                        
                                        echo "<td>";
                                               echo round($matchedTrip->duration, 2). " min";
                                        echo "</td>";
                                        
                                        $milesAway = Trip::getDistance($matchedTrip->from, $from);     
                                        echo "<td>";
                                               echo round($milesAway['distance'], 2) . " miles";
                                        echo "</td>";
                                        
                                        echo "<td>";
                                            echo "<img src=\"images/vehicles/".$driverUserId."_vehicle.jpg\" alt=\"\"/>"."<br><b>$driverVehicleModel</b>";
                                        echo "</td>";
                                        
                                   echo "</tr>";
                                }
                            }
                        ?>             
                 </table>
              </form>
            </div>    
            </center>
    <script>
        window.onload = function(){
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 7,
              center: {lat: 41.85, lng: -87.65}
            });
            directionsDisplay.setMap(map);

            directionsService.route({
            origin: '<?php echo $from?>',
            destination: '<?php echo $to?>',
            travelMode: 'DRIVING'
          }, function(response, status) {
            if (status === 'OK') {
              directionsDisplay.setDirections(response);
            }
            });
        }
    </script>
            
            

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
