<?php
    session_start();
    require 'check.php';
    $curr = $_SESSION['curr'];

    //Database connection
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $dbpassword="root";
    $dbname="frozen_food";

    $con = new mysqli($host, $user, $dbpassword, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    if (!empty($_POST['qty'] && $_POST['qty'] > 0)){
        $stmt = $con->prepare("INSERT INTO cart(Product_IdProduct, Pembeli_IdPembeli, jumlah) VALUES(
                                    ?,
                                    ?,
                                    ?);"
                                );
        $stmt->bind_param("ssi", $_POST['idproduct'], $curr['IdPembeli'], $_POST['qty']);
        $stmt->execute();
    }
    else{
        echo '<script type="text/javascript">alert("Please input a valid quantity")</script>';
    }

    header("Location: main.php");
    die();
?>