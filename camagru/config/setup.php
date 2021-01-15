<?php
    include "database.php";

    try {
        $conn->exec("CREATE DATABASE IF NOT EXISTS `camagru`");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  try
  {
      $sql = "CREATE TABLE IF NOT EXISTS `users`
      (
        `idUsers` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `uidUsers` VARCHAR(255) NOT NULL,
        `emailUsers` VARCHAR(255) NOT NULL,
        `pwdUsers` VARCHAR(255) NOT NULL,
        `token` VARCHAR(255) NOT NULL,
        `verified`  BOOLEAN DEFAULT 0 NOT NULL
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `Comments`
      (
          `commentId` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `update_userId` INT NOT NULL,
          `username`   VARCHAR(128) NOT NULL,
          `imageId`    VARCHAR(255) NOT NULL,
          `date`        datetime NOT NULL,
          `comment`    TEXT NOT NULL,
          `likes_count` INT(11) NOT NULL,
          FOREIGN KEY (update_userId) REFERENCES users(idUsers)
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `PwdReset`
      (
          `pwdResetId` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
          `pwdResetEmail`  TEXT NOT NULL,
          `pwdResetSelector` TEXT NOT NULL,
          `pwdResetToken` LONGTEXT NOT NULL,
          `pwdResetExpire` TEXT NOT NULL
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `webcamimage`
      (
          `idCamImage` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
          `update_userId` INT NOT NULL,
          `imgfullNameCam` LONGTEXT NOT NULL,
          `username` TEXT NOT NULL,
          `userEmail` VARCHAR(255) NOT NULL,
          `likes_count` INT(11) NOT NULL,
          `orderCamImage` TEXT NOT NULL,
          FOREIGN KEY (update_userId) REFERENCES users(idUsers)
          
      )";
      $conn->exec($sql);

     // echo '<strong><p style="font-size:20px;color:green">Your table has been created successfully</p></strong>';
  }
  catch(PDOException $e)
  {
    echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;