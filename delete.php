<?php
    require "connect.php";
    $id=$_GET['id'];
    $sql="DELETE FROM `movies` WHERE `movie_id`={$id}";
    $connect->exec($sql);
    header("Location:list.php");
?>