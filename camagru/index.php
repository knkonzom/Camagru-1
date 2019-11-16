<?php
    require "header.php";
?>
    <main>
        <h1>Welcome to Camagru</h1> 
        <div class="static">
            <div class="text" ><p>Sign in</p>
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
            }
            else if($_GET['activate'] == "success")
            {
                echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:green">Your email is activated, thanks!. You may now login.</p></strong>';
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
<?php
    require "footer.php";
?>