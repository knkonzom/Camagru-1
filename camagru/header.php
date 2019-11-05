<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<body>
    <nav>
        <ul>
            <a href="index.php">Home</a>
            <a href="signup.php">Register</a>
        </ul>
    </nav>
    <h1>Welcome to Camagru</h1> 
    <div class="form">
        <p>Sign in</p>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="mailuid" placeholder="Username/E-mail"><br>
            <input  type="password" name="pwd" placeholder="Password..."><br>
            <button type="submit" name="login-submit">Login</button><br>
        </form>
    </div>
    <div class="footer">
        <p>&copy 2019 Camagru from Bolaleka</p>
    </div>
</body>
</html>
