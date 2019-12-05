<?php
session_start();

if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
} else 
{
?>
<body>
 <div class="nev">   
        <nav> 
            <ul>
                <form style="text-decoration-style:none" action="config/logout.inc.php" method="post">
                    <button style="width:90px;float:left;font-size:20px"type="submit" name="logout-submit"><a href="index.php">Logout</a></button>
                </form>
                <button style="width:90px;float:right;font-size:20px"type="submit" name="gallery"><a href="HomePage.php">Home</a></button>
            </ul>
        </nav>
    </div> <br>
    <?php
        $user = $_SESSION['userUid'];
        echo "<p><h1>Welcome $user</h1></p>";
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
    ?>
     <h2>Edit/Update Your Profile</h2>
    <form action="update.php" method="Post">
        <input type ="text" name="username" placeholder="Enter username"/><br/>
        <input type ="text" name="email" placeholder="Enter E-mail"/><br/>
        <input type ="password" name="old-pwd" placeholder="Enter Old Password"/><br/>
        <input type ="password" name="new-pwd" placeholder="Enter New Password"/><br/>
        <input type ="password" name="repeat-new-pwd" placeholder="Confirm New Password"/><br/>
        
        <input type ="submit" name="update" value="Update Profile">
    </form>
</body>

<?php 
    include "footer.php";
}
?>