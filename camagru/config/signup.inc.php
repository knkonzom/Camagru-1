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
        
        header("location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();

    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$\/", $username) )
    {
        header("location: ../signup.php?error=invaliduidmail");
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
        header("location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
    }
    else 
    {
       
        try 
        {
            
             $sql = "SELECT count(*) FROM users WHERE uidUsers=? OR emailUsers=? AND verified = '0'";
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(1, $username);
             $stmt->bindParam(2, $email);
             $stmt->execute();
             $result = $stmt->fetchColumn();
        
            if($result > 0)
            {  
                echo "1";
                $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=? AND verified = '0' ";
                echo "2";
                $stmt = $conn->prepare($sql);
                echo "3";
                $stmt->bindParam(1, $username);
                echo "4";
                $stmt->bindParam(2, $email);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['uidUsers'] == "$username")
                {   
                    header("location: ../signup.php?error=usertaken&mail=".$username);
                    exit();
                }
                else if($result['emailUsers'] == "$email")
                {   
                    header("location: ../signup.php?error=emailtaken&mail=".$email);
                    exit();
                }
                else
                {
                    // you have to create a resend verification script
                    echo "<div>Your email is already in the system but not yet verified.</div>";
                }   
            }
            else
            {
                
                $token =  bin2hex(random_bytes(50));
                $verificationLink = "http://localhost:8080/camagru/config/activate.inc.php?code=".$token;
                $htmlStr = "";
                $htmlStr .= "Hi " . $username . ",<br /><br />";
                $htmlStr .= "Please click the button below to verify your email and have access to the login page.<br /><br /><br />";
                $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
                $htmlStr .= "Kind regards,<br />";
                $htmlStr .= "<a href='http://localhost:8080/' target='_blank'>The Code of Camagru</a><br />";

                $name = "The Code of Camagru";
                $email_sender = "no-reply@Camagru.com";
                $subject = "Verification Link ";
                $recipient_email = $email;
 
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: {$name} <{$email_sender}> \n";
 
                $body = $htmlStr;
                if(mail($recipient_email, $subject, $body, $headers))
                {
                
                    echo "<div = 'successMessage'>A verification email were sent to <b>" . $email . "</b>, please open your email inbox and click the given link so you can login.</div>";

                    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, token) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $hashpwd = password_hash($password, PASSWORD_DEFAULT);   
                    $stmt->bindParam(1, $username);
                    $stmt->bindParam(2, $email);  
                    $stmt->bindParam(3, $hashpwd);
                    $stmt->bindParam(4, $token);
                    if($stmt->execute())
                    {
                         echo "<div>Unverified email was saved to the database.</div>";
                    }
                    else
                    {
                        echo "<div>Unable to save your email to the database.";
                        //print_r($stmt->errorInfo());
                    }
                    header("location: ../signup.php?signup=success");
                    exit();
                }
                else
                {
                    die("Sending failed.");
                }
            }
        }
        catch (PDOException $e)
        {
            print_r($e);
            // header("location: ../signup.php?error=sqlerror");
            // exit();
        }
    }
    $conn = null;
}
else
{
    header("location: ../signup.php");
    exit();
}