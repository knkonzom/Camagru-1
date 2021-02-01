<?php
//include 'config/database.php';
include "./config/setup.php";

$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?> 
<body>
 <div class="nev">   
        <nav> 
            <ul>
                <button style="width:200px;float:left;font-size:20px"type="submit" ><a href="index.php">Home</a></button>
            </ul>
        </nav>
    </div> <br>
    <?php
        echo "<p><h1>Welcome </h1></p>";
    ?>
<table>
    <tr>
        <td>
<?php
   
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
                <img src="uploads/'.$row[$i].'" width="200" height="100">';
              $i++;           
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
?>
</td>
</tr>
</table>
</body>
<?php 
    include "footer.php";

?>