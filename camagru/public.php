<?php
session_start();
date_default_timezone_set('Africa/Johannesburg');
include 'config/database.php';
include 'function.php';
// include 'includes/comment.inc.php';
?> 
 
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
        $imagecount = get_like();
        $commentcount = get_comment();
        echo "<p><h1>Welcome $user</h1></p>";
    ?>
<table>
    <tr>
        <td>
<?php
    if($user == $_SESSION['userUid'])
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
                <img src="uploads/'.$row[$i].'" width="200" height="100">
                <form action="includes/public_id.inc.php" method="POST">
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

<?php
if(isset($_GET['photoid']) == "get")
{
   $idimage = $_SESSION['image_name'];
  
   
   echo '<table border="2">
   <tr>
       <form action="includes/public.inc.php" method="POST">
           <input type="hidden" name="username" value="'.$user.'">
           <input type="hidden" name="comm_id" value="'.$idimage.'">
           <input type="hidden" name="date" value="'.date('Y-m-d H:i:s').'">
           <textarea name="message" pattern="'.htmlspecialchars('[A-Za-z]{3}').'"></textarea><br>
           <button style="width:90px" type="submit" name="comment_id" value="'.$idimage.'">POST</button>
       </form>
   </tr>
   </table>';
}
?>
</tr>
</table>

<div  style="overflow:scroll; height:150px;width:600px"> 
<?Php
if(isset($_GET['comment']) == "saved")
{
    $comm = $_SESSION['id_comm'];
    $pic_id = $_SESSION['id_image'];
    $user_id = $_SESSION['user_id'];
    
    try
    {
            $sql = "SELECT comment FROM comments WHERE imageId='$pic_id' ORDER BY commentId DESC;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $i = 0;
            $len = count($row);
            while($i < $len)
            {
                
                echo 'PostedBy: '.$user_id.'<div class="direct"><a href="'.'uploads/'.$pic_id.'">
                      <img style="width:50px;height:50px" src="uploads/'.$pic_id.'" width="600" height="400">'.$row[$i].'</div>';
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
<?php 
    include "footer.php";

?>