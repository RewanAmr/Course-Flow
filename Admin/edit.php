<?php
session_start();
require_once "../connection.php";
if(!isset($_SESSION["email"]))
{
  header("location:AdminLogin.php");
}
?>

<?php
    if(isset($_POST['submit']))
    {
      $course_id = $_POST['course_id'];
      $types = $_POST['types'];

      $course_name = $_POST['course_name'];
      $seat_limit = $_POST['seat_limit'];
      $seat_available = $_POST['seat_available'];
      $course_fee = $_POST['course_fee'];
      $examfee = $_POST['examfee'];


    $stmt = $connect->prepare('UPDATE coursetable SET types = :types, course_name = :course_name, seat_limit = seat_limit + :seat_limit, seat_available = seat_available + :seat_limit, course_fee = :course_fee, examfee = :examfee WHERE course_id = :course_id');
         $stmt->execute(array(':types' => $types,':course_name' => $course_name,':seat_limit' => $seat_limit,':course_id'=>$course_id,':course_fee'=>$course_fee,':examfee'=>$examfee ));
        // $stmt->execute();
  header("location:Addcourses.php");
    }


    $course_id=$_GET['course_id'];
    $stmt = $connect->prepare('SELECT *  FROM coursetable WHERE course_id=:course_id');
    
    $stmt->execute(array(':course_id' => $course_id));
    $coursetable = $stmt->fetch(PDO::FETCH_ASSOC);

    //$row = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >

    <link rel="stylesheet" href="courses.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
   
 
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->

    <style>
        body {
            background-color: transparent;
        }
          .container {
            margin-top: 20px;
        }


  .card {
            border-radius: 10px;
            border-color: #052a5c;
            color: #ffffff;
            background-color: transparent;
            box-shadow: 0 20px 50px rgb(23, 32, 90);
            border: 2px solid #2a3cad;
            color: white;
        }

       .card-header {
            background-color: transparent;
            color: #ffffff;
            border-color: #052a5c;
        }

          .card-body {
            border-radius: 0 0 15px 15px;
            background-color: transparent;
            color: #ffffff;
            border-color: #052a5c;
        }

        

     .btn.btn-secondary {
          width: 100%;
          padding: 10px;
          font-size: 10pt;
          font-weight: bold;
          background-color: transparent;
          border: 1px solid #232c54;
        }

        .btn.btn-secondary:hover {
          background-color: #232c54;
        }   
                

     .btn.btn-danger {
          width: 100%;
          padding: 10px;
          font-size: 10pt;
          font-weight: bold;
          background-color: transparent;
          border: 1px solid #232c54;
        }

        .btn.btn-danger:hover {
          background-color: #232c54;
        }   
         .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }
        .btn.btn-primary {
          width: 100%;
          padding: 10px;
          font-size: 10pt;
          font-weight: bold;
          background-color: transparent;
          border: 1px solid #232c54;
        }

        .btn.btn-primary:hover {
          background-color: #232c54;
        }
  

    </style>
    </head>
<body>


<section>
<nav class="navbar navbar-expand-lg navbar-dark mb-3">
        <div class="container justify-content-around">
        <div class=" container col-11 px-5 pt-2 bg">
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

<section>
<form action="edit.php" method="post" autocomplete="off"> 
<div class="container">
<div class="row">
    <div class="col-md-3">
    </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                 Edit Course 
                </div>
           
<div class="card-body">
<input type="hidden" value="<?php echo $coursetable['course_id']; ?>" name="course_id">

<div class="form-group">
  <label for="types">course type</label>
  <input type="text" value="<?php echo $coursetable['types'];?>" class="form-control" id="types" name="types" placeholder="course type" required />
</div>

<div class="form-group">
    <label for="course_name">Course Name  </label>
    <input type="text" value="<?php echo $coursetable['course_name'];?>" class="form-control" id="course_name" name="course_name" placeholder="Course_name" required />
</div>

<div class="form-group">
    <label for="seat_limit">Seat limit  </label>
    <input type="text" value="<?php echo $coursetable['seat_limit'];?>" class="form-control" id="seat_limit" name="seat_limit" placeholder="seat_limit" disabled />
  </div> 

  <div class="form-group">
    <label >Add seat</label>
    <input type="text" value="<?php echo $coursetable['seat_limit'];?>" class="form-control" id="seat_limit" name="seat_limit" placeholder="add_seat" required />
  </div> 


  <div class="form-group">
    <label>course  Fee </label>
    <input type="text" value="<?php echo $coursetable['course_fee'];?>" class="form-control" id="course_fee" name="course_fee" placeholder="course  Fee" required />
</div>

<div class="form-group">
    <label for="examfee">Exam Fee </label>
    <input type="text" value="<?php echo $coursetable['examfee'];?>" class="form-control" id="examfee" name="examfee" placeholder="examfee" required />
</div>   

 <button type="submit" name="submit" class="btn btn-primary">submit</button>

</div>
</div>
</div>
</div>
</form>
</section> 

<br>
<br>
<div class="col-sm-4 col-md-8 offset-md-2 ">
<div style="color:skyblue; border-top: 2px solid;"></div>
</div>
<footer class="text-center">
      <pre>
        <code>
        Copyright ©2023-2024 Course Flow, All Rights Reserved.
          Department of IT,Egyption E-learning University
        </code>
      </pre>
</footer> 

</body>
</html>                 