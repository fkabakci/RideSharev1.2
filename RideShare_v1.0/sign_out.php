<?php

  //  session_destroy(); // Is Used To Destroy All Sessions
    //Or
    session_start();
    
        if(isset($_SESSION['login_user_id'])) {
            unset($_SESSION['login_user_id']);  //Is Used To Destroy Specified Session
        }
        
        if(session_destroy()) {
            header("Location: get_started.php");
        }
?>
