<?php
    session_start();
    unset($_SESSION['logged_in']);
    $_SESSION['userid'] = -1;        
    $_SESSION['firstname'] = '';
    session_destroy();
    header('Location: login.php', true, 303);
?>