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

    $stmt = $con->prepare("SELECT * FROM pembeli WHERE IdPembeli = ?");
    $stmt->bind_param("i", $curr['IdPembeli']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    //user don't exist
    if ($result->num_rows <= 0){
        echo '<h2>No data found</h2>';
        die();
    }

    //change pw
    if (isset($_POST['changepw'])){
        if ($_POST['newpassword'] === $_POST['newpassword2']){
            $newpw = $_POST['newpassword'];
            $stmt2 = $con->prepare("UPDATE pembeli SET password = ? WHERE IdPembeli = ?");
            $stmt2->bind_param("si", $newpw, $curr['IdPembeli']);
            $stmt2->execute();
            echo '<script type="text/javascript">alert("Password changed")</script>';
        }
        else{
            echo "<h2 style=\"color:red;\">Password is not the same</h2>";
        }
    }

    //change addr
    if (isset($_POST['changeaddr'])){
        $newaddr = $_POST['newaddr'];
        $stmt2 = $con->prepare("UPDATE pembeli SET alamat = ? WHERE IdPembeli = ?");
        $stmt2->bind_param("si", $newaddr, $curr['IdPembeli']);
        $stmt2->execute();
        echo '<script type="text/javascript">alert("Address changed")</script>';
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Change password</h2>
    <form action="edit.php" method="post">
        <label for="newpassword">New Password</label><br>
        <p><input type="password" id="newpassword" name="newpassword" size="30" placeholder="Enter new password" required></p>
        
        <label for="newpassword2">New Password Confirm</label><br>
        <p><input type="password" id="newpassword2" name="newpassword2" size="30" placeholder="Enter new password again" required></p>

        <p><button name="changepw">Change password</button></p>
   </form>

    <br>

   <h2>Change address</h2>
    <form action="edit.php" method="post">
        <label for="newaddr">New Address</label><br>
        <p><input type="text" id="newaddr" name="newaddr" size="30" placeholder="Enter new address" required></p>

        <p><button name="changeaddr">Change address</button></p>
   </form>
   <br>
   <a href="main.php">Return to main page</a>
</body>
</html>