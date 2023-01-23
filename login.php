<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Database connection
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $dbpassword="root";
    $dbname="frozen_food";

    $con = new mysqli($host, $user, $dbpassword, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    $stmt = $con->prepare("SELECT * FROM pembeli WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    //user don't exist
    if ($result->num_rows <= 0){
        echo '<h2>No data found</h2>';
    }

    else{
        $data = $result->fetch_assoc();
        //correct password
        if($password === $data['password']){
            session_start();
            $_SESSION['curr'] = $data;
            echo '<h2>Login successful</h2><br>';
            echo '<p><a href="main.php">Go to main page</a></p>';
        }

        //wrong password
        else{
            echo '<h2>Incorrect password</h2>';
        }
    }
    $con->close();
?>