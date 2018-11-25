<?php include_once "db/RideShareDb.php";

    if(!isset($_SESSION)) {
       session_start(); 
    }

    if(!isset($_SESSION['login_user_id'])) {
        header("Location: get_started.php");
    }else {
        $userId = $_SESSION['login_user_id'];
        $row = RideShareDb::select("SELECT name FROM carpool_user WHERE id = '$userId'");
        $userName = $row['name'];
    }
    
    
?>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar" id="myNavbar">
        <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
            <i class="fa fa-bars"></i>
        </a>
        <a href="index.php" class="w3-bar-item w3-button">HOME</a>
        <a href="services.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-th"></i> SERVICES</a>
        <a href="about.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> ABOUT</a>
        <a href="contact.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> CONTACT</a>
        <a href="sign_out.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">Sign Out</a>
        <a href="user_navigate.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"><b>Welcome <?php echo $userName?></b></a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">
            <i class="fa fa-search"></i>
        </a>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
        <a href="services.php" class="w3-bar-item w3-button" onclick="toggleFunction()">SERVICES</a>
        <a href="about.php" class="w3-bar-item w3-button" onclick="toggleFunction()">ABOUT</a>
        <a href="contact.php" class="w3-bar-item w3-button" onclick="toggleFunction()">CONTACT</a>
        <a href="#" class="w3-bar-item w3-button">SEARCH</a>
    </div>
</div>

<div class="w3-center" style="white-space: nowrap">
    <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">RideShare <span class="w3-hide-small"></span> ©</span>
</div>
