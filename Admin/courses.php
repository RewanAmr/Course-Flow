<?php
session_start();
require_once "../connection.php";

if(!isset($_SESSION["email"]))
{
  header("location:index.php");
}

if(isset($_POST["submit"]))
{
    $sql = "INSERT INTO coursetable (course_id, types, course_name, seat_limit, course_fee, examfee) VALUES (:course_id, :types, :course_name, :seat_limit, :course_fee, :examfee)";    $stmt = $connect->prepare($sql);
    $stmt->execute(array(
    ':course_id' => $_POST['course_id'],
    ':types' => $_POST['types'],
    ':course_name' => $_POST['course_name'],
    ':seat_limit' => $_POST['seat_limit'],
    ':course_fee' => $_POST['course_fee'],
    ':examfee' => $_POST['examfee'],
));
    header("location:Addcourses.php");
}
?>
<?php
if(isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $sql ="DELETE FROM coursetable WHERE course_id = :course_id";
    $stmt = $connect->prepare($sql);
    $stmt->execute(array(
        ':course_id' => $_GET['course_id']     
    ));
    header("location:courses.php");
}
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

        .btn.btn-yes {
          width: 100%;
          padding: 10px;
          font-size: 10pt;
          font-weight: bold;
          background-color: transparent;
          border: 1px solid #232c54;
          color:white;
        }

        .modal-content {
          background-image: url("../img/bg1.jpeg");
          background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
        }
        .btn.btn-yes:hover {
          background-color: #232c54;
        }
        .btn.btn-success {
          background-color: #232c54;
        }

    </style>
    <title>Add course</title>
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
<div class="container mt-5">
  <div class="row justify-content-center">
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
    <h4 class="mb-0">Course</h4>
    </div>
     <div class="card-body">

     <form action="courses.php" method="post" autocomplete="off">

  <table id="example" class="table table-striped text-center">
    <thead> 
            <th>Course Id</th>
            <th>course Type</th>
            <th>Course Name</th>
            <th>Seat Limit</th>
            <th>course  Fee </th>
            <th>Exam Fee </th>
            <th>Edit</th>
            <th>Delete</th>

    </thead>
<tbody>  
<?php
$stmt = $connect->query("SELECT * FROM coursetable");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{
?>
        <tr>
            <td><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['types']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['seat_limit']; ?></td>
            <td><?php echo $row['course_fee'];?></td>
            <td><?php echo $row['examfee'];?></td>
            <td><a href="edit.php?course_id=<?php echo $row['course_id']?>" class='btn btn-secondary'>Edit</a></td>
            <td><a class="btn btn-danger" data-toggle="modal" href="#de<?php echo $row['course_id']?>">Delete</a>
            <div class="modal" id="de<?php echo $row['course_id']?>"> 
            <div class="modal-dialog"> 
              <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title">Delete Confirmation!!!</h4> 
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   </div> 
                    <div class="modal-body"> Are you sure to delete <b><?php echo $row['course_name'] ?></b> ? </div> 
                    <div class="modal-footer"> <a href="courses.php?course_id=<?php echo $row['course_id']?>" class="btn btn-yes">Yes</a> 
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                   </div>
                   </div> 
                  </div>
                 </div>
                 </td>
        </tr>
<?php
    }
?>
</tbody>
</table>
</div>
 </div>
</div>
</div>
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




<script src="../bootstrap/dist/js/bootstrap.js">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html>