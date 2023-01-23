<?php
    //Database connection
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $dbpassword="root";
    $dbname="frozen_food";

    $con = new mysqli($host, $user, $dbpassword, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    $stmt = $con->prepare("SELECT COUNT(IdPembeli) as id FROM pembeli");
    $stmt->execute();
    $result = $stmt->get_result();


    if ($_POST['password'] === $_POST['password2']){
        $stmt = $con->prepare("INSERT INTO pembeli VALUES(
                                    ?,
                                    ?,
                                    ?,
                                    ?,
                                    ?);"
                                );
        $newid = $result->fetch_assoc();
        $newid['id']++;
        
        $stmt->bind_param("issss", $newid['id'], $_POST['email'], $_POST['password'], $_POST['username'], $_POST['alamat']);
        $stmt->execute();
        echo "<h2>Account created</h2>";
        echo "<a href=\"index.php\">Return to login page</a>";
        
    }
    else{
        echo "<h2>Password and Confirm password must be same</h2>";
    }
    

?>