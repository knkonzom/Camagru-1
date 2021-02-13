<?php
$DB_DSN = "localhost";
$DB_NAME = 'camagru';
$DB_USER = "root";
$DB_PASSWORD = "";

try{

    $conn = new PDO("mysql:host=$DB_DSN;", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
   echo "Connection failed: " . $e->getMessage();
}
?> 