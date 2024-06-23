<?php

include 'config.php';
session_start();
$user_id = $_SESSION['email'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `adminlogin` SET name = '$update_name' WHERE email = '$user_id'") or die('query failed');

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
         mysqli_query($conn, "UPDATE `adminlogin` SET password = '$confirm_pass' WHERE email = '$user_id'") or die('query failed');
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
    <link rel="stylesheet" href="update_profile.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->
    <title>Update Profile</title>

   <!-- custom css file link  --> 

</head>
<body >
   

<section>
    <nav   class="navbar navbar-expand-lg navbar-dark mb-3" >
        <div  class="container justify-content-around">
          <div class="col-md-10 col-xs-6 px-5 pt-2 bg">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  me-auto mb-2 mb-lg-0 navhover">

              <li class="nav-item mx-2">
                <a class="nav-link text-white" href="Addcourses.php">Add Course</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link text-white" href="courses.php">Courses</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link text-white" href="teacherApproval.php">Approval</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link text-white" href="schedule.php">Schedule</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link text-white" href="update_profile.php">Profile</a>
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
      $select = mysqli_query($conn, "SELECT * FROM `adminlogin` WHERE email = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      
      <div class="flex">
         <div class="inputBox">
           
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            
         </div>
         <div class="inputBox">
           
           <span>your name :</span>
           <input type="name" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
           
        </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
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