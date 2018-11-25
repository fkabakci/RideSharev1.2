<?php include "db/RideShareDb.php";
session_start();

$register = filter_input(INPUT_POST, 'register');
$user_id = $_SESSION['login_user_id'];

$vehicle_photo_path = "images/vehicles/$user_id";
if(!empty($_FILES['vehicle_photo']))
  {
    $path = "images/vehicles/" . basename($_FILES['vehicle_photo']['name']);
    $vehicle_photo_path = $vehicle_photo_path. "_vehicle.jpg"; //.$_FILES['vehicle_photo']['name'];
    
    if(move_uploaded_file($_FILES['vehicle_photo']['tmp_name'], $path)) {
      rename($path, $vehicle_photo_path);
    }
  }

$driver_photo_path = "images/drivers/$user_id";
if(!empty($_FILES['driver_photo']))
  {
    $path = "images/drivers/" . basename($_FILES['driver_photo']['name']);
    $driver_photo_path = $driver_photo_path. "_driver.jpg" ;//.$_FILES['driver_photo']['name'];
    
    if(move_uploaded_file($_FILES['driver_photo']['tmp_name'], $path)) {
      rename($path, $driver_photo_path);
    }
  }

$driverlicense = filter_input(INPUT_POST, 'driverlicense');
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$dob_day = filter_input(INPUT_POST, 'dob_day');
$dob_month = filter_input(INPUT_POST, 'dob_month');
$dob_year = filter_input(INPUT_POST, 'dob_year');
$gender = filter_input(INPUT_POST, 'gender');
$address = filter_input(INPUT_POST, 'address');
$select_city = filter_input(INPUT_POST, 'select_city');
$zip = filter_input(INPUT_POST, 'zip');
$cardnumber = filter_input(INPUT_POST, 'cardnumber');
$namecard = filter_input(INPUT_POST, 'namecard');
$expdate = filter_input(INPUT_POST, 'expdate');
$cvc = filter_input(INPUT_POST, 'cvc');
$vehicle_model = filter_input(INPUT_POST, 'vehicle_model');
$year = filter_input(INPUT_POST, 'year');
$color = filter_input(INPUT_POST, 'color');
$vin = filter_input(INPUT_POST, 'vin');
$license = filter_input(INPUT_POST, 'license');
$max_capacity = filter_input(INPUT_POST, 'max_capacity');
$carseat = filter_input(INPUT_POST, 'carseat');

switch($register) {
            case 'Submit':                               
                // ADD ROW INTO DRIVER TABLE
                $date = $dob_year. "-". $dob_month. "-". $dob_day;
                $date = date("Y-m-d", strtotime($date));
                
                $query = "INSERT INTO driver (user_id, driver_license, firstname, lastname, address, city_id, 
                zipcode, photo, date_of_birth, review, gender_id) 
                VALUES ($user_id, '$driverlicense', '$firstname', '$lastname', '$address', $select_city, "
                ." $zip, '$driver_photo_path', CAST('". $date ."' AS DATE), 5.0, $gender)";              
                RideShareDb::insert($query);
                
                // GET NEW DRIVER ID
                $row = RideShareDb::select("SELECT id FROM driver WHERE user_id = '$user_id' ");
                $driver_id = $row['id'];
                
                // ADD ROW INTO DRIVER_LANGUAGE TABLE
                foreach($_POST['languages'] as $lang) {
                    $query = "INSERT INTO driver_language (driver_id, language_id) 
                    VALUES ($driver_id, $lang)";
                    RideShareDb::insert($query);
                }
                
                // ADD ROW INTO USER BANK TABLE
                $query = "INSERT INTO user_bank (user_id, card_number, name, expiration, cvc) VALUES ($user_id, $cardnumber, '$namecard', $expdate, $cvc)";
                RideShareDb::insert($query);
                
                // ADD ROW INTO VEHICLE TABLE
                $query = "INSERT INTO vehicle (driver_id, VIN, license_plate, model_id, color_id, year, photo, "
                . "max_seats, babysit) VALUES ($driver_id, '$vin', '$license', $vehicle_model, $color, $year, '$vehicle_photo_path', $max_capacity, $carseat)";
                RideShareDb::insert($query);
                
                header('Location: index.php');
            break;
            }