<?php

if (isset($_POST["driverregisterbtn"])) {
    header('Location: driver_register_page.php');
} else if (isset($_POST["driverloginbtn"])) {
    header('Location: driver_login_page.php');
} else if (isset($_POST["riderregisterbtn"])) {
    header('Location: rider_register_page.php');
} else if (isset($_POST["riderloginbtn"])) {
    header('Location: rider_login_page.php');
}
?>


