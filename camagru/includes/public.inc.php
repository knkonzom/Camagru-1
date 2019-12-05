<?php
    if(isset($_POST['comment_id']))
    {    
      include "../config/database.php";
      
      session_start(); 
      $image_id = $_POST['comm_id'];
      $username = $_POST['username'];
       
       $usrpicEmail = $_SESSION['image_email'];
       $usrpicuid = $_SESSION['image_usr'];
       $image_id = $_SESSION['image_name'];
       $date = $_POST['date'];
       $comment = htmlspecialchars($_POST['message']);
       if(empty($comment))
       {
          header("location: ../public.php?error=emptycomment");
       }
       else
       {
            try
            {
              
              $token =  bin2hex(random_bytes(50));
              $verificationLink = "http://localhost:8080/camagru/public.php?code=".$token;
              $htmlStr = "";
              $htmlStr .= "Hi " . $usrpicuid . ",<br /><br />";
              $htmlStr .= "<b>You have comment on your picture</b> .<br /><br /><br />";
              $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
              $htmlStr .= "Kind regards,<br />";
              $htmlStr .= "<a href='http://localhost:8080/' target='_blank'>The Code of Camagru</a><br />";
    
              $name = "The Code of Camagru";
              $email_sender = "no-reply@Camagru.com";
              $subject = "Verification Link ";
              $recipient_email = $usrpicEmail;
    
              $headers  = "MIME-Version: 1.0\r\n";
              $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
              $headers .= "From: {$name} <{$email_sender}> \n";
    
              $body = $htmlStr;

              if(mail($recipient_email, $subject, $body, $headers))
              {
                
                $sql = "INSERT INTO comments (username, imageId, date, comment, likes_count) VALUES ('$username', '$image_id', '$date', '$comment', 0) ";
                $result = $conn->query($sql);
                
                $_SESSION['id_comm'] = $comment;
                $_SESSION['id_image'] = $image_id;
                $_SESSION['user_id'] = $username;
        
                header("location: ../public.php?comment=save");
              }
              else {
                var_dump($_SESSION);
                // echo "fail";
              }
            }
            catch(PDOException $e)
            {
              echo $e->getMessage();
            }
      }
         
    }