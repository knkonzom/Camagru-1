<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<body>
    <div class="nev">   
        <nav> 
            <ul>
                <a href="index.php">Home</a>
            </ul>
        </nav>
    </div>   
    <main>
        <div> 
            <section>
                <h1>Signup</h1>
                <?php
                    if(isset($_GET['error']))
                    {
                        if($_GET['error'] == "emptyfields")
                        {
                            echo '<strong><p style="font-size:20px;color:red">Fill in all fields!</p></strong>';
                        }
                        else if($_GET['error'] == "invaliduidmail")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Invalid username/e-mail!</p></strong>';
                        }
                        else if($_GET['error'] == "invalidmail")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Invalid username!</p></strong>';
                            '<p> </p>';
                        }
                        else if($_GET['error'] == "passwordlen")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Your password must be up to 8 or more!</p></strong>';
                        }
                        else if($_GET['error'] == "passwordCAP" || $_GET['error'] == "passwordNUM")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Your password must be Capital letter and numbers!</p></strong>';
                        }
                        else if($_GET['error'] == "invalidmail")
                        { 
                            echo '<strong><p style=style="font-size:20px;color:red">Invalid e-mail!</p></strong>';
                            
                        }
                        else if($_GET['error'] == "passwordcheck")
                        { 
                            echo '<strong><p style=style="font-size:20px;color:red">Your password do not match!</p></strong>';
                        }
                        else if($_GET['error'] == "usertaken")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Username already exist!</p></strong>';
                        }
                        else if($_GET['error'] == "emailtaken")
                        { 
                            echo '<strong><p style=style="font-size:20px;color:red">E-mail already exist!</p></strong>';
                        }
                    }
                    else if(isset($_GET['signup']) == "success")
                    {
                        echo '<strong><p style="font-size:20px;color:green">Signup successful!</p></strong>';
                        echo '<strong><p style="background-color:black;text-align:center;font-size:20px;color:green">To complete your registration, login to your email address and click the verification link.</p></strong>';
                    } 
                ?>
                <form action="config/signup.inc.php" method="post">
                <input type="text" name="uid" value="<?php if(isset($_GET['uid'])) echo $_GET['uid']; ?>" placeholder="Username">
                <input type="text" name="mail" value="<?php if(isset($_GET['mail'])) echo $_GET['mail']; ?>" placeholder="E-mail">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                <button type="submit" name="signup-submit">Signup</button>
                </form>
            </section>
        </div>
    </main>
<?php

?>
</body>
<div   style="margin-top: 200px;background-color:green;height:40px;font-style: italic;">
        <p style="font-size:90%;margin-top:200px;text-align:right;">&copy 2019 Camagru from Bolaleka</p>
    </div>
</html>