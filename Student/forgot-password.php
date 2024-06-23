<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="FP.css">
        <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->

    <title>Forgot Password</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light gradient1">
        <div class="container">

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
    
            </div>
        </div>
    </nav>

    <section class="d-flex justify-content-center align-items-center">
        <div class="container gradient1 container1">
            <div class="background-img">
                <div class="box">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="content">
                        <h1 class="mt-4">Forgot Password</h1>
                        <form method="post" action="send-password-reset.php" autocomplete="off">
                            <div class="login-form">
                                <?php
                                if(isset($message))
                                {
                                    echo '<label class="text-danger">'.$message.'<label>';
                                }
                                ?>
                                <div class="form-group row mb-2" style="text-align: left;">
                                    <label class="col-md-4 col-form-label text-md-right h4">Email</label>
                                <input type="email" class="form-control2" name="email" placeholder="Email" required="required" style="background-color: transparent; color: white; caret-color: white; ::placeholder { color: white; }">
                                </div>

                                <p class="form-footer mt-24 t-14">We will send reset link to this email.</p>

                                <div class="mb-2">
                                    <button type="submit" name="submit" style="height:30px;width:150px; background-color: transparent; color: white;">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="../bootstrap/dist/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
