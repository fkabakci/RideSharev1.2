<!DOCTYPE html>
<html>
    <head>  
    <title>Rider Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
<?php include("./css/skin.css") ?>

    </style>
    </head>
    <body style="background-image:url(images/carpool.png);background-repeat:no-repeat;background-size:300px;background-position:60% center;">
        <?php include("navigationbar.php") ?>

        <!-- Second Parallax Image with Portfolio Text -->
        <div >
            <div class="w3-display-middle">
            </div>
        </div>

        <!-- Container (Portfolio Section) -->
        <div class="w3-content w3-container">
            <h1 class="w3-center">Rider Registration</h1>
        </div>
        <div class="w3-container">
            <div class="w3-container">
                <form action="rider_register_process.php" method="post" enctype="multipart/form-data">              
                    <fieldset>
                        <legend><h2>Personal information:</h2></legend>
                        Photo:<br>
                        <input type="file" name="rider_photo"><br>
                        First name:<br>
                        <input type="text" name="firstname" value=""><br>
                        Last name:<br>
                        <input type="text" name="lastname" value=""><br>
                        <div class="control-group">
                            <label for="dob_day" class="control-label">Date of birth</label>
                            <div class="controls">
                           <select name="dob_day">
                               <option value="0">Day</option>
                               <option value="0">----</option>
                             <?php
                                for($i=1; $i<=31; $i++)
                                {
                                    echo "<option value=".$i.">".$i."</option>";
                                }
                                ?> 
                           </select>
                                <select name="dob_month">
                                    <option value="">Month</option>
                                    <option value="">-----</option>
                                    <?php 
                                        $arr = array("January", "February", "March", "April", "May", "June", "July", "August", "September",
                                            "October", "November", "December");                                  
                                            for($i=1; $i<12; $i++)
                                            {
                                                echo "<option value=".$i.">".$arr[$i-1]."</option>";
                                            }
                                            ?> 
                                </select>
                                <select name="dob_year">
                                    <option value="">Year</option>
                                    <option value="">----</option>
                                    <?php 

                                for($i=1950; $i<=2010; $i++)
                                {
                                    echo "<option value=".$i.">".$i."</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div><br>
                        <label>Gender :<span>*</span></label><br>
                        <input type="radio" name="gender" value="1" checked>Male<br>
                        <input type="radio" name="gender" value="2">Female<br><br>
                        <label>Address Line :<span>*</span></label><br>
                        <input name="address" id="address1" type="text" size="30" required><br>
                        <label>City :<span>*</span></label><br>
                        <?php
                        $select = RideShareDb::selectRows("SELECT * from carpooldb.city");                  
                        echo "<select name=\"select_city\">";
                          echo "<option value=\"0\" disabled selected>Choose a city</option>"; // dummy option
                        while($row = $select->fetch(PDO::FETCH_ASSOC)) {                                                                                     
                                echo "<option value=".$row['id'].">" .$row['city']."</option>";                                                                                                                                           
                        }
                        echo "</select><br>";
                        ?>
                        <label>Zip :<span>*</span></label><br>
                        <input name="zip" type="text" size="10" required><br>
                    </fieldset>
                    <fieldset>
                        <legend><h2>Account Information:</h2></legend>
                        <label>Card Number<span>*</span></label><br>
                        <input name="cardnumber" id="address1" type="text" size="30" required><br>
                        <label>Name On Card :</label><br>
                        <input name="namecard" id="address2" type="text" size="50"><br>
                        <label>Expiry date :<span>*</span></label><br>
                        <input name="expdate" id="expirydate" type="text" size="25" required><br>
                        <label>CVC Code :<span>*</span></label><br>
                        <input name="cvc" id="pin" type="text" size="10" required><br>
                    </fieldset>                    
                    <input class="button1" name="register" type="submit" value="Submit" style="margin-top:64px;width:225px;height:50px;">&nbsp;&nbsp;
                    <input class="button1" value="Reset" type="reset" style="margin-top:64px;width:225px;height:50px;">
                </form>
            </div>
        </div><br><br>

            <?php include("footer.php") ?>

    </body>
</html>
