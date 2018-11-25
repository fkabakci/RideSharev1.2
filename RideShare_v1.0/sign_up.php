<?php

        $action = filter_input(INPUT_POST, 'signup');
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $phone = filter_input(INPUT_POST, 'phone');
        
        switch($action) {
            case 'Sign Up':
                    // Our database object                   
              try {
                $dsn = 'mysql:host=localhost;dbname=carpooldb';
                $dbusername = 'root';
                $dbpassword = '1234';
                $db = new PDO($dsn, $dbusername, $dbpassword);

                $query = "INSERT INTO carpool_user (name, email, password, phone) 
                  VALUES ('$username', '$email', $password, $phone)";

                $insertCount = $db->exec($query);

                $select = $db->prepare("SELECT id FROM carpool_user WHERE name = '$username' ");
                $select->execute();  
                $row = $select->fetch(PDO::FETCH_ASSOC);
              
                session_start();
                // Store Session Data
                $_SESSION['login_user_id']= $row['id'];  // Initializing Session with value of PHP Variable
                
              } catch (PDOException $ex) {
              }
              header("Location: become_member.php");                    
            break;
            default:
                header('Location: get_started.php');
        }
?>