<?php

    session_start();
    session_regenerate_id();
    if(empty($_SESSION) && empty($_SESSION['user_id'])){
        header("location: index.php");
    }

    $user_id=$_SESSION["user_id"];
    require 'connection.php';
    $query="UPDATE `registered_user` SET `image` = 'uploads/default.png' WHERE `registered_user`.`id` = $user_id";
    $result = $conn->query($query); 

    header("location: profile.php");
?>