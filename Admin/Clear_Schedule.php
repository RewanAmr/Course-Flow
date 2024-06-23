<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'courseflow') or die('connection failed');
 
$query = "delete from schedule";

if (mysqli_query($conn, $query)) {
    
} else {
   
}

mysqli_close($conn);
