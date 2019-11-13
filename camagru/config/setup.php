<?php
    include "database.php";

  try
  {
      $sql = "CREATE TABLE IF NOT EXISTS `images`
      (
          `image_Id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
          `image_src` VARCHAR(255) NOT NULL,
          `user_Id` INT(11),
          `username` VARCHAR(255) NOT NULL,
          FOREIGN KEY (`user_Id`) REFERENCES users(`idUsers`)
      )";
      $conn->exec($sql);

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
          `commentId` INT(11) UNSIGNED AUTO_INCREMENT,
          `comment`    VARCHAR(255) NOT NULL,
          `imageId`    INT(11) NOT NULL,
          `username`   VARCHAR(50) NOT NULL,
          PRIMARY KEY (commentId)
      )";
      $conn->exec($sql);
  }
  catch(PDOException $e)
  {
    echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;