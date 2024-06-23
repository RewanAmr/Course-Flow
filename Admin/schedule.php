<?php
session_start();
require_once "../connection.php";
include 'config.php';

if (!isset($_SESSION["email"])) {
  header("location:index.php");
}
$currentmember=$_SESSION["email"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <title>Schedule</title>
  <link rel="stylesheet" href="schedule.css">
</head>

<body>
 

<section>
    <nav class="navbar navbar-expand-lg navbar-dark mb-3">
        <div class="container justify-content-around">
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


  <section>
    <div class="content-wrapper">
      <div class="container">
        <section class="content">
          <div class="row">
            <div class="col-md-9">
              <div class="box box-warning">
                <div style="text-align: center">
                  <h4>Print Teacher Schedule
                    <a href="#searcht" data-target="#searcht" data-toggle="modal" class="dropdown-toggle btn btn-primary">

                      Teacher Schedule
                    </a>
                     
                  </h4>
                </div>
                <form method="post" id="reg-form">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <table class="table table-bordered table-striped" style="margin-right:-10px">
                          <thead>
                            <tr>
                              <th>Time</th>
                              <th>M</th>
                              <th>W</th>
                              <th>F</th>

                            </tr>
                          </thead>

                          <?php
                          $stmt = $connect->query("select * from time where days='mwf' order by time_start");
                          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($rows as $row) {
                            $id = $row['time_id'];
                            $start = date("h:i a", strtotime($row['time_start']));
                            $end = date("h:i a", strtotime($row['time_end']));
                          ?>
                            <tr>
                              <td><?php echo $start . "-" . $end; ?></td>
                              <td><input type="checkbox" id="check" name="m" value="<?php echo $id; ?>" style="width: 20px; height: 20px;"></td>
                              <td><input type="checkbox" id="check" name="w" value="<?php echo $id; ?>" style="width: 20px; height: 20px;"></td>
                              <td><input type="checkbox" id="check" name="f" value="<?php echo $id; ?>" style="width: 20px; height: 20px;"></td>

                            </tr>

                          <?php
                          }
                          ?>



                        </table>
                      </div><!--col end -->
                      <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Time</th>
                              <th>T</th>
                              <th>TH</th>

                            </tr>
                          </thead>

                          <?php
                          $stmt = $connect->query("select * from time where days='tth' order by time_start");
                          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($rows as $row) {
                            $id = $row['time_id'];
                            $start = date("h:i a", strtotime($row['time_start']));
                            $end = date("h:i a", strtotime($row['time_end']));
                          ?>
                            <tr>
                              <td><?php echo $start . "-" . $end; ?></td>
                              <td><input type="checkbox" name="t" value="<?php echo $id; ?>" style="width: 20px; height: 20px;"></td>
                              <td><input type="checkbox" name="th" value="<?php echo $id; ?>" style="width: 20px; height: 20px;"></td>

                            </tr>


                          <?php
                          }
                          ?>

                        </table>
                        <div class="result" id="form">
                        </div>
                      </div><!--col end-->
                    </div><!--row end-->


                  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-md-3">
              <div class="box box-warning">

                <div class="box-body">
                  <!-- Date range -->
                  <div id="form1">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label style="font-weight: bold;font-size: large;color:white" for="date">Admin</label>
                          <select class="form-control select2" id=teacherddl name="teacher" required>
                            <?php
                            $stmt = $connect->query("select * from adminlogin where email='$currentmember'");
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {

                            ?>
                              <option value="<?php echo $row['id'] ?>"><?php echo $row['email'] ?></option>
                            <?php }

                            ?>
                          </select>



                        </div><!-- /.form group -->

                        <div class="form-group">
                          <label style="font-weight: bold;font-size: large;color:white"> Select Courses </label>
                          <select class="form-control select2" id="subjectddl" name="Subject" required>
                            <?php
                            $stmt = $connect->query("select * from coursetable order by course_id");
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($rows as $row) {

                            ?>
                              <option value="<?php echo $row['course_name']; ?>"><?php echo $row['course_name']; ?></option>
                            <?php }

                            ?>
                          </select>


                        </div><!-- /.form group -->
                     
                        
                        <div style="display: none;" class="form-group">
                          <label style="font-weight: bold;font-size: large;">Remarks</label><br>
                          <textarea id="remarkstxt" name="remarks" cols="44" rows="5" placeholder="enclose remarks with parenthesis()"></textarea>

                        </div><!-- /.form group -->
                      </div>



                    </div>


                    <div class="form-group">

                      <button class="btn btn-lg btn-primary" id="daterange-btn" name="save" type="button">
                        Save
                      </button>
                      <button class="uncheck btn btn-lg btn-success" type="reset">Uncheck All</button>
                      <button id="btn_clear" style="background-color: red !important;" class="btn btn btn-danger mt-2" type="reset">Clear Schedule</button>


                    </div>
                  </div><!-- /.form group -->
                  <hr>

                  </form>
                  <div id="searcht" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content" style="height:auto">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title">Search Faculty Schedule</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" method="post" action="faculty_sched.php" target="_blank">

                            <div class="form-group">
                              <label class="control-label col-lg-2" for="name">Faculty</label>
                              <div class="col-lg-10">
                                <label style="font-weight: bold;font-size: large;color:white" for="date">Admin</label>
                                <select class="form-control select2" id=teacherddl name="teacher" required>
                                  <?php
                                  $stmt = $connect->query("select * from adminlogin where email='$currentmember'");
                                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                  foreach ($rows as $row) {

                                  ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['email'] ?></option>
                                  <?php }

                                  ?>
                                </select>
                              </div>
                            </div>


                        </div>
                        <hr>
                        <div class="modal-footer">
                          <button type="submit" name="search" class="btn btn-primary">Display Schedule</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                      </div>

                    </div><!--end of modal-dialog-->
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
          </div>
        </section>
      </div>
  </section>




  <br>
  <br>
  <div class="col-sm-4 col-md-8 offset-md-2 ">
    <div style="color:skyblue; border-top: 2px solid;"></div>
  </div>
  




  <script src="../bootstrap/dist/js/bootstrap.js">
  </script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="../dist/js/jquery.min.js"></script>
  <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

  <script>
    $(".uncheck").click(function() {
      $('input:checkbox').removeAttr('checked');
    });

    $("#btn_clear").on('click',function(){
      $.ajax({
            type: "POST",
            url: "Clear_Schedule.php", // Adjust the URL to your PHP script
           
            success: function(response) {
               
             
                alert("Cleared succeffully");
                
              
              
              
               // Log the server response
            },
            error: function(error) {
              alert("Error server down");
            }
          });
    }),
     
    $("#daterange-btn").on('click', function() {
      var member = $("#teacherddl").val();
      var subject = $("#subjectddl").val();
      
      var remarks = $("#remarkstxt").val();
     
      var m = $('input:checkbox');
 
var counter=0;
      for (let i = 0; i < m.length; i++) {
        if (m[i].checked) {
          var day = m[i].value;

          // Use AJAX to send data to PHP
          $.ajax({
            type: "POST",
            url: "insert_schedule.php", // Adjust the URL to your PHP script
            data: {
              day: day,
              member: member,
              subject: subject,
             
              remarks: remarks,
             
              m:m[i].name
            },
            success: function(response) {
              if(counter==0)
              {
                alert("Saved succeffully");
                counter++;
              }
              
              
               // Log the server response
            },
            error: function(error) {
             
            }
          });
        }
      }
        
    });
  </script>


</body>

</html>