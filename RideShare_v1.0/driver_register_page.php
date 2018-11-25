<!DOCTYPE html>
<html>
    <head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>          
            // VEHICLE MAKE AJAX SECTION
            $(document).ready(function(){
            $('#vehicle_vmake').change(function(){
                //Selected value
                var inputValue = $(this).val();
                
                $.ajax({                    
                   type: "post",
                   url: "process_veh_model.php",
                   data: {vmake: inputValue},
                });
                window.location.reload();
            });
});
        
        </script>
        
        
    <title>Driver Register</title>
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
            <h1 class="w3-center">Driver Registration</h1>
        </div>
        <div class="w3-container">
            <div class="w3-container">
                <form action="driver_register_process.php" method="post" enctype="multipart/form-data">
                 <fieldset>
                        <legend><h2>Vehicle Information:</h2></legend>
                        Photo:<br>
                        <input type="file" name="vehicle_photo"><br>
                        <label>Brand :<span>*</span></label><br>
                        <?php
                        $select = RideShareDb::selectRows("SELECT * from carpooldb.vehicle_make");
                        echo "<select id=\"vehicle_vmake\">";
                           echo "<option value=\"0\">Choose a vehicle</option>"; // dummy option
                        while($row = $select->fetch(PDO::FETCH_ASSOC)) {
                            if(isset($_COOKIE['vmake'])) {
                                // keep same data selected in option after reload
                                if($row['id'] == $_COOKIE['vmake']) {
                                    echo "<option value=".$row['id']." selected>" .$row['make']."</option>";
                                }
                            }
                            echo "<option value=".$row['id'].">" .$row['make']."</option>";                                                                                                                                                                         
                        }
                        echo "</select>";
                        ?><br>
                        <label>Model :<span>*</span></label><br>
                        <select id="vehicle_model" name="vehicle_model">
                        <?php
                        if(isset($_COOKIE['vmake'])) {
                            $select = RideShareDb::selectRows("SELECT * from carpooldb.vehicle_model WHERE make_id=". $_COOKIE['vmake']);                         
                               echo "<option value=\"0\">Choose a vehicle</option>"; // dummy option
                            while($row = $select->fetch(PDO::FETCH_ASSOC)) {                                                                                     
                                    echo "<option value=".$row['id'].">" .$row['model']."</option>";                                                                                                                                           
                            }
                        }
                        ?>
                        </select>
                        <br>
                        <label>Year :<span>*</span></label><br>
                        <input name="year" type="text" placeholder="Ex-2014" required><br>
                        <label>Color :<span>*</span></label><br>
                        <?php
                        $select = RideShareDb::selectRows("SELECT * from carpooldb.color"); 
                        echo "<select name=\"color\">";
                           echo "<option value=\"0\">Choose a color</option>"; // dummy option
                        while($row = $select->fetch(PDO::FETCH_ASSOC)) {                                                                                     
                                echo "<option value=".$row['id'].">" .$row['color']."</option>";                                                                                                                                           
                        }
                        echo "</select>". "<br>";
                        ?>
                        <label>VIN :<span>*</span></label><br>
                        <input name="vin" type="text" placeholder="Ex-7657ghfh76" required><br>
                        <label>License Plate :<span>*</span></label><br>
                        <input name="license" type="text" placeholder="WBY657" required><br>
                        <label>Max Capacity :<span>*</span></label><br>
                        <input name="max_capacity" type="text" placeholder="Ex- 4/5/7" ><br><br>
                        <label>Child Carseat Equipped :<span>*</span></label><br>
                        <input type="radio" name="carseat" value="1" checked> Yes<br>
                        <input type="radio" name="carseat" value="0"> No<br>
                    </fieldset>
                    
                    <fieldset>
                        <legend><h2>Personal information:</h2></legend>
                        Photo:<br>
                        <input type="file" name="driver_photo"><br>
                        Driver License:<br>
                        <input type="text" name="driverlicense" required><br>
                        First name:<br>
                        <input type="text" name="firstname" value="" required><br>
                        Last name:<br>
                        <input type="text" name="lastname" value="" required><br>
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
                        <label>Bay Area :<span>*</span></label><br>
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
                        <label>Languages :<span>*</span></label><br>
                        <?php
                        $select = RideShareDb::selectRows("SELECT * from carpooldb.language");
                        while($row = $select->fetch(PDO::FETCH_ASSOC)) {
                            $rowid = $row['id'];
                            $rowval = $row['lang'];
                            echo "<input type=\"checkbox\" name=\"languages[]\" value=\"$rowid\" />".$rowval."&nbsp;";
                        }
                        ?>

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
                        <div class="g-recaptcha" data-sitekey="6Lc_Q00UAAAAAPcJg1ZOoaDMKpxSY87u1-3DzOO_"></div><br>
                    </fieldset>                    
                    <input class="button1" name="register" type="submit" value="Submit" style="margin-top:64px;width:225px;height:50px;">&nbsp;&nbsp;
                    <input class="button1" value="Reset" type="reset" style="margin-top:64px;width:225px;height:50px;">
                </form>
            </div>
        </div><br><br>

            <?php include("footer.php") ?>

    </body>
</html>
