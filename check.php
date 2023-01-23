<?php
    if (!isset($_SESSION['curr'])){
        header("Location: index.php");
        die();
    }

?>