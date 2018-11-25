<?php include "db/RideShareDb.php";

session_start();

$register = filter_input(INPUT_POST, 'register');
$user_id = $_SESSION['login_user_id'];

$rider_photo_path = "images/riders/$user_id";
if(!empty($_FILES['rider_photo']))
  {
    $path = "images/riders/" . basename($_FILES['rider_photo']['name']);
    $rider_photo_path = $rider_photo_path. "_rider.jpg";// .$_FILES['rider_photo']['name'];
    
    if(move_uploaded_file($_FILES['rider_photo']['tmp_name'], $path)) {
      rename($path, $rider_photo_path);
    }
  }

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

switch($register) {
            case 'Submit':                               
                // ADD ROW INTO RIDER TABLE
                $date = $dob_year. "-". $dob_month. "-". $dob_day;
                $date = date("Y-m-d", strtotime($date));
                
                $query = "INSERT INTO rider (user_id, firstname, lastname, address, city_id, 
                zipcode, photo, date_of_birth, gender_id) 
                VALUES ($user_id, '$firstname', '$lastname', '$address', $select_city, "
                ." $zip, '$rider_photo_path', CAST('". $date ."' AS DATE), $gender)";              
                RideShareDb::insert($query);

                // ADD ROW INTO USER BANK TABLE
                $query = "INSERT INTO user_bank (user_id, card_number, name, expiration, cvc) VALUES ($user_id, $cardnumber, '$namecard', $expdate, $cvc)";
                RideShareDb::insert($query);
 
                header('Location: index.php');
            break;
            }
