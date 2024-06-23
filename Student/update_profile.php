<?php

include 'aa.php';
session_start();
$user_id = $_SESSION['roll_no'];

if(isset($_POST['update_profile'])){

   $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);

   mysqli_query($conn, "UPDATE `studentsignup` SET  student_name = '$student_name' WHERE roll_no = '$user_id'  ") or die('query failed');

   mysqli_query($conn, "UPDATE `studentsignup` SET  email='$email' WHERE roll_no = '$user_id'  ") or die('query failed');
   
   mysqli_query($conn, "UPDATE `studentsignup` SET  mobile_no='$mobile_no' WHERE roll_no = '$user_id'  ") or die('query failed');
   
   mysqli_query($conn, "UPDATE `studentsignup` SET  address='$address' WHERE roll_no = '$user_id'  ") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, ($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, ($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, ($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `studentsignup` SET password = '$confirm_pass' WHERE roll_no = '$user_id'") or die('query failed');
         mysqli_query($conn, "UPDATE `studentsignup` SET  confirm_password='$confirm_pass' WHERE roll_no = '$user_id'  ") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   
   
     

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="update_profile_.css">
    <title>Update Profile</title>

   <!-- custom css file link  --> 

</head>
<body >
   

<section>

<nav class="navbar navbar-expand-lg navbar-dark mb-3">
        <div class="container justify-content-around">
        <div class=" container col-12 px-5 pt-2 bg">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  me-auto mb-2 mb-lg-0 navhover">
            <li class="nav-item mx-2">
            <a class="nav-link text-white" aria-current="page" href="coursetable.php">Select Courses</a>
            </li>
            <li class="nav-item mx-2">
            <a class="nav-link text-white" aria-current="page" href="pending.php">Pending Request</a>
            </li>
            <li class="nav-item mx-2">
            <a class="nav-link text-white" aria-current="page" href="Approved.php">Approved Request</a>
            </li>
            <li class="nav-item mx-2">
            <a class="nav-link text-white" aria-current="page" href="student_schedule.php">Schedule</a>
            </li>
            <li class="nav-item mx-2">
            <a class="nav-link text-white" aria-current="page" href="update_profile.php">Profile</a>
            </li>
            </ul>
      <form class="d-flex">
        <ul class="navbar-nav  me-auto mb-2 mb-lg-0 navhover">
      <li class="nav-item me-auto">
         <a class="nav-link text-white navhover" href="logout.php">Signout</a>
       </li>
      </ul>
      </form>
      </div>
    </div>
  </div>
</nav>

</section>

<div class="update-profile">

<?php
      $select = mysqli_query($conn, "SELECT * FROM `studentsignup` WHERE roll_no = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      
      <div class="flex">
         
         <div class="inputBox">
           
            <div>
               <span>your name :</span>
               <input type="name" name="student_name" value="<?php echo $fetch['student_name']; ?>" class="box">
            </div>
            
            <div>
               <span>Email :</span>
               <input type="email" name="email" class="box"  value="<?php echo $fetch['email']; ?>">
            </div>
            
         </div>

         <div class="inputBox">
            <div>
               <span>Mobile No :</span>
               <input name="mobile_no" class="box"  value="<?php echo $fetch['mobile_no']; ?>" >
            </div>
            
            <div>
               <span>Address :</span>
               <input class="box" name="address" value="<?php echo $fetch['address']; ?>" >
            </div>
         </div>

         <div class="inputBox">
            <div>
               <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
               <span>old password :</span>
               <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            </div>
            <div>
               <span>new password :</span>
               <input type="password" name="new_pass" placeholder="enter new password" class="box">
            </div>
            <div>
               <span>confirm password :</span>
               <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
            </div>
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn btn-primary">
      
   </form>

</div>

<br>
<br>
<div class="col-sm-4 col-md-8 offset-md-2 ">
<div style="color:#052a5c; border-top: 2px solid;"></div>
</div>

<footer class="text-center">
      <pre>
        <code>
        Copyright ©2023-2024 Add courseFlow, All Rights Reserved.
          Department of IT,Egyption E-learning University
        </code>
      </pre>
</footer>

</body>
</html>