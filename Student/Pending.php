<?php
session_start();
require_once "connection.php";

if(!isset($_SESSION["roll_no"]))
{
  header("location:StudentLogin.php");
}

if(!isset($_SERVER['HTTP_REFERER']))
{
  header('location:coursetable.php');
  exit;
}

?>


<?php
if(isset($_GET['course_id']))
{
    $course_id = $_GET['course_id'];
    $roll_no = $_SESSION['roll_no'];
    //$sql ="DELETE FROM pendingcourse WHERE course_id = :course_id";
   $sql = "DELETE FROM pendingcourse WHERE roll_no = '".$_SESSION['roll_no']."' AND course_id = $course_id  LIMIT 1";
    $stmt = $connect->prepare($sql);
    $stmt->execute(array());
    header("location:Pending.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@1,100&family=Lobster&family=Stalinist+One&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Pending.css">
        <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->

    <title>Pending</title>
</head>
<body>

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

    
    <section>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-12">
        <table class="table table-hover table-bordered text-center">
            <thead>
              <tr>
              <th scope="col">Course Id</th>
                <th scope="col">Type</th>
                <th scope="col">Course</th>
                <th scope="col">ExamType</th>
                <th scope="col">Fee</th>
                <th scope="col">Total Fee</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody>
<?php
$stmt = $connect->query("SELECT a.*,b.totalfee,b.course_fee,b.examfee 
from pendingcourse  a
left join coursetable b on a.course_id=b.course_id WHERE a.status = 0 and a.roll_no ='". $_SESSION["roll_no"]."'");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total=0;
foreach($rows as $row)
{
?>
              <tr>
                <th><?php echo($row['course_id'])?></th>
                <td><?php echo $row['types'];?></td>
                <td><?php echo $row['course_name'];?></td>
                <td><?php echo $row['exam_type']; ?></td>
                <td><?php echo "course Fee:"."$row[course_fee]" .'+' . "Exam Fee:". "$row[examfee]" ; ?></td>
                <td><?php echo $row['course_fee'] + $row['examfee'] ; ?></td>
                
                <td><a class="btn btn-danger" data-toggle="modal" href="#de<?php echo $row['course_id']?>">Delete</a>
            <div class="modal" id="de<?php echo $row['course_id']?>"> 
            <div class="modal-dialog"> 
              <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title">Delete Confirmation!!!</h4> 
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   </div> 
                    <div class="modal-body"> Are you sure to delete <b><?php echo $row['course_name'] ?></b> ? </div> 
                    <div class="modal-footer"> <a href="Pending.php?course_id=<?php echo $row['course_id']?>" class="btn btn-danger">Yes</a> 
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                   </div>
                   </div> 
                  </div>
                 </div>
                 </td>
              </tr>
              <thead>
              <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
<?php	
		 $total=$total+($row['course_fee'] + $row['examfee'] );
}
?>
<th>Total</th>
<th><?php echo number_format($total,2)?></th>         
            </thead>
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

<script src ="../bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>

if(localStorage.getItem("theme") == null)
{
  localStorage.setItem("theme","light");
}

let localdata= localStorage.getItem("theme");

if(localdata == "light")
{
  icon.src="../img/moon.png";
  document.body.classList.remove("dark-mode");
}
else if(localdata =="dark")
{
  icon.src="../img/sun.png";
  document.body.classList.add("dark-mode");
}

function myFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
   if(element.classList.contains("dark-mode"))
   {
    localStorage.setItem("theme","dark");
   icon.src="../img/sun.png";
}
else{
  icon.src="../img/moon.png";
  localStorage.setItem("theme","light");
}
}
</script>

</body>
</html>
