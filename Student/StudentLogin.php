<?php
 session_start();
 require_once "connection.php";
 if(isset($_SESSION["roll_no"]))
 {
  header("location:coursetable.php");
 }
 try
 {  
  $connect = new PDO('mysql:host=localhost;dbname=courseflow','root','');  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["submit"]))
      {  

           
                $query = "SELECT * FROM studentsignup WHERE roll_no = :roll_no AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'roll_no'=>$_POST["roll_no"],  
                          'password'=>$_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();
                if($count > 0)  
                {  
                     $_SESSION["roll_no"] = $_POST["roll_no"];  
                     header("location:coursetable.php");  
                }  
                else  
                {  
                     echo '<script>alert("Failed to register. Please try again.");</script>';  
                }  
           }  
      }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>
 <?php
require_once "connection.php";

$alertMessage = ""; // Initialize the alert message variable


if (isset($_POST['register'])) {
    $student_name = $_POST['student_name'];
    $roll_no = $_POST['roll_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile_no = $_POST['mobile_no'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

        // Check if the passwords match
        if ($password !== $confirm_password) {
            echo '<script type="text/javascript"> window. onload = function () { alert("Password and Confirm Password do not match. Please try again."); } </script>';        } else {
            // Check if the roll number is already taken
            $checkQuery = "SELECT * FROM studentsignup WHERE roll_no = :roll_no";
            $checkStatement = $connect->prepare($checkQuery);
            $checkStatement->execute([':roll_no' => $roll_no]);
            $rowCountGreaterThanZero = $checkStatement->rowCount() > 0;
            if ($rowCountGreaterThanZero) {
$registerAlert = "Roll number already taken. Please choose a different one.";
            } else {
                // Insert the new record if the roll number is not taken and passwords match
                $insertQuery = "INSERT INTO studentsignup(student_name,roll_no,email,address,mobile_no,password,confirm_password) 
                                VALUES (:student_name,:roll_no,:email,:address,:mobile_no,:password,:confirm_password)";

                $stmt = $connect->prepare($insertQuery);
                $stmt->execute(array(
                    ':student_name' => $student_name,
                    ':roll_no' => $roll_no,
                    ':email' => $email,
                    ':address' => $address,
                    ':mobile_no' => $mobile_no,
                    ':password' => $password,
                    ':confirm_password' => $confirm_password,
                ));

                $count = $stmt->rowCount();
                if ($count > 0) {
                    $_SESSION['roll_no'] = $roll_no;
                    header("location: coursetable.php");
                } else {
                $_SESSION['register_alert'] = "Failed to register. Please try again.";
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="StudentLogin.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->


</head>
<body>
<section>
    <nav class="navbar navbar-expand-lg navbar-light gradient1">
        <div class="container">
          <a href="../index.html" style="font-weight: bold;font-size: 20px; list-style: none; color: black; text-decoration: none;">Home</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
          </div>
        </div>
      </nav>
</section>


<section>
        <div class="container gradient1 container1">
          <div class="background-img">
            <div class="box">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <div class="content">
                <h1 class="mt-4">PUAIS</h1>
                <form action="StudentLogin.php" method="post" autocomplete="off"> 
                        <div class="login-form">
                                <div class="form-group row mb-2"  style="text-align: left;">
                                    <label class="col-md-4 col-form-label text-md-right h4 ">Student Roll</label>
                                    <input type="text" name="roll_no" class="form-control1" placeholder="Student Roll" required="required">
                                </div>
                                <div class="form-group row mb-2 " style="text-align: left;">
                                    <label class="col-md-4  col-form-label text-md-right h3">Password</label>
                                    <input type="password" name="password" class="form-control1" placeholder="Password" required="required">
                                </div>
                                <div class="mb-2">
                                  <input type="submit" name="submit" value="Sign In" style="height:30px;width:70px">
                                </div>
                                <div class="clearfix">
                                    <label class="float-left form-check-label mb-2"><input type="checkbox"> Remember me</label>
                                </div>        
                          
                            <div class="text-dark">
                            <a href="forgot-password.php"  class="text-center text-white ">Forgot Password?</a>
                            <p>
                              <a class="text-white" data-toggle="modal" href="#exampleModalCenter">Create an Account</a>
                            </p>
                            </div>
                        </div>
                     </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
</section>


<section>
      <div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header">
                <?php
    if (isset($message)) {
        echo '<label class="text-danger">' . $message . '<label>';
    }

    if (isset($_SESSION['register_alert'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['register_alert'] . '</div>';
        unset($_SESSION['register_alert']); // Clear the alert message from session
    }
    ?>
                  <h5 class="modal-title" id="exampleModalLongTitle">Student Registration Form</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <form class="inbox" action="StudentLogin.php" method="post" enctype="multipart/form-data" >
                <div class="modal-body modal-xl">
                  <div class="container inbox">
                    <div class="row justify-content-center">       
                        <div class="col-md-7">
                        
                                <div class="form-group row ">
                                <div class="form-group col-6">
                                    <label for="exampleInput">Full Name : </label>
                                    <input type="name" name="student_name" class="form-control" id="exampleInputname" placeholder="Full Name" required>
                                  </div>
            
                                  <div class="form-group col-6">
                                    <label for="exampleInput">Roll No. : </label>
                                    <input type="roll no." name="roll_no" class="form-control"  placeholder="Registration No." required>
                                  </div>
                                </div>
        
                      <div class="form-group row">
                          <div class="form-group col-6">
                              <label for="exampleInput">Email : </label>
                              <input type="email" name="email" class="form-control" id="exampleInputemail" placeholder="Email" required>
                            </div>
                          <div class="form-group col-6">
                                  <label for="exampleInput">Mobile No :</label>
                                  <input name="mobile_no" class="form-control" id="exampleInputmobile" placeholder="Mobile No." required>
                              </div>

                        </div>

                          <div class="form-group col-md-12 ">
                              <label for="specify">Address</label>
                              <textarea class="form-control" name="address" id="specify" name="" placeholder="Address"></textarea>
                          </div>
                          <div class="form-group row">
                                  <div class="form-group col-6">
                                      <label for="exampleInput">Password : </label>
                                      <input type="password" name="password" class="form-control" id="exampleInputpassword" placeholder="Password" required>
                                  </div>
                                  <div class="form-group col-6">
                                  <label for="exampleInput">Confirm Password : </label>
                                  <input type="text" name="confirm_password" class="form-control" id="exampleInputconfirmpassword" placeholder="Condfirm Password" required>
                                  </div>
                            </div>
                            </div> 
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <div class="form-group mt-2">
                          <div class="col-md-12">
                              <button type="submit" name="register" class="btn btn-primary" onclick="return validateForm();">
                                  Register
                              </button>
                          </div>
                      </div>
                  </div>
      </form>
              </div>
            </div>
            </div>
</section>   
<script>
function validateForm() {
    try {
        eml = document.getElementById('exampleInputemail').value;
        password = document.getElementById('exampleInputpassword').value;
        confirm_password = document.getElementById('exampleInputconfirmpassword').value;
        rowCountGreaterThanZero = <?php echo json_encode($rowCountGreaterThanZero); ?>;

        if (eml.indexOf('@') == -1) {
            alert("Invalid Email address");
            return false;
        }

        if (password !== confirm_password) {
            alert("Password and Confirm Password do not match. Please try again.");
            return false;
        }
        if (rowCountGreaterThanZero) {
        alert("Roll number already taken. Please choose a different one.");
        return false;
    }

        return true;
    } catch (e) {
        return false;
    }

    return false;
}
</script>
</script>

    <script src="../bootstrap/dist/js/bootstrap.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>