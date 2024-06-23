<?php
session_start();
require_once "../connection.php";

if(!isset($_SESSION["email"]))
{
  header("location:index.php");
}

if(isset($_POST["submit"]))
{
        // Check if course_id already exists
    $check_sql = "SELECT * FROM coursetable WHERE course_id = :course_id";
    $check_stmt = $connect->prepare($check_sql);
    $check_stmt->execute(array(':course_id' => $_POST['course_id']));
    $existing_course = $check_stmt->fetch(PDO::FETCH_ASSOC);

if($existing_course) {
    // If the course_id already exists, display an alert
    echo '<script type="text/javascript"> window.onload = function () { alert("This ID is already taken. Please choose a different one."); } </script>';
} else {
    // The following lines should be inside the else block
    $sql = "INSERT INTO coursetable (course_id, types, course_name, seat_limit, course_fee, examfee) VALUES (:course_id, :types, :course_name, :seat_limit, :course_fee, :examfee)";    
    $stmt = $connect->prepare($sql);
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
    header("location:Addcourses.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >

    <link rel="stylesheet" href="Addcourses.css">
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Add Course</h4>
                    </div>

                    <div class="card-body">
                        <form action="Addcourses.php" method="post" autocomplete="off">
                            <div class="form-group">
                                <label for="course_id">Course Id</label>
                                <input type="text" class="form-control" id="course_id" name="course_id" placeholder="Course ID" required 
                                                                       value="<?php echo isset($_POST['course_id']) ? htmlspecialchars($_POST['course_id']) : ''; ?>" />
                            </div>

                            <div class="form-group">
                                <label for="types">Course Type</label>
                                <input type="text" class="form-control" id="types" name="types" placeholder="Course Type" required 
                                value="<?php echo isset($_POST['types']) ? htmlspecialchars($_POST['types']) : ''; ?>" />
                            </div>

                            <div class="form-group">
                                <label for="course_name">Course Name</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name" required 
                                       value="<?php echo isset($_POST['course_name']) ? htmlspecialchars($_POST['course_name']) : ''; ?>" />
                            </div>

                            <div class="form-group">
                                <label for="seat_limit">Seat Limit</label>
                                <input type="number" class="form-control" id="seat_limit" name="seat_limit" placeholder="Seat Limit" required 
                                       value="<?php echo isset($_POST['seat_limit']) ? htmlspecialchars($_POST['seat_limit']) : ''; ?>" />
                            </div>

                            <div class="form-group">
                                <label for="course_fee">Course Fee</label>
                                <input type="number" class="form-control" id="course_fee" name="course_fee" placeholder="Course Fee" required 
                                       value="<?php echo isset($_POST['course_fee']) ? htmlspecialchars($_POST['course_fee']) : ''; ?>" />
                            </div>

                            <div class="form-group">
                                <label for="examfee">Exam Fee</label>
                                <input type="number" class="form-control" id="examfee" name="examfee" placeholder="Exam Fee" required 
                                       value="<?php echo isset($_POST['examfee']) ? htmlspecialchars($_POST['examfee']) : ''; ?>" />
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Add Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

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