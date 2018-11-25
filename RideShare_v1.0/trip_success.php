<?php
include "db/RideShareDb.php";
include "trip/Trip.php";

function formatTimePart(&$timePart) {
    if($timePart >= 60) {
        $timePart -= 60;
        return 1;
    }
    return 0;
}

function sum_time($time1, $time2) {
    $t1 = explode(":", $time1);
    $t1h = $t1[0];
    $t1m = $t1[1];
    $t1s = $t1[2];   
    $t1m += formatTimePart($t1s);
    $t1h += formatTimePart($t1m);

    $t2 = explode(":", $time2);
    $t2h = $t2[0];
    $t2m = $t2[1];
    $t2s = $t2[2];
    $t2m += formatTimePart($t2s);
    $t2h += formatTimePart($t2m);
    
    $t3s = $t1s + $t2s;
    $t3m = $t1m + $t2m;
    $t3h = $t1h + $t2h;   
    
    $t3m += formatTimePart($t3s);
    $t3h += formatTimePart($t3m);
    
    return $t3h.":".$t3m.":".$t3s;
    
    /*

     $t1 = strtotime($time1);
     $t2 = strtotime($time2); //"00:".str_replace(".", ":", round($time2, 2)));

     $secs = $t2-strtotime("00:00:00");
     $result = date("H:i:s",$t1 + $secs);
   
     return $result;*/
}

function convertToMinute($duration) {   
    $parts = explode(".", round($duration, 2));
    $part1 = $parts[0];
    $part2 = $parts[1];
    
    if($part2 >= 60) {
        $part2 = $part2 - 60;
        $part1 = $part1 + 1;
    }
   
     return "00:".$part1.":".$part2;
}
?>

<?php 
      $rider_id = filter_input(INPUT_POST, 'rider_id');
      $from = filter_input(INPUT_POST, 'from');
      $to = filter_input(INPUT_POST, 'to');
      $date = filter_input(INPUT_POST, 'date');
      $time1 = filter_input(INPUT_POST, 'time1');
      $time2 = filter_input(INPUT_POST, 'time2');
      
      
     $allTripIds = array();
     $select = RideShareDb::selectRows("SELECT * FROM trip_offer");
     while($row = $select->fetch(PDO::FETCH_ASSOC)) {
           $allTripIds[] = $row['id'];
     }
     
     foreach($allTripIds as $tripId) {
        $requestId = filter_input(INPUT_POST, 'req_'.$tripId);
        if(isset($requestId)) {
            $row = RideShareDb::select("SELECT * FROM trip_offer WHERE id = ". $tripId);
            
            $driverFrom = $row['tfrom'];
            $driverTo = $row['tto'];
            $driver_id = $row['driver_id']; 
            $cost = $row['tcost'];
            
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

            $totalTripDistance = $tripDistanceForPickup + $tripDistanceForDrop;
            $totalTripTime = $tripTimeForPickup + $tripTimeForDrop;            
            
            RideShareDb::insert("INSERT INTO trip(driver_id, rider_id, tfrom, tto, ttime1, ttime2, tdate, tmile, tduration, tcost) "
                    . "VALUES($driver_id, $rider_id, '$from', '$to', '$time1', '$time2', CAST('". $date ."' AS DATE), "
                    . "$totalTripDistance, $totalTripTime, $cost)");    
        }
     }
?>

<html>
    <title>Services</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/waypoint.css">
    <style>
        <?php include("./css/skin.css") ?>
    </style>

    <body>

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
          
                <h1>Trip Summary</h1>
                <div>
                <h1>Route:</h1>
                <?php 
                    $time1 = $time1. ":00";
                    $time2 = $time2. ":00";
                    if($tripTimeForPickup == 0) {                     
                        $tripTimeForPickup = "0.10";                     
                    }
                ?>
           
                   <ul>
                       <li>Pick Up: <?php echo substr($driverFrom, 0, strrpos($driverFrom, ", CA, USA")). " to ". 
                                    substr($from, 0, strrpos($from, ", CA, USA")); ?>
                           <br><ul>
                               <li>Estimated Pick Up Time: <?php echo sum_time($time1, convertToMinute($tripTimeForPickup)) ?></li>
                               <li>Distance: <?php echo round($tripDistanceForPickup, 2). " miles"?></li>
                           </ul>   
                       </li>
                       <li>Drop Off: <?php echo substr($from, 0, strrpos($from, ", CA, USA")). " to ". 
                                    substr($to, 0, strrpos($to, ", CA, USA")); ?>
                          <br><ul>
                                 <li>Estimated Drop Off Time: <?php echo sum_time(sum_time($time1, convertToMinute($tripTimeForPickup)), convertToMinute($tripTimeForDrop)) ?></li>
                                 <li>Distance: <?php echo round($tripDistanceForDrop, 2). " miles"?></li>
                              </ul>
                                    
                       </li>
                       <li>Total Cost: $ <?php echo $cost?></li>
                   </ul>
                </div>
                   
                   <div style="float:right; position: fixed; top: 20%; right: 30%">
                        <h1>Driver:</h1>
                           <?php
                           $row = RideShareDb::select("SELECT * FROM driver WHERE id = ". $driver_id);
                           $driverUserId = $row['user_id'];
                           $row_phone = RideShareDb::select("SELECT phone FROM carpool_user WHERE id = ". $driverUserId);
                           $driverPhoneNumber = $row_phone['phone'];
                           $driverPhoto = $row['photo'];
                           $driverFirstName = $row['firstname'];
                           $driverLastName = $row['lastname'];
                           $driverReview = $row['review'];
                           ?>
                           <img src="<?php echo $driverPhoto?>" alt="<?php echo $driverFirstName?>"/><br>                  

                           <?php echo "Name: ". $driverFirstName. " ". $driverLastName. "<br>"?>
                           <?php echo "Review: ";
                            for($i = 0; $i < (int)$driverReview; $i++) {
                                echo "<img src=\"images/shined_star.png\" alt=\"shine\"/>";
                            }
                            for($i = 0; $i < (5 - (int)$driverReview); $i++) {
                                echo "<img src=\"images/faded_star.png\" alt=\"fade\"/>";
                            }
                            echo "<br>Phone Number: ". $driverPhoneNumber. "<br>";
                           ?>
                           <br>
                           <h1>Vehicle:</h1><hr>
                           <?php
                           $row = RideShareDb::select("SELECT * FROM vehicle WHERE driver_id = ". $driver_id);
                           $vehiclePhoto = $row['photo'];
                           $vehicleModelId = $row['model_id'];
                           $vehicleLicensePlate = $row['license_plate'];
                           $row = RideShareDb::select("SELECT description FROM vehicle_model WHERE id = ". $vehicleModelId);
                           $vehicleDescription = $row['description'];
                           ?>
                   
                   <img src="<?php echo $vehiclePhoto?>" alt="<?php echo $vehicleDescription?>"/><br>
                   <?php echo $vehicleDescription. "<br>"?>
                   <?php echo $vehicleLicensePlate. "<br>"?>                   
                </div>
        
                <div id="map" style="width: 50%; height: 50%;"></div>
                <br>

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
        <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);
        calculateAndDisplayRoute(directionsService, directionsDisplay);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];

        waypts.push({location: '<?php echo $from?>', stopover: true});
        directionsService.route({
          origin: '<?php echo $driverFrom?>',
          destination: '<?php echo $to?>',
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);    
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnzR-kc9lTpfzedJwcGlC--QGDqe7EIng&callback=initMap">
    </script>
    </body>
</html>
