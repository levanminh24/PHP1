<?php
  $hostname="localhost";
  /// tên bảng sql
  $db_name="crud";
  $username="root";
  $pass="";
  ///dựng đói tượng pdo
  ///kh cách
  try{
    $connect=new PDO("mysql:host=$hostname;dbname=$db_name",$username,$pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo"kết nối thành công";
  }

  catch(PDOxception $e){
    $e->getMessage();
  }
?>