<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
       <?php include("./css/skin.css") ?>
    </style>
<style>
* {
    box-sizing: border-box;
}
.row::after {
    content: "";
    clear: both;
    display: table;
}
[class*="col-"] {
    float: left;
    padding: 15px;
}
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}
html {
    font-family: "Lucida Sans", sans-serif;
}
.header {
    background-color: gray;
    color: #ffffff;
    
    
}
.menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.menu li {
    padding: 8px;
    margin-bottom: 7px;
    background-color: black;
    color: #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.menu li:hover {
    background-color: red;
}
</style>
</head>
<body>
<?php include("navigationbar.php") ?>

<div class="header">
  <h1>Rider Account</h1>
</div>

<div class="row">

<div class="col-3 menu">
  <ul>
        <li><a href="user_navigate.php">My Account</a></li>
        <li><a href="">Travel History</a></li>
        <li><a href="index.php">Schedule Future Ride</a></li>
        <li><a href="FAQ.php">FAQ</a></li>
  </ul>
</div>

<div class="col-9">
  <h1>FAQ </h1>
  
   <div class="w3-container">
            <div class="w3-container">
                
                <h1>My Trip History</h1>
                <?php 
                
                $userId = $_SESSION['login_user_id'];       
        
                $row_rider = RideShareDb::select("select * from rider where user_id = $userId");
                
                $rider_id = $row_rider['id'];
                
                $row = RideShareDb::select("select * from trip where rider_id = $rider_id");
                
                $driver_id = $row['driver_id'];
                
                $row_driver = RideShareDb::select("select * from driver where id = $driver_id");
                
                $driverName = $row_driver['firstname']. " ". $row_driver['lastname'];
                $tfrom = $row['tfrom'];
                $tto = $row['tto'];
                $ttime1 = $row['ttime1'];
                $ttime2 = $row['ttime2'];
                $tdate = $row['tdate'];
                $tmile = $row['tmile'];
                $tduration = $row['tduration'];
                $tcost = $row['tcost'];
                
                $row_vehicle = RideShareDb::select("select * from vehicle where driver_id = $driver_id");
                
                $model_id = $row_vehicle['model_id'];
                $licensePlate = $row_vehicle['license_plate'];
                
                $row_model = RideShareDb::select("select * from vehicle_model where id = $model_id");
                
                $vehicle = $row_model['description'];
                
                
                ?>
                
                <ol>
                    <li>
                        
                        <?php 
                            
                            echo "<div style=\"font-weight: bold; \">";
                            echo "<h3>Trip Info:</h3>";
                            echo "Direction:". $tfrom. " to ". $tto. " at ". $tdate. " ".$ttime1 ."<br>";                           
                            echo "Mile:". $tmile. " miles <br>";
                            echo "Duration:". $tduration. " min <br>";
                            echo "Cost:$". $tcost. " <br>";
                            echo "<h3>Driver Info</h3>";
                            echo "Driver:". $driverName. "<br>";
                            echo "<h3>Vehicle Info</h3>";
                            echo "Vehicle:". $vehicle. "<br>";
                            echo "License Plate:". $licensePlate. "<br>";
                            echo "</div>";
                            
                             
                        
                        ?>
                        
                        
                    </li>
                </ol>
                    
</div>

</div>
 
</body>
</html>


