<?php

include "config/setup.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['image_id']))
{
    
    $file_path = "uploads/" . $_POST["image_id"];
    if(unlink($file_path))
    {   
        try
        {

        $sql = "DELETE FROM  webcamimage WHERE imgfullNameCam ='".$_POST["image_id"]."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location: HomePage.php?remove=success");
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
   }
}

?>