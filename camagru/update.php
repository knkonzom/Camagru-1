<?php  

if(isset($_POST['update']))
{
    include "config/database.php";

    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $Oldpwd = $_POST['old-pwd'];
    $Newpwd = $_POST['new-pwd'];
    $RepeatNewPwd = $_POST['repeat-new-pwd'];
   
    if(empty($Username) || empty($Email) || empty($Oldpwd) || empty($Newpwd) || empty($RepeatNewPwd) )
    {
        
        header("location: Profilepage.php?error=emptyfields");
        exit();
    }
    else if(!filter_var($Email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$\/", $Username) )
    {
        header("location: Profilepage.php?error=invaliduidmail");
        exit();
    }
    else if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
    {
        header("location: Profilepage.php?error=invalidmail&uid=".$Username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $Username))
    {
        header("location: Profilepage.php?error=invalidmail&uid=".$Email);
        exit();
    }
    else if ($Newpwd !== $RepeatNewPwd)
    {
        header("location: Profilepage.php?error=passwordcheck&uid=".$Username."&mail=".$Email);
        exit();
    }
    else 
    {
        try {
        $sql = " SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $Username); 
        $stmt->bindParam(2, $Email); 
        $stmt->execute();
        if($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           
            $oldpwdCheck = password_verify($Oldpwd, $row["pwdUsers"]);
            if($oldpwdCheck === false)
            {
                header("location: Profilepage.php?error=old-pwd-not-match-current-pwd");
                exit();
            }
            else if($oldpwdCheck === true)
            {
                $verifyID = $row['idUsers'];
                $sql = "UPDATE users SET  uidUsers=?, emailUsers=?, pwdUsers=? WHERE idUsers=?";
                $stmt = $conn->prepare($sql);
                $newPwdHash = password_hash($Newpwd, PASSWORD_DEFAULT);
                $stmt->bindParam(1, $Username); 
                $stmt->bindParam(2, $Email); 
                $stmt->bindParam(3, $newPwdHash); 
                $stmt->bindParam(4, $verifyID);
                $stmt->execute();
                header("location: index.php?updatesuccess=updated");
                exit();
            }
            else
            {
                echo "Your old password must be match with your current password or try reset your password from login page.";
                exit();
            }
        }
        }catch (PDOException $e)
        {
            echo $e->getMessage();
        }
        $conn = null;
       
    }

}
else
{
    header("location: ../index.php");
    exit();
}