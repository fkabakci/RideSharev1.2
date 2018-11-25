<?php
include "db/RideShareDb.php";

        $action = filter_input(INPUT_POST, 'sign_in');
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        
        switch($action) {
            case 'Sign In':
                try {
                $row = RideShareDb::select("SELECT id FROM carpool_user WHERE name = '$username' AND password = '$password' ");
             
                if($row['id'] == NULL) {
                    header("Location: get_started.php");
                }else {
                    session_start();
                    // Store Session Data
                    $_SESSION['login_user_id']= $row['id'];  // Initializing Session with value of PHP Variable
                    header("Location: account.php");
                }               
              } catch (PDOException $ex) {
              }                    
            break;
            default:
                header("Location: get_started.php");
        }
