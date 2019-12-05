<?php
function get_like()
{
    try {
        $DB_DSN = "localhost";
        $DB_USER = "root";
        $DB_PASSWORD = "mummyisgood";

        $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql2 = "SELECT likes_count FROM webcamimage ORDER BY idCamImage DESC"; // WHERE imgfullNameCam ='$imageId'
        $stmt = $conn->prepare($sql2);
        $stmt->execute();

        if ($row = $stmt->fetchAll(PDO::FETCH_COLUMN)) {
            // session_start();
            // $_SESSION['num_like'] = $row['likes_count'];
            $conn = null;
            return ($row);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_comment()
{
    try {
        $DB_DSN = "localhost";
        $DB_USER = "root";
        $DB_PASSWORD = "mummyisgood";

        $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql2 = "SELECT likes_count FROM comments ORDER BY CommentId DESC"; // WHERE imgfullNameCam ='$imageId'
        $stmt = $conn->prepare($sql2);
        $stmt->execute();

        if ($row = $stmt->fetchAll(PDO::FETCH_COLUMN)) {
            // session_start();
            // $_SESSION['num_like'] = $row['likes_count'];
            $conn = null;
            return ($row);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}