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
        <li><a href="trip_history.php">Travel History</a></li>
        <li><a href="index.php">Schedule Future Ride</a></li>
        <li><a href="FAQ.php">FAQ</a></li>
  </ul>
</div>

<div class="col-9">
  <h1>FAQ </h1>
  
   <div class="w3-container">
            <div class="w3-container">
                

<h3>What if there are multiple stops and the rider changes the destination?</h3>
<h5>Trip fares are determined in part by the actual time and distance traveled. If riders ask you to make a stop before arriving at their final destination, let the trip continue. When a stop is made during a trip, the time you wait is added to the fare. Additional distance traveled to locations on or off the trip route is added to the fare. Swipe "End Trip" only after riders have exited your vehicle at their final destination.</h5>  
<h3>How am I paid if there are multiple stops?</h3>
<h5>A trip fare is determined by the route's total time and distance. When a stop is made during a trip, this waiting time is included in the fare. Any distance traveled to additional stops prior to the rider's final destination will also be included. </h5> 
<h3>When is it appropriate to call the rider?</h3>
<h5>It's good practice to limit contacting riders to times when you:
- have waited more than one minute at their pickup location
- are having trouble finding or arriving at the pickup location
- are unable to locate the rider</h5>
<h3>What if I need to cancel a trip?</h3>
<h5>Riders depend on reliable pickups. If you are unable to meet a rider or complete a trip, use your account to cancel: 

1. Tap the menu icon in the top corner to view your current trip. 
2. Tap CANCEL. 
3. Your app will prompt you to select the reason why you needed to cancel</h5>
<h3>Can I accept cash tips?</h3>
<h5>Our Website does not ask or expect riders to tip. In most cities, when you arrive at a rider's destination and end the trip, the fare is automatically charged to the rider's account. Tips and gratuities are not included in trip fares. Any cash gratuity offered by a rider is voluntary. If a rider wishes to tip you, please feel free to accept.</h5>
<h3>What if I forget to start the trip?</h3>
<h5>A trip's fare is calculated from the moment you swipe START TRIP until you swipe COMPLETE TRIP.If you feel that this trip's start or end time is incorrect, please let us know the correct pickup location and destination addresses. We'll review and make adjustments as needed. </h5>
<h3>How long should I wait for a rider?</h3>
<h5>A great pickup starts when you receive the ride request. Note the pickup location address and location of the rider's icon on the map. This icon is typically the best indicator of where the rider will actually be.</h5>

<h3>What if a rider leaves something in my car?</h3>
<h5>If you notice an item left behind, please let us know by sharing details and a photo here. </h5>
<h3>What should I do if a rider makes a mess in the car?</h3>

<h5>We hope and expect that riders treat your vehicle with care and respect. If an incident involving a rider resulted in damage to your vehicle beyond normal wear and tear, please let us know here.To report a mess that requires professional cleaning and not repair, select I want to request a cleaning fee.</h5> 

<h3>What should I do if the phone or app crashes in the middle of a trip?</h3>
<h5>If your app keeps freezing or crashing, try the following in the app: 

FORCE QUIT
1. Double tap the home button
2. Swipe up on the Uber app card 
3. Reopen the app

If you continue to experience issues, you can try to reset your network settings.

RESET NETWORK SETTINGS
Note: This may result in all passwords being deleted.
1. Select Settings > General 
2. Reset > Reset Network Settings </h5>

<h3>How can I be sure I'm picking up the correct rider?</h3>
<h5>Occasionally, the wrong rider may attempt to enter your vehicle by mistake.

To make sure you pick up the right person every time, we recommend confirming your rider's name before starting a trip.</h5> 
                        
                    
</div>

</div>
 
</body>
</html>


