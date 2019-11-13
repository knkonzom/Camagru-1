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
                <a href="signup.php">Register</a>
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
                            echo '<p> Fill in all fields!</p>';
                        }
                        else if($_GET['error'] == "invaliduidmail")
                        { 
                            echo '<p> Invalid username/e-mail!</p>';
                        }
                        else if($_GET['error'] == "invalidmail")
                        { 
                            echo '<p> Invalid username!</p>';
                        }
                        else if($_GET['error'] == "invalidmail")
                        { 
                            echo '<p> Invalid e-mail!</p>';
                        }
                        else if($_GET['error'] == "passwordcheck")
                        { 
                            echo '<p>Your password do not match!</p>';
                        }
                        else if($_GET['error'] == "usertaken")
                        { 
                            echo '<p>Username already exist!</p>';
                        }
                        else if($_GET['error'] == "emailtaken")
                        { 
                            echo '<p>E-mail already exist!</p>';
                        }
                    }
                    else if($_GET['signup'] == "success")
                    {
                        echo '<p style="font-size:20px">Signup successful!</p>';
                        echo '<p style="font-size:12px">To complete your registration, login to your email address and click the verification link.</p>';
                    } 
                ?>
                <form action="config/signup.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username">
                <input type="text" name="mail" placeholder="E-mail">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                <button type="submit" name="signup-submit">Signup</button>
                </form>
            </section>
        </div>
    </main>
<?php
    include "footer.php";
?>
</body>
</html>