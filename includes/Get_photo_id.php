<?php
if(isset($_POST['photoid']))
{
    include 'config/database.php';

    $photo_id = $_POST['comm'];
    session_start();
    $_SESSION['pic_id'] = $photo_id;
    echo "$photo_id";
    header("location: ../HomePage.php?photoid=get");
 }