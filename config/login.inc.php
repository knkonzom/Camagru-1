<?php

if(isset($_POST['login-submit']))
{
    include "setup.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    
    $mailuid = htmlspecialchars($_POST['mailuid']);
    $password = htmlspecialchars($_POST['pwd']);
    
    if(empty($mailuid) || empty($password) )
    {
        header("location: ../index.php?error=emptyfields");
        exit();
    }
    else
    {
        try
        {
                $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $mailuid);
                $stmt->bindParam(2, $mailuid);
                $stmt->execute();
                if($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $pwdcheck = password_verify($password, $row['pwdUsers']);
                    if($pwdcheck == false)
                    {
                        header("location: ../index.php?error=wrongpwd");
                        exit();
                    }
                    else if($pwdcheck == true)
                    {
                        session_start();
                        $_SESSION['userId'] = $row['idUsers'];
                        $_SESSION['userUid'] = $row['uidUsers'];
                        $_SESSION['userEmail'] = $row['emailUsers'];
                        $_SESSION['verify'] = $row['verified'];
                        if($row['verified'] == 0)
                        {
                            header("location: ../index.php?error=notverified");
                            exit();
                        }
                        header("location: ../HomePage.php?login=loginsuccess");
                        // var_dump($row);
                        exit();
                    }
                    else
                    {
                        header("location: ../index.php?error=wrongpwd");
                        exit();
                    }
                }
                else
                {
                    if($row['uidUsers'] !== $mailuid)
                    {
                        header("location: ../index.php?error=nouser");
                        exit();
                    }
                }
        }
        catch (PDOException $e)
        {
            
            header("location: ../index.php?error=sqlerror");
            exit();
        }
    }
    $conn = null;
}
else
{
    echo "fssfg";
    // header("location: ../index.php");
    // exit();
}