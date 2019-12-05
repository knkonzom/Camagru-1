<?php

if(isset($_POST['like_comment']))
{
    include "../config/database.php";

    $imageId = $_POST['comment_id'];
   
    try
    {
       
        $sql = "UPDATE comments set likes_count = likes_count+1 WHERE imageId = '$imageId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location: ../public.php?likes=1");
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
