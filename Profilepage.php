<?php
session_start();

if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
} else 
{
?>
<head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
</head>
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
        include 'config/setup.php';

        $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);         


        $user = $_SESSION['userUid'];
        $userId = $_SESSION['userId'];
        $sql = " SELECT * FROM users WHERE idUsers='$userId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        $currentUsername = $row['uidUsers'];
        echo "<p><h1>Welcome $currentUsername</h1></p>";
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
        <!-- <input type ="password" name="old-pwd" placeholder="Enter Old Password"/><br/> -->
        <input type ="password" name="new-pwd" placeholder="Enter New Password"/><br/>
        <input type ="password" name="repeat-new-pwd" placeholder="Confirm New Password"/><br/>
        
        <input type ="submit" name="update" value="Update Profile">
    </form>
</body>
<div   style="margin-top: 200px;background-color:green;height:40px;font-style: italic;">
        <p style="font-size:60%;margin-top:300px;text-align:right;">&copy 2019 Camagru from Bolaleka</p>
</div>
<?php 
   
}
?>