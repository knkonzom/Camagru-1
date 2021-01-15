<?php

if (isset($_POST['like_id'])) {
    include "../config/setup.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $imageId = $_POST['likes_id'];


    try 
    {

        $sql = "UPDATE webcamimage set likes_count = likes_count+1 WHERE imgfullNameCam = '$imageId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header("location: ../public.php?likes=1");
    } 
    catch (PDOException $e) 
    {
        echo $e->getMessage();
    }
}

