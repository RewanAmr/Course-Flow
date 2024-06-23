<?php
session_start();
require_once "connection.php";

if (!isset($_SESSION["roll_no"])) {
    header("location:StudentLogin.php");
}

if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location:coursetable.php');
    exit;
}

if (isset($_POST['enroll'])) {
    if (!empty($_POST['chk1']) && !empty($_POST['et'])) {
        $roll_no = $_SESSION['roll_no'];
        $selectbox1 = $_POST['et'];
        $selectbox11 = implode(',', array_filter($selectbox1));
        $i = 0;

        foreach ($_POST['chk1'] as $checkbox1) {
            $selectbox111 = array_diff(explode(",", $selectbox11), array(""));
            $selectbox1111 = isset($selectbox111[$i]) ? $selectbox111[$i] : null;

            $values = explode("|", $checkbox1);
            $course_id = $values[0];
            $types = isset($values[1]) ? $values[1] : null;
            $course_name = isset($values[2]) ? $values[2] : null;

            $sql = "INSERT INTO pendingcourse(roll_no,course_id,types,course_name,exam_type,status) VALUES('$roll_no','$course_id','$types','$course_name','$selectbox1111',0)";
            $stmt = $connect->prepare($sql);
            $stmt->execute();

            $checkbox1 = '';
            $i++;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@1,100&family=Lobster&family=Stalinist+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="course_table.css">
        <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->

    <title>Course Table</title>
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
            <li class="nav-item mx-2">
            <a class="nav-link text-white" aria-current="page" href="http://127.0.0.1:8000">Reminder</a>
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

<form id="form1" action="coursetable.php" method="post"> 
<div class="container mt-3" >
    <div class="accordion mb-4" id="accordionExample" >
        <div class="accordion-item" >
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed fw" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="box-shadow: 0 20px 50px rgb(23, 32, 90);border: 2px solid #2a3cad;color: white;text-align: center;border-radius: 10px;">
               Flutter
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" >
            <div class="accordion-body">
                <table class="table table-bordered border-primary text-center">
                <!-- <p> <input type="checkbox" id="selectAll"/>Select All</p> -->
                    <thead>
                      <tr>
                        <th scope="col-1">Course Id</th>
                        <th scope="col-1">types</th>
                        <th scope="col-7">Course</th>
                        <th scope="col-1">Exam Type</th>
                        <th scope="col-1">Select</th>
                          
                      </tr>
                    </thead>
                    <tbody>                              
<?php
$stmt = $connect->query("SELECT * FROM coursetable Where types = 'Flutter' ");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row)
{

  $course_id = $row['course_id'];
  $types = $row['types'];
  $course_name = $row['course_name'];
?>
                    <tr>
                        <td scope="row"> <?php echo $course_id?></td>
                        <td > <?php echo $types ?></td>
                        <td ><?php echo $course_name ?></td>
                        <td >
                        <select name="et[]" id="selectBox" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" selected="selected">Select Option</option>
                              <option value="Regular" >Regular</option>
                              <option value="Retake">Retake</option>
                              <option value="Recourse">Recourse</option>
                        </select>
                        </td>
                        </td>
                        <td> 
                        <?php if($row['seat_available'] > 0){?>
                     <input type="checkbox" class="ch" id="checked" onclick="check();" name="chk1[]" value="<?php echo $row['course_id']?>|<?php echo $row['types']?>|<?php echo $row['course_name']?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>
                            <?php } else {?>  
                              <input type="checkbox" disabled>
                              <?php }?>  
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




<div class="accordion" id="accordionExample">
        <div class="accordion-item mb-4">
        <div class="accordion-item" >
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed fw" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="box-shadow: 0 20px 50px rgb(23, 32, 90);border: 2px solid #2a3cad;color: white;text-align: center;border-radius: 10px;">
              Python
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <table class="table table-bordered border-primary text-center">
                <!-- <p> <input type="checkbox" id="selectAll1"/>Select All</p> -->
                    <thead>
                      <tr>
                        <th scope="col-1">Course Id</th>
                        <th scope="col-1">types</th>
                        <th scope="col-7">Course</th>
                        <th scope="col-1">Exam Type</th>
                        <th scope="col-1">Select</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
$stmt = $connect->query("SELECT * FROM coursetable Where types = 'Python' ");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{
  
?>
                        <tr>
                        <th scope="row"> <?php echo($row['course_id'])?> </th>
                        <td> <?php echo($row['types'])?></td>
                        <td><?php echo($row['course_name'])?></td>
                        <td >
                        <select name="et[]" id="selectBox" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" selected="selected">Select Option</option>
                              <option value="Regular" >Regular</option>
                              <option value="Retake">Retake</option>
                              <option value="Recourse">Recourse</option>
                         <?php 
                            
                          ?>
                        </select>
                            <td> 
                            <?php if($row['seat_available'] > 0){?> 
                        <input type="checkbox" class="ch1" id="checked" onclick="check();" name="chk1[] " value="<?php echo $row['course_id']?>|<?php echo $row['types']?>|<?php echo $row['course_name']?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>  
                            <?php } else {?>  
                              <input type="checkbox" disabled>
                              <?php }?>
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


    <div class="accordion" id="accordionExample">
        <div class="accordion-item mb-4">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed fw" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="box-shadow: 0 20px 50px rgb(23, 32, 90);border: 2px solid #2a3cad;color: white;text-align: center;border-radius: 10px;">
              Software testing
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <table class="table table-bordered border-primary text-center">
                <!-- <p> <input type="checkbox" id="selectAll2"/>Select All</p> -->
                    <thead>
                      <tr>
                        <th scope="col-1">Course Id</th>
                        <th scope="col-1">types</th>
                        <th scope="col-7">Course</th>
                        <th scope="col-1">Exam Type</th>
                        <th scope="col-1">Select</th>
                      </tr>
                    </thead>
                    <tbody>
 <?php
$stmt = $connect->query("SELECT * FROM coursetable Where types = 'Software' ");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{
  
?>
                        <tr>
                        <th scope="row"> <?php echo($row['course_id'])?> </th>
                        <td> <?php echo($row['types'])?></td>
                        <td><?php echo($row['course_name'])?></td>
                        <td >
                        <select name="et[]" id="selectBox" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" selected="selected">Select Option</option>
                              <option value="Regular" >Regular</option>
                              <option value="Retake">Retake</option>
                              <option value="Recourse">Recourse</option>
                         <?php 
                            
                          ?>
                        </select>
                            <td>
                            <?php if($row['seat_available'] > 0){?>
                        <input type="checkbox" class="ch2" id="checked" onclick="check();" name="chk1[] " value="<?php echo $row['course_id']?>|<?php echo $row['types']?>|<?php echo $row['course_name']?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label> 
                            <?php } else {?>  
                              <input type="checkbox" disabled>
                              <?php }?> 
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

    <div class="accordion" id="accordionExample">
      <div class="accordion-item mb-4">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed fw" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="box-shadow: 0 20px 50px rgb(23, 32, 90);border: 2px solid #2a3cad;color: white;text-align: center;border-radius: 10px;">
           Marketing 
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <table class="table table-bordered border-primary text-center">
            <!-- <p> <input type="checkbox" id="selectAll3"/>Select All</p> -->
                <thead>
                  <tr>
                    <th scope="col-1">Course Id</th>
                    <th scope="col-1">types</th>
                    <th scope="col-7">Course</th>
                    <th scope="col-1">Exam Type</th>
                    <th scope="col-1">Select</th>
                  </tr>
                </thead>
                <tbody>

                <?php
$stmt = $connect->query("SELECT * FROM coursetable Where types = 'Marketing ' ");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{

?>
                    <tr>
                    <th scope="row"> <?php echo($row['course_id'])?> </th>
                        <td> <?php echo($row['types'])?></td>
                        <td><?php echo($row['course_name'])?></td>
                        <td >
                        <select name="et[]" id="selectBox" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" selected="selected">Select Option</option>
                              <option value="Regular" >Regular</option>
                              <option value="Retake">Retake</option>
                              <option value="Recourse">Recourse</option>
                         <?php 
                            
                          ?>
                        </select>
                        <td>  
                        <?php if($row['seat_available'] > 0){?>
                        <input type="checkbox" class="ch3" id="checked" onclick="check();" name="chk1[] " value="<?php echo $row['course_id']?>|<?php echo $row['types']?>|<?php echo $row['course_name']?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label> 
                            <?php } else {?>  
                              <input type="checkbox" disabled>
                              <?php }?> 
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

    <div class="accordion" id="accordionExample">
      <div class="accordion-item mb-4">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed fw" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive" style="box-shadow: 0 20px 50px rgb(23, 32, 90);border: 2px solid #2a3cad;color: white;text-align: center;border-radius: 10px;">
            Design
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <table class="table table-bordered border-primary text-center">
            <!-- <p> <input type="checkbox" id="selectAll4"/>Select All</p> -->
                <thead>
                  <tr>
                    <th scope="col-1">Course Id</th>
                    <th scope="col-1">types</th>
                    <th scope="col-7">Course</th>
                    <th scope="col-1">Exam Type</th>
                    <th scope="col-1">Select</th>
                  </tr>
                </thead>
                <tbody>

                <?php
$stmt = $connect->query("SELECT * FROM coursetable Where types = 'Design' ");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{

?>
                    <tr>
                    <th scope="row"> <?php echo($row['course_id'])?> </th>
                        <td> <?php echo($row['types'])?></td>
                        <td><?php echo($row['course_name'])?></td>
                        <td >
                        <select name="et[]" id="selectBox" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" selected="selected">Select Option</option>
                              <option value="Regular" >Regular</option>
                              <option value="Retake">Retake</option>
                              <option value="Recourse">Recourse</option>
                         <?php 
                            
                          ?>
                        </select>
                         <td>  
                        <?php if($row['seat_available'] > 0){?>
                        <input type="checkbox" class="ch3" id="checked" onclick="check();" name="chk1[] " value="<?php echo $row['course_id']?>|<?php echo $row['types']?>|<?php echo $row['course_name']?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label> 
                            <?php } else {?>  
                              <input type="checkbox" disabled>
                              <?php }?> 
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
 

    <div class="accordion" id="accordionExample">
      <div class="accordion-item mb-4">
      <div class="accordion-item" >
        <h2 class="accordion-header" id="headingSix">
          <button class="accordion-button collapsed fw" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" style="box-shadow: 0 20px 50px rgb(23, 32, 90);border: 2px solid #2a3cad;color: white;text-align: center;border-radius: 10px;">
            Development Courses
          </button>
        </h2>
        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <table class="table table-bordered border-primary text-center">
            <!-- <p> <input type="checkbox" id="selectAll5"/>Select All</p> -->
                <thead>
                  <tr>
                    <th scope="col-1">Course Id</th>
                    <th scope="col-1">types</th>
                    <th scope="col-7">Course</th>
                    <th scope="col-1">Exam Type</th>
                    <th scope="col-1">Select</th>
                  </tr>
                </thead>
                <tbody>

                <?php
$stmt = $connect->query("SELECT * FROM coursetable Where types = 'Development' ");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{

?>
                    <tr>
                    <th scope="row"> <?php echo($row['course_id'])?> </th>
                        <td> <?php echo($row['types'])?></td>
                        <td><?php echo($row['course_name'])?></td>
                        <td >
                        <select name="et[]" id="selectBox" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" selected="selected">Select Option</option>
                              <option value="Regular" >Regular</option>
                              <option value="Retake">Retake</option>
                              <option value="Recourse">Recourse</option>
                         <?php 
                            
                          ?>
                        </select>
                        <td> 
                        <?php if($row['seat_available'] > 0){?> 
                        <input type="checkbox" class="ch5" id="checked" onclick="check();" name="chk1[] " value="<?php echo $row['course_id']?>|<?php echo $row['types']?>|<?php echo $row['course_name']?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label> 
                            <?php } else {?>  
                              <input type="checkbox" disabled>
                              <?php }?> 
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
    <div class="accordion" id="accordionExample">
      <div class="accordion-item mb-4">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingSeven">
          <button class="accordion-button collapsed fw" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" style="box-shadow: 0 20px 50px rgb(23, 32, 90);border: 2px solid #2a3cad;color: white;text-align: center;border-radius: 10px;">
            Business Courses 
          </button>
        </h2>
        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <table class="table table-bordered border-primary text-center">
            <!-- <p> <input type="checkbox" id="selectAll6"/>Select All</p> -->
                <thead>
                  <tr>
                    <th scope="col-1">Course Id</th>
                    <th scope="col-1">types</th>
                    <th scope="col-7">Course</th>
                    <th scope="col-1">Exam Type</th>
                    <th scope="col-1">Select</th>
                  </tr>
                </thead>
                <tbody>

                <?php
$stmt = $connect->query("SELECT * FROM coursetable Where types = 'Business ' ");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row)
{

?>
                    <tr>
                    <th scope="row"> <?php echo($row['course_id'])?> </th>
                        <td> <?php echo($row['types'])?></td>
                        <td><?php echo($row['course_name'])?></td>
                        <td >
                        <select name="et[]" id="selectBox" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="" selected="selected">Select Option</option>
                              <option value="Regular" >Regular</option>
                              <option value="Retake">Retake</option>
                              <option value="Recourse">Recourse</option>
                         <?php 
                            
                          ?>
                        </select>
                        <td>  
                        <?php if($row['seat_available'] > 0){?>
                        <input type="checkbox" class="ch6" id="checked" onclick="check();" name="chk1[] " value="<?php echo $row['course_id']?>|<?php echo $row['types']?>|<?php echo $row['course_name']?>">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>  
                            <?php } else {?>  
                              <input type="checkbox" disabled>
                              <?php }?>
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
   

<div class="container">
  <div class="row">
    <div class="col-md-2 col-xs-6 offset-md-5 mb-3">
    <button type="submit" name="enroll" class="btn btn-warning mt-2">Enroll</button>
    </div>
  </div>
</div>
</form>


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

<script src="../bootstrap/dist/js/bootstrap.js">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
  $(".selectBox").change(function() {
    $(this).parent().siblings().children('input').attr('value',$(this).val());
});
</script>
<script>
$(document).ready(function() {
   $("#form1 #selectAll").click(function()
   {
     $(".ch").prop('checked',this.checked);
   })
});
</script>
<script>
$(document).ready(function() {
   $("#form1 #selectAll1").click(function()
   {
     $(".ch1").prop('checked',this.checked);
   })
});
</script>
<script>
$(document).ready(function() {
   $("#form1 #selectAll2").click(function()
   {
     $(".ch2").prop('checked',this.checked);
   })
});
</script>
<script>
$(document).ready(function() {
   $("#form1 #selectAll3").click(function()
   {
     $(".ch3").prop('checked',this.checked);
   })
});
</script>
<script>
$(document).ready(function() {
   $("#form1 #selectAll4").click(function()
   {
     $(".ch4").prop('checked',this.checked);
   })
});
</script>
<script>
$(document).ready(function() {
   $("#form1 #selectAll5").click(function()
   {
     $(".ch5").prop('checked',this.checked);
   })
});
</script>
<script>
$(document).ready(function() {
   $("#form1 #selectAll6").click(function()
   {
     $(".ch6").prop('checked',this.checked);
   })
});
</script>

<script>
$(document).ready(function() {
   $("#form1 #selectAll7").click(function()
   {
     $(".ch7").prop('checked',this.checked);
   })
});
</script>

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