<?php  

if(isset($_POST['update']))
{
    session_start();
    $userId = $_SESSION['userId'];

    include "config/setup.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $Username = $_POST['username'];
    $Email = $_POST['email'];
  //  $Oldpwd = $_POST['old-pwd'];
    $Newpwd = $_POST['new-pwd'];
    $RepeatNewPwd = $_POST['repeat-new-pwd'];
   
    // if(empty($Username) || empty($Email) || empty($Oldpwd) || empty($Newpwd) || empty($RepeatNewPwd) )
    // {
        
    //     header("location: Profilepage.php?error=emptyfields");
    //     exit();
    // }
    // if(!filter_var($Email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$\/", $Username) )
    // {
    //     header("location: Profilepage.php?error=invaliduidmail");
    //     exit();
    // }
    if(!preg_match("/^[a-zA-Z0-9]*$/", $Username))
    {
        header("location: Profilepage.php?error=invalidmail&uid=".$Username);
        
    }
    else if(!empty($Email) && !filter_var($Email, FILTER_VALIDATE_EMAIL))
    {
        header("location: Profilepage.php?error=invalidmail&uid=".$Email);
        
    }
    else if ($Newpwd !== $RepeatNewPwd)
    {
        header("location: Profilepage.php?error=passwordcheck&uid=".$Username."&mail=".$Email);
    }
    else 
    {
        
        try {
            echo "2";
        
                $sql = " SELECT * FROM users WHERE idUsers= '$userId' ";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                if($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    if($Username) {

                       
                        $sql = "UPDATE users SET  uidUsers=? WHERE idUsers=$userId";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $Username); 
                        $stmt->execute();

                        $sql = "UPDATE webcamimage SET  username=? WHERE update_userId=$userId";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $Username); 
                        $stmt->execute();

                        $sql = "UPDATE comments SET  username=? WHERE update_userId=$userId";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $Username); 
                        $stmt->execute();

                        $sql = " SELECT * FROM users WHERE idUsers='$userId'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
                        
                        $_SESSION['newUsername'] = $row['uidUsers'];
                        
                        header("location: HomePage.php?updatesuccess=updated");
                    }else if($Newpwd) {
                        if($Newpwd === $RepeatNewPwd) {

                        $newPwdHash = password_hash($Newpwd, PASSWORD_DEFAULT);

                            $sql = "UPDATE users SET  pwdUsers=? WHERE idUsers=$userId";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(1, $newPwdHash); 
                            $stmt->execute();
                            header("location: HomePage.php?updatesuccess=updated");

                        }
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