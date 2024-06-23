<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'courseflow') or die('connection failed');

$day = $_POST['day'];
$member = $_POST['member'];
$subject = $_POST['subject'];
$cys = $_POST['cys'];
$remarks = $_POST['remarks'];
$room = $_POST['room'];
$m = $_POST['m'];
$query = "INSERT INTO schedule (time_id, day, member_id, subject_code, remarks, settings_id, encoded_by) 
          VALUES ('$day', '$m', '$member', '$subject', '$remarks', '1', '27')";

if (mysqli_query($conn, $query)) {
    
} else {
   
}

mysqli_close($conn);
