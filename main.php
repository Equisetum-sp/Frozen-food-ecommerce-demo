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

    $stmt = $con->prepare("SELECT * FROM product");
    $stmt->execute();
    $result = $stmt->get_result();
    
    //no products
    if ($result->num_rows <= 0){
        echo '<h2>No products found</h2>';
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
    <table border=1>
        <thead>
            <tr>
                <th colspan=3>Hi, <?php echo $curr['nama'];?></th>
                <th colspan=2><a href="edit.php">Edit profile</a></th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price (Rp)</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
	    </thead>
        <tbody>
            <?php
            //$data = $result->fetch_all();
            foreach($result as $value){
                ?>
                <tr>
                    <td><?php echo $value['IdProduct'];?></td>
                    <td><?php echo $value['nama_product'];?></td>
                    <td><?php echo $value['harga'];?></td>
                    <form method="post" action="buy.php">
                    <td><input type="number" name="qty" required></td>
                    <td>
                        <input type="hidden" name="idproduct" value=<?php echo $value['IdProduct']?>>
                        <button id="buybtn" name="buy">Buy</button>
                    </td>
                    </form>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    
    <br><br>
    <button onclick="window.location.href='cart.php';">
        View cart
    </button>
    
    <br><br>
    <button onclick="window.location.href='logout.php';">
        Log out
    </button>
    <?php $con->close();?>
</body>
</html>