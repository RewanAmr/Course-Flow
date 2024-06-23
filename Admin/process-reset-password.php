<?php

// Check if "token" parameter is present in the URL
if (!isset($_POST["token"])) {
    die("Token not provided");
}

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

// Include your connection.php file
$pdo = require __DIR__ . "/connection.php";

$sql = "SELECT * FROM adminlogin
        WHERE reset_token_hash = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$token_hash]);

$adminlogin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($adminlogin === false) {
    die("Token not found");
}

if (strtotime($adminlogin["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password = $_POST["password"];

$sql = "UPDATE adminlogin
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$password, $adminlogin["id"]]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Password Updated</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="AdminLogin.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png"><!-- Favicon / Icon -->
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
                        <h1 class="mt-4">Password Updated</h1>
                        <p>You can now login.</p>

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
