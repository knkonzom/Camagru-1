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
                    echo '<p> Fill in all fields!</p>';
                }
                else if($_GET['error'] == "wrongpwd")
                {
                    echo '<p> You have enter wrong password!</p>';
                }
                else if($_GET['error'] == "nouser")
                {
                    echo '<p>Username/E-mail does not exist!</p>';
                }
            }
            else if($_GET['activate'] == "success")
            {
                echo "<div>Your email is activated, thanks!. You may now login.</div>";
            }
            ?>
            
                <form action="config/login.inc.php" method="post">
                    <input  type="text"  name="mailuid" placeholder="Username/E-mail"><br>
                    <input  type="password" name="pwd" placeholder="Password..."><br>                       
                    <button type="submit" name="login-submit">Login</button><br>
                </form>
        </div>
    </main>
<?php
    require "footer.php";
?>