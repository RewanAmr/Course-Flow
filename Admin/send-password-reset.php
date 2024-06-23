<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="AdminLogin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->
    <title>Reset Password</title>
</head>
<body>
    

    <section class="d-flex justify-content-center align-items-center">
        <div class="container gradient1 container1">
            <div class="background-img">
                <div class="box">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="content">
                        <h1 class="mt-4">Password Reset</h1>

                        <?php
                        // Your PHP code for sending password reset email here

                        $email = $_POST["email"];

                        $token = bin2hex(random_bytes(16));

                        $token_hash = hash("sha256", $token);

                        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

                        // Include your connection.php file
                        require __DIR__ . "/connection.php";

                        // Use the $connect PDO object for the database connection
                        $sql = "UPDATE adminlogin
                                SET reset_token_hash = ?,
                                    reset_token_expires_at = ?
                                WHERE email = ?";

                        $stmt = $connect->prepare($sql);

                        $stmt->bindParam(1, $token_hash);
                        $stmt->bindParam(2, $expiry);
                        $stmt->bindParam(3, $email);

                        $stmt->execute();

                        if ($stmt->rowCount()) {
                            // Retrieve admin name from the database
                            $getNameSql = "SELECT name FROM adminlogin WHERE email = ?";
                            $getNameStmt = $connect->prepare($getNameSql);
                            $getNameStmt->bindParam(1, $email);
                            $getNameStmt->execute();

                            if ($getNameStmt->rowCount()) {
                                $adminData = $getNameStmt->fetch(PDO::FETCH_ASSOC);
                                $adminName = $adminData["name"];

                            // Include your mailer.php file
                            $mail = require __DIR__ . "/mailer.php";

                            $mail->setFrom("noreply@example.com");
                            $mail->addAddress($email);
                            $mail->Subject = "Password Reset";
                            $mail->Body = <<<END
                            Hello $adminName,
                            Click <a href="http://localhost/CourseFlow/Admin/reset-password.php?token=$token">here</a> 
                            to reset your password.
                            END;

                            try {
                                $mail->send();
                                echo '<p class="mt-4">Message sent, please check your inbox.</p>';
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                            }
                        }
                    }
                        ?>

                        <!-- Back to index.php button -->
                        <a href="index.php" class="btn btn-secondary mt-4" style="height:30px;width:150px; background-color: transparent; color: white;">Back to Home</a>

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
