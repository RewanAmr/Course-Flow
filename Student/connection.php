<?php

     try {
        $connect = new PDO('mysql:host=localhost;dbname=courseflow','root','');

       
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       //echo "Connected successfully";
       return $connect;
      } 
      catch(PDOException $e) 
      {
        echo "Connection failed: " . $e->getMessage();
      }
?>