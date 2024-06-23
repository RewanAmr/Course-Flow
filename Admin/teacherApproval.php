<?php
session_start();
require_once "connection.php";
if(!isset($_SESSION["email"]))
?>
<?php
if(isset($_POST["submit"]))
{ 
	$course=$_POST['course'];
  $roll = $_POST['roll'];
	$sqlp="UPDATE pendingcourse SET status = 1 WHERE course_id = $course AND roll_no = $roll ";
  $stmt=$connect->prepare($sqlp);
  $stmt->execute();
}
?>

<?php
if(isset($_POST["submit"]))
{ 
    $course = $_POST['course'];
    $roll = $_POST['roll'];

    // Update the status to 1 for the selected course and roll number
    $sqlp = "UPDATE pendingcourse SET status = 1 WHERE course_id = $course AND roll_no = $roll";
    $stmt = $connect->prepare($sqlp);
    $stmt->execute();

    // Update the seat_available count for the selected course
    $sqlu = "UPDATE coursetable SET seat_available = seat_limit - (SELECT COUNT(*) FROM pendingcourse WHERE course_id = $course AND status = 1) WHERE course_id = $course";
    $stmt = $connect->prepare($sqlu);
    $stmt->execute();
}
?>

<?php
if(isset($_POST["delete"]))
{ 
    $course = $_POST['course'];
    $roll = $_POST['roll'];

    // Delete the selected course and roll number from the pendingcourse table
    $sql = "DELETE FROM pendingcourse WHERE course_id = $course AND roll_no = $roll";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
}
?>
<?php
$mail = require __DIR__ . "/approvemailer.php";

if (isset($_POST["submit"])) { 
    $course = $_POST['course'];
    $roll = $_POST['roll'];
    
    // Update the pendingcourse table
    $sqlp = "UPDATE pendingcourse SET status = 1 WHERE course_id = $course AND roll_no = $roll";
    $stmt = $connect->prepare($sqlp);
    $stmt->execute();

    // Get student email based on roll number
    $emailSql = "SELECT email FROM studentsignup WHERE roll_no = $roll";
    $emailStmt = $connect->prepare($emailSql);
    $emailStmt->execute();
    $studentEmail = $emailStmt->fetchColumn();

    // Get student email and name based on roll number
    $emailSql = "SELECT email, student_name FROM studentsignup WHERE roll_no = $roll";
    $emailStmt = $connect->prepare($emailSql);
    $emailStmt->execute();
    $result = $emailStmt->fetch(PDO::FETCH_ASSOC);
    $studentEmail = $result['email'];
    $studentName = $result['student_name'];

    // Send email
    $mail = getMailer(); // Assuming getMailer() is a function from mail.php that returns a configured PHPMailer instance
    $mail->addAddress($studentEmail);
    $mail->Subject = "Course Approval Notification";
    $mail->Body = "Hello $studentName,\n\n Your course request for course ID $course has been approved.";

    try {
        $mail->send();
        // Email sent successfully
    } catch (Exception $e) {
        // Handle email sending failure
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Similar modification for the "Delete" case
if (isset($_POST["delete"])) {
    $course = $_POST['course'];
    $roll = $_POST['roll'];

    // Delete from pendingcourse table
    $sql = "DELETE FROM pendingcourse WHERE course_id = $course AND roll_no = $roll";
    $stmt = $connect->prepare($sql);
    $stmt->execute();

    // Get student email based on roll number
    $emailSql = "SELECT email FROM studentsignup WHERE roll_no = $roll";
    $emailStmt = $connect->prepare($emailSql);
    $emailStmt->execute();
    $studentEmail = $emailStmt->fetchColumn();

    // Get student email and name based on roll number
    $emailSql = "SELECT email, student_name FROM studentsignup WHERE roll_no = $roll";
    $emailStmt = $connect->prepare($emailSql);
    $emailStmt->execute();
    $result = $emailStmt->fetch(PDO::FETCH_ASSOC);
    $studentEmail = $result['email'];
    $studentName = $result['student_name'];

    // Send email
    $mail = getMailer(); // Assuming getMailer() is a function from mail.php that returns a configured PHPMailer instance
    $mail->addAddress($studentEmail);
    $mail->Subject = "Course Rejection Notification";
    $mail->Body = "Hello $studentName,\n\n Your course request for course ID $course has been rejected.";

    try {
        $mail->send();
        // Email sent successfully
    } catch (Exception $e) {
        // Handle email sending failure
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!-- Rest of your code -->


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="../bootstrap/dist/css/bootstrap.css" rel="stylesheet" >
    <link rel="stylesheet" href="teacherApproval.css">
        <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->

    <title>Approval</title>
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
    <?php if(isset($_GET['action']) && $_GET['action']=='order' && '". $_GET["roll_no"]."'){?>
    <form action="" method="post">
        <div class="container">    
        <div class="row justify-content-center">
            <div class="col-xs-4 col-md-12">
            <table>
        <table class="table table-hover table-bordered text-center">
            <thead>
              <tr>
              <th scope="col">Student Roll</th>
              <th scope="col">Course Id</th>
                <th scope="col">Type</th>
                <th scope="col">Course</th>
                <th scope="col">ExamType</th>
                <th scope="col">Approve</th>
                <th scope="col">Reject</th>
              </tr>
            </thead>
            <tbody>
       
<?php
$stmt = $connect->query("SELECT a.*, b.seat_limit , b.seat_available FROM pendingcourse a left join coursetable b on a.course_id=b.course_id WHERE status=0 and roll_no='". $_GET["roll_no"]."'");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{
?>
              <tr>
              <td><?php echo $row['roll_no'];?></td>
                <th><?php echo $row['course_id'];?></th>
                <td><?php echo $row['types'];?></td>
                <td><?php echo $row['course_name'];?></td>
                <td><?php echo $row['exam_type']; ?></td>
               
                <form action="" method='POST'>
                <td>
                
                <input type="hidden"  value="<?php echo $row['course_id'];?>" name="course" />
                <input type="hidden"  value="<?php echo $row['roll_no'];?>" name="roll" />
                <input type="hidden"  value="<?php echo $row['seat_limit'];?>" name="seat_limit" />
                <input type="hidden"  value="<?php echo $row['seat_available'];?>" name="seat_available" />
                <button type="submit" name="submit"  class="btn btn-warning mt-2">
                Approve
                </button>
                
                </td>
                </form>
                <form action="" method='POST'>
                <td>
                
                <input type="hidden"  value="<?php echo $row['course_id'];?>" name="course" />
                <input type="hidden"  value="<?php echo $row['roll_no'];?>" name="roll" />
                <button type="submit" name="delete"  class="btn btn-warning mt-2">
               DELETE
                </button>
                
                </td>
                </form>   
              </tr>
              </form>
 <?php
} 
?>
            </tbody>
          </table>
          </div>
          </div>
          </div>
</section>

<section>
    <?php } else { ?>
        <div class="container">    
        <div class="row justify-content-center" id="search_table">
            <div class="col-sm-8 col-md-12">
            <table class="">
        <table class="table table-hover table-bordered text-center">
            <thead>
              <tr>
              <th scope="col">Student Roll</th>
              <th scope="col">Student Name</th>
                <th scope="col">Action</th>
               
              </tr>
            </thead>
            <tbody>
<?php
$stmt = $connect->query("SELECT * FROM studentsignup");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{
?>
              <tr>
              <td><?php echo $row['roll_no'];?></td>
                <td><?php echo $row['student_name'];?></td>
                <td><a href="?action=order&roll_no=<?php echo $row['roll_no'];?>" class="btn btn-sm btn btn-warning" style="width: 120px;"> View</a></td>
                </tr>
<?php
}
}
?>
    </tbody>
          </table>
          </div>
          </div>
          </div>
</section>


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


<script>
function search_data(){
	var search=jQuery('#search').val();
  jQuery.ajax({
		method:'post',
		url:'loadDataT.php',
		data:'search='+search,
		success:function(data){
			jQuery('#search_table').html(data);
		}
	});	
}
</script>

<script src="../bootstrap/dist/js/bootstrap.js">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>