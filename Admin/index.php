<?php  
 session_start(); 
 require_once "../connection.php"; 

 if(isset($_SESSION["email"]))
 {
  header("location:Addcourses.php");
 }
 try  
 {  
  $connect = new PDO('mysql:host=localhost;dbname=courseflow','root','');  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["submit"]))  
      {  
           if(empty($_POST["email"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM adminlogin WHERE email = :email AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'email'=>$_POST["email"],  
                          'password'=>$_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["email"] = $_POST["email"];  
                     header("location:Addcourses.php");  
                }  
                else  
                {  
                     $message = '<label>Email or Password is incorrect!</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="AdminLogin.css">
        <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->

    <title>Login</title>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-light gradient1">
        <div class="container">
        <a href="../index.html" style="font-weight: bold;font-size: 20px; color: black; text-decoration: none;">Home</a>
          
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            </div>
          </div>
        </div>
      </nav>

<section>
        <div class="container gradient1 container1">
          <div class="background-img">
            <div class="box">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              <div class="content">
                <h1 class="mt-4">Add courseflow</h1>
                  <form method="POST" action="index.php" autocomplete="off">
                        <div class="login-form">
                        <?php
            if(isset($message))
            {
                echo '<label class="text-danger">'.$message.'</label>';
            }
            ?>
                                <div class="form-group row mb-2"  style="text-align: left;">
                                    <label class="col-md-4 col-form-label text-md-right h4 ">Email</label>
                                    <input type="text" class="form-control2" name="email" placeholder="Email" required="required">
                                </div>
                                <div class="form-group row mb-2 " style="text-align: left;">
                                    <label class="col-md-4  col-form-label text-md-right h3">Password</label>
                                    <input type="password" class="form-control2" name="password" placeholder="Password" required="required">
                                </div>
                                <div class="mb-2">
                                  <input type="submit" name="submit" value="Sign In" style="height:30px;width:70px">
                                </div>
                                <div class="clearfix">
                                    <label class="float-left form-check-label mb-2"><input type="checkbox"> Remember me</label>
                                </div>        
                           
                             <div class="text-dark">
                            <a href="forgot-password.php"  class="text-center text-white ">Forgot Password?</a>
                              </div>      
                            </div>
                        </div>
                    </form>
              </div>
            </div>
        </div>
</section>
<script src="../bootstrap/dist/js/bootstrap.js">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
