<?php

if(isset($_POST['submit']))
{
   
    session_start();
    $user = $_SESSION['userUid'];
    $tt = $_SESSION['userEmail'];
    $userId = $_SESSION['userId'];


    $newFileName = $_POST['filename'];
   
    $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    
   
    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png'); 
   
    if(in_array($fileActualExt, $allowed))
    { 
        if($fileError === 0)
        {
            if($fileSize < 2000000)
            {
                
                $imageFullName = $newFileName . mktime(0) . "." . $fileActualExt;
                $fileDestination = "../uploads/" . $imageFullName;

                include "../config/setup.php";
                $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
                    try
                    {
                        
                        $sql = " SELECT * FROM webcamimage";
                        $stmt = $conn->prepare($sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $setImageOrder = $result + 1;
                        
                        $sql = "INSERT INTO webcamimage (update_userId, imgfullNameCam, username, userEmail, likes_count, orderCamImage) VALUES ('{$userId}', '{$imageFullName}', '{$user}', '{$tt}', 0, '{$setImageOrder}')";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        move_uploaded_file($fileTempName, $fileDestination);
                        header("location: ../HomePage.php?upload=success");
                    }
                    catch(PDOException $e)
                    {
                        echo $e->getMessage();
                    }
                    $conn = null;
                
            }
            else
            {
                echo "File size is too big";
            }
        }
        else{
            echo "You had an error!";
        }
    }
    else
    {
        echo "You need to upload a proper file type!";
        exit();
    }
}