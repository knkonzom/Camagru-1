<?php
session_start();
include "./config/setup.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<div class="nev">   
        <nav> 
            <ul>
                <a style="font-size:20px" href="signup.php">SignUp</a>
                <a style="font-size:20px" href="guest-account.php">Guest</a>
            </ul>
        </nav>
    <main>
        <h1>Welcome to Camagru</h1> 
        <div class="static">
            <div class="text" ><p>Sign In</p>
            <?php
            if(isset($_GET['error']))
            {
                if($_GET['error'] == "emptyfields")
                {
                    echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:red">Fill in all fields!</p></strong>';
                }
                else if($_GET['error'] == "wrongpwd")
                {
                    echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:red">You have enter wrong password!</p></strong>';
                }
                else if($_GET['error'] == "nouser")
                {
                    echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:red">Username/E-mail does not exist!</p></strong>';
                }
                else if($_GET['error'] == "notverified")
                {
                    echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:red">You need to verify your account.</p></strong>';
                }                         
            }
            else if(isset($_GET['activate']) == "success")
            {
                echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:green">Your email is activated, thanks!. You may now login.</p></strong>';
            }
            
            else if(isset($_GET['updatesuccess']) == "updated")
            {
                echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:green">You can now login with your new password.</p></strong>';
            }
            ?>
                <form action="config/login.inc.php" method="post">
                    <input  type="text"  name="mailuid" placeholder="Username/E-mail"><br>
                    <input  type="password" name="pwd" placeholder="Password..."><br>                       
                    <button type="submit" name="login-submit">Login</button><br>
                    <p style="font-size:15px">Forgot Password? please click ResetPassword</p>
                    <a href="resetpassword.php">ResetPassword</a>
                </form>
        </div>
    </main>
    <div   style="margin-top: 200px;background-color:green;height:40px;font-style: italic;">
        <p style="font-size:40%;margin-top:200px;text-align:right;">&copy 2019 Camagru from Bolaleka</p>
    </div>