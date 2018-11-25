<?php
include("navigationbar.php");

        $userId = $_SESSION['login_user_id'];       
        $row_user = RideShareDb::select("select * from carpool_user where id = $userId");
        $row_rider = RideShareDb::select("select * from rider where user_id = $userId");
?>

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
    <h3>~ User Information ~</h3><hr>
        <p>Photo: <img src="<?php echo $row_rider['photo']?>" alt="driver" style="margin-left:7em"></p>
            <table>
                <tr><td>Name:</td>
                    <td id="user_edit_name"><?php echo $row_user['name']?></td>
                    <td><input id="user_edit_name2" type="text" hidden></td>
                </tr>
                <tr><td>E-mail:</td>
                    <td id="user_edit_email"><?php echo $row_user['email']?></td>
                    <td><input id="user_edit_email2" type="text" hidden></td>
                </tr>
                <tr>
                    <td>Password:</td><td id="user_edit_password">*******</td>
                    <td><input id="user_edit_password2" type="text" hidden></td>
                </tr>
                <tr>
                    <td>Phone:</td><td id="user_edit_phone"><?php echo $row_user['phone']?></td>
                    <td><input id="user_edit_phone2" type="text" hidden></td>
                </tr>
                <tr>
                    <td><input id="user_edit_edit" value="Edit" type="button" style="width: 150px"></td>
                    <td><input id="user_edit_reset" value="Reset" type="button" style="width: 150px" hidden></td>
                </tr>
            </table>
  <h1> </h1>
  <p>Please Choose your preferences by choosing option below</p>
   <div class="w3-container">
            <div class="w3-container">
                <form action="controller.php" action="POST">
                    <fieldset>
                        <legend><h2>Personal Preference:</h2></legend>
                         <label>Car Type :<span>*</span></label><br>
                        <input type="radio" name="cartype" value="Luxry "checked> Luxry<br>
                        <input type="radio" name="cartype" value="Economy"> Economy<br>
                        <input type="radio" name="cartype" value="No Preference"> No Preference<br>
                         <label>Child Carseat Equipped :<span>*</span></label><br>
                        <input type="radio" name="carseat" value="yes" checked> Yes<br>
                        <input type="radio" name="carseat" value="no"> No<br>
                         <label>Language Preference :<span>*</span></label><br>
                        <input type="radio" name="Language" value="yes" checked> Spanish<br>
                        <input type="radio" name="Language" value="no"> Chiness<br>
                        <input type="radio" name="Language" value="no"> Arabic<br>
                        <input type="radio" name="Language" value="no"> Telugu<br>
                        <input type="radio" name="Language" value="no"> Hindi<br>
                        <input type="radio" name="Language" value="no"> Tagolog<br>
                        <input type="radio" name="Language" value="no"> No Preference<br>
                        <button class="button1" style="margin-top:64px;width:225px;height:50px;">Submit</button>&nbsp;&nbsp;
                    <button class="button1" type="reset" style="margin-top:64px;width:225px;height:50px;">Reset</button>
</div>
</div>
 
</body>
</html>