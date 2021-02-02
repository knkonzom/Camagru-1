<?php
session_start();
if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
    exit();
} else 
{
date_default_timezone_set('Africa/Johannesburg');
include 'config/setup.php';
$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include 'includes/comment.inc.php';
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
                <button style="width:110px;float:right;font-size:20px;text-align:center;"type="submit" name="profile-update"><a href="Profilepage.php">Update Profile</a></button>
                <button style="width:90px;float:right;font-size:20px"type="submit" name="gallery"><a href="gallery.php">Edit</a></button>
                <button style="width:200px;float:left;font-size:20px"type="submit" name="logout-submit"><a href="public.php">Gallery</a></button>
            </ul>
        </nav>
    </div> <br>
    <?php
        $user = $_SESSION['userUid'];
        $userId = $_SESSION['userId'];
       
        $sql = " SELECT * FROM users WHERE idUsers='$userId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        $currentUsername = $row['uidUsers'];
        echo "<p><h1>Welcome $currentUsername </h1></p>";
    ?>
<div  style="overflow:auto; height:800px;width:600px"> 
<?PHP include 'pagination.php'?>
<div class="pagination">
<a href="HomePage.php" class="next">Next &raquo;</a>
<?php
    
        try
        {

            $sql2 = "SELECT imgfullNameCam FROM webcamimage WHERE update_userId='$userId' ORDER BY idCamImage DESC";
            $stmt = $conn->prepare($sql2);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $i = 0;
            $len = count($row); //row count
            while($i < $len)
            {
                echo' <a href="'.'uploads/'.$row[$i].'">
                <img src="uploads/'.$row[$i].'" width="600" height="400">
                <form action="delete.php" method="POST">
                    <button style="width:90px;height:20px" type="submit" name="image_id" value="'.$row[$i].'">DELETE</button>
                </form>         
              ';
              $i++;           
            }  
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
?>
<a href="HomePage.php" class="previous">&laquo; Previous</a>
</div>
</div>
</body>

<div   style="margin-top: 200px;background-color:green;height:40px;font-style: italic;">
        <p style="font-size:60%;margin-top:300px;text-align:right;">&copy 2019 Camagru from Bolaleka</p>
</div>


