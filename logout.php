<?php
    session_start();
    require 'check.php';
    
    session_destroy();

    header("Location: index.php");
    die();
?>