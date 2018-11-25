<?php
include "db/RideShareDb.php";

        setcookie("user_type", 'u', 0, "/","", 0);
        
        session_start();
        $userId = $_SESSION['login_user_id'];
        $row_driver = RideShareDb::select("select * from driver where user_id = $userId");
        $row_rider = RideShareDb::select("select * from rider where user_id = $userId");
        
        if(isset($row_driver['id'])) {
            setcookie("user_type", 'd', 0, "/","", 0);
            Header("Location: driver_account.php");
        }else if(isset($row_rider['id'])) {
            setcookie("user_type", 'r', 0, "/","", 0);
            Header("Location: rider_account.php");
        }else {
            Header("Location: become_member.php");
        }

        
        