<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
      <form action="registration.php" method="post">
        <label for="username">Username</label><br>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required>
        <br><br>
        <label for="password">Confirm Password</label><br>
        <input type="password" id="password" name="password2" required>
        <br><br>
        <label for="alamat">Alamat pengiriman</label><br>
        <input type="text" id="alamat" name="alamat" required>
        <br><br>
        <button name="register">Register</button>
      </form>
      
    </div>
</body>
</html>