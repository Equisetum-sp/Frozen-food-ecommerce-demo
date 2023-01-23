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

    //delete cart
    if (isset($_POST['del'])){
        $stmt = $con->prepare("DELETE FROM cart
                                WHERE IdCart = ?
                                ");
        $stmt->bind_param("i", $_POST['idcart']);
        $stmt->execute();
    }

    //fetch data
    $stmt = $con->prepare("SELECT
                                c.IdCart as IdCart,
                                prd.nama_product as 'Name',
                                c.jumlah as Qty,
                                c.jumlah*prd.harga as Price
                            FROM cart c
                            INNER JOIN product prd
                                ON c.Product_IdProduct = prd.IdProduct
                            WHERE c.Pembeli_IdPembeli = ?
                            ORDER BY IdCart;"
                            );
    $stmt->bind_param("i", $curr['IdPembeli']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    //empty cart
    if ($result->num_rows <= 0){
        echo '<h2>Cart is empty</h2>';
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
                <th>Product Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Delete</th>
            </tr>
	    </thead>
        <tbody>
            <?php
            //$data = $result->fetch_all();
            $subtotal = 0;
            foreach($result as $value){
                $subtotal += $value['Price'];
                ?>
                <tr>
                    <td><?php echo $value['Name'];?></td>
                    <td><?php echo $value['Qty'];?></td>
                    <td><?php echo $value['Price'];?></td>
                    <form method="post" action="cart.php">
                    <td>
                        <input type="hidden" name="idcart" value=<?php echo $value['IdCart']?>>
                        <button id="delbtn" name="del">Delete</button>
                    </td>
                    </form>
                </tr>
                <?php
            }
            ?>

            <tr>
                <td colspan = 2>SUBTOTAL</td>
                <td colspan = 2><?php echo $subtotal?></td>
            </tr>
        </tbody>
    </table>
   <br>
   <a href="main.php">Return to main page</a>
</body>
</html>