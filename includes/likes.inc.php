 <?php

if(isset($_POST['like_id']))
{
    // $userlike = $_POST['like_c'];

    include "../config/setup.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $imageId = $_POST['likes_id'];
   
    try
    {
       
        $sql = "UPDATE comments set likes_count = likes_count+1 WHERE imageId = '$imageId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("location: ../HomePage.php?likes=1");
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
else
{
    // echo "not set";
}