<?php
session_start();
date_default_timezone_set('Africa/Johannesburg');
include 'config/setup.php';
include 'function.php';
$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 include 'includes/comment.inc.php';
?> 
 <head>
    <meta charset="utf-8">
    <meta name="description" content="example">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<body>
 <div class="nev">   
        <nav> 
            <ul>
                <form style="text-decoration-style:none" action="config/logout.inc.php" method="post">
                    <button style="width:90px;float:left;font-size:20px"type="submit" name="logout-submit"><a href="index.php">Logout</a></button>
                </form>
                <button style="width:200px;float:left;font-size:20px"type="submit" ><a href="public.php">Gallery</a></button>
                <button style="width:200px;float:right;font-size:20px"type="submit" ><a href="HomePage.php">Profile</a></button>
            </ul>
        </nav>
    </div> <br>
    <?php
    
        $user = $_SESSION['userUid'];
        $userId = $_SESSION['userId'];

        $imagecount = get_like();
        $commentcount = get_comment();
        
        $sql = " SELECT * FROM users WHERE idUsers='$userId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        $currentUsername = $row['uidUsers'];
        $_SESSION['commentator'] = $currentUsername;
        echo "<p><h1>Welcome $currentUsername </h1></p>";
    ?>
<table style="width:100px">
    <tr>
        <td>
            <?php
                if($user)
                {
                    try
                    {

                        $sql2 = "SELECT imgfullNameCam FROM webcamimage ORDER BY idCamImage DESC";
                        $stmt = $conn->prepare($sql2);
                        $stmt->execute();
                        $row = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        $i = 0;
                        $len = count($row);
                        while($i < $len)
                        {
                            echo' <a href="'.'uploads/'.$row[$i].'">
                            <img src="uploads/'.$row[$i].'" width="400" height="400">
                            <form action="" method="POST">
                                <button style="width:80px;height:20px" type="submit" name="photoid" value="'.$row[$i].'">comment</button>
                            </form> ';
                            ?>
                            <form action="includes/imagelike.inc.php" method="POST">
                                <input type="hidden" name="likes_id" value="<?PHP echo $row[$i]; ?>">
                                <button style="width:100px;height:20px" type="submit" id="<?PHP echo $row[$i]; ?>" name="like_id">LIKE: <?PHP echo $imagecount[$i]; ?></button>
                            </form>            
                        <?php
                        $i++;           
                        }
                
                    }
                    catch(PDOException $e)
                    {
                        echo $e->getMessage();
                    }
                }

            ?>
        </td>
    </tr>
<tr>
    <td>
<?php
if(isset($_POST['photoid']) == "get")
{
   $idimage = $_SESSION['image_name'];
  
   
   echo '<table border="2">
   <tr>
   <td>
       <form action="includes/public.inc.php" method="POST">
           <input type="hidden" name="username" value="'.$user.'">
           <input type="hidden" name="comm_id" value="'.$idimage.'">
           <input type="hidden" name="date" value="'.date('Y-m-d H:i:s').'">
           <textarea name="message" pattern="'.htmlspecialchars('[A-Za-z]{3}').'"></textarea><br>
           <button style="decoration:none" type="submit" name="comment_id" value="'.$idimage.'">POST</button>
       </form>
       </td>
   </tr>
   </table>';
}
?>
</td>
</tr>
</table>


<div  style=" height:1200px;width:600px;margin-left:750;margin-top:-2100"> 
<?Php
if(isset($_GET['comment']) == "saved")
{
    $comm = $_SESSION['id_comm'];
    $pic_id = $_SESSION['id_image'];
    $user_id = $_SESSION['user_id'];
    $userId = $_SESSION['userId'];

    
    try
    {
        $sql = " SELECT * FROM users WHERE idUsers='$userId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        $currentUsername = $row['uidUsers'];

            $sql = "SELECT comment FROM comments WHERE imageId='$pic_id' ORDER BY commentId DESC;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $i = 0;
            $len = count($row);
            while($i < $len)
            {
                $sql = " SELECT * FROM comments WHERE update_userid='$userId'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
                if($currentUsername === $row2['username']) {
                    echo 'PostedBy: You <div class="direct"><a href="'.'uploads/'.$pic_id.'">
                      <img style="width:50px;height:50px" src="uploads/'.$pic_id.'" width="600" height="400">'.$row[$i].'</div>';
                }else {
                echo 'PostedBy: '. $row2['username'].'<div class="direct"><a href="'.'uploads/'.$pic_id.'">
                      <img style="width:50px;height:50px" src="uploads/'.$pic_id.'" width="600" height="400">'.$row[$i].'</div>';
                }
                      ?>
                      <form action="includes/commentlike.inc.php" method="POST">
                        <input type="hidden" name="comment_id" value="<?PHP echo $pic_id ?>">
                        <button style="width:100px;height:20px" type="submit" id="<?PHP echo $pic_id ?>" name="like_comment">LIKE: <?PHP echo $commentcount[$i]; ?></button>
                      </form> 
                <?php
                echo '<hr />';
                $i++;  
            }        
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
} 
?>   
</div>

</body>
<div   style="margin-top:2000px;background-color:green;height:40px;font-style: italic;">
        <p style="font-size:60%;margin-top:200px;text-align:right;">&copy 2019 Camagru from Bolaleka</p>
    </div>