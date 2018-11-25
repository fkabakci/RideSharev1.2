<!DOCTYPE html>
<html>
    <title>About Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
<?php include("./css/skin.css") ?>
    </style>
    <body>

        <?php include("navigationbar.php") ?>

        <!-- Container (About Section) -->
        <div class="w3-content w3-container w3-padding-64" id="about">
            <h3 class="w3-center">ABOUT US</h3>
            <p class="w3-center"><em>RideShare is a carpooling app.</em></p>
            <p>
                This website is devloped for our Capstone Project titled 'RideShare' using PHP and MySQL. 
                Nothing can beat real people working together. Imagine millions of drivers out on the roads, 
                working together towards a common goal: to outsmart traffic and get everyone the best routes 
                to their destinations, every day.
            </p>
            <div class="w3-row">
                <div class="w3-col m6 w3-center w3-padding-large">
                    <p><b><i class="fa fa-user w3-margin-right"></i>RideShare ©</b></p><br>
                    <img src="images/about.png" class="w3-round w3-image w3-opacity w3-hover-opacity-off" alt="RideShare Logo" width="300" height="150">
                </div>

                <!-- Hide this text on small devices -->
                <div class="w3-col m6 w3-hide-small w3-padding-large">
                    <p>
                        <b>Team Members:</b><br/>
                    <ul style="list-style-type:circle">
                        <li>Manishaa</li>
                        <li>Supriya</li>
                        <li>Fatih</li>
                    </ul>
                    </p>
                    <p>
                        <b>Advisor:</b><br/>
                    <ul style="list-style-type:circle">
                        <li>Prof A. Banafa</li>
                    </ul>
                    </p>
                </div>
            </div>

            <div class="w3-light-grey">
            </div>
        </div>

        <?php include("footer.php") ?>

    </body>
</html>
