<?php
session_start();
if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
}else
{
    ?>
<!DOCTYPE html>
<html>
<div class="nev">   
        <nav> 
            <ul>
                <form style="text-decoration-style:none" action="config/logout.inc.php" method="post">
                    <button style="width:90px;float:left;font-size:20px"type="submit" name="logout-submit"><a href="index.php">Logout</a></button>
                </form>
                <button style="width:110px;float:right;font-size:20px;text-align:center;"type="submit" name="profile-update"><a href="HomePage.php">Home</a></button>
                
            </ul>
        </nav>
    </div> <br>
<head>
<meta charset="utf-8">
    <meta name="description" content="example">
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<body>
<h1>Gallery</h1>
<div id="" style="overflow:scroll; height:400px;">
<button style="width:200px;float:right;font-size:20px"type="submit"><?PHP echo '<a href="webcam.php">'?>
<img style="font-size:50%" src="uploads/camera.png"></a></button>
<div style="width:100px" class="gallery">
<?php

    include "config/database.php";
    $user = $_SESSION['userUid'];
    try
    {
        $sql2 = "SELECT * FROM webcamimage WHERE username = '$user' ORDER BY idCamImage DESC";
        $stmt = $conn->prepare($sql2);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row)
        {
            echo '<a href="'.'uploads/'.$row["imgfullNameCam"].'">
            <img style="height:90px;widht:30px"src="uploads/'.$row["imgfullNameCam"].'">
            </a>
            ';
        } 
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }


?>
</div>
</div>
  <div class="gallery-upload">  

    <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="image" name="img">
        <input type="hidden" name="filename" ><br>
        <input style=" padding:5px 20px;margin:2px 14px;" type="file" name="file"><br>
        <button style=" width:100px;padding:6px 20px;margin:4px 24px;"  type="submit"  name="submit">UPLOAD</button>
    </form>
       
</div> 
<?php
    include "footer.php";
}
?>
</body>

</html>