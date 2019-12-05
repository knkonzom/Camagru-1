<?php

include "config/database.php";

if(isset($_POST['image_id']))
{
    
    $file_path = 'uploads/' . $_POST["image_id"];
    if(unlink($file_path))
    {   
        try
        {

        $sql = "DELETE FROM  webcamimage WHERE imgfullNameCam ='".$_POST["image_id"]."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location: gallery.php?remove=success");
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

?>