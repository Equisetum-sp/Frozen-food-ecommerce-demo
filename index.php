<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="login.php" method="post">
        <label for="email">Email</label><br>
        <p class="center"><input type="email" id="email" name="email" size="30" placeholder="Your Email" required></p>
        <label for="password">Password</label><br>
        <p class="center"><input type="password" id="password" name="password" size="30" placeholder="Your Password" required></p>

        <p class="center"><button name="login">Login</button></p>
   </form>
    <p><a href="form.php">Create account</a></p>
</body>
</html>