<?php

if(isset($_POST['signup-submit']))
{
   include 'database.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
    {
        header("location: ../signup.php?error=enptyfields&uid=".$username."&mail=".$email);
        exit();

    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$\/", $username) )
    {
        header("location: ../signup.php?error=invalidmail&uid");
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("location: ../signup.php?error=invalidmail&uid=".$email);
        exit();
    }
    else if ($password !== $passwordRepeat)
    {
        header("location: ../signup.php?error=enptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    else 
    {
        try 
        {
             $sql = "SELECT count(*) FROM users WHERE uidUsers=?";
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(1, $username);
             $stmt->execute();
             $result = $stmt->fetchColumn();
            if($result > 0)
            {
                header("location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            }
            else
            {
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $hashpwd = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(1, $username);
                $stmt->bindParam(2, $email);  
                $stmt->bindParam(3, $hashpwd);
                $stmt->execute();
                header("location: ../signup.php?signup=success");
                exit();
            }
        }
        catch (PDOException $e)
        {
            header("location: ../signup.php?error=sqlerror");
            exit();
        }
    }
    $conn = null;
}
else
{
    header("location: ../signup.php");
    exit();
}