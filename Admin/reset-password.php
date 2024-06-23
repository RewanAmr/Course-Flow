<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

try {
    $pdo = require __DIR__ . "/connection.php"; // Include the PDO connection

    $sql = "SELECT * FROM adminlogin WHERE reset_token_hash = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $token_hash);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {
        die("Token not found");
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        die("Token has expired");
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
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
                        <h1 class="mt-4">Reset Password</h1>

                        <form method="post" action="process-reset-password.php">
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                        <div class="form-group row mb-2" style="text-align: left;">
                        <label class="col-md-4 col-form-label text-md-right h3">New</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control2" id="password" name="password" placeholder="New Password" style="height: 30px; width: 150px; background-color: transparent; color: white;" required="required">
                        </div>
                        </div>

                        <div class="form-group row mb-2" style="text-align: left;">
                        <label class="col-md-4 col-form-label text-md-right h3">Repeat</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control2" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password" style="height: 30px; width: 150px; background-color: transparent; color: white;" required="required">
                        </div>
                        </div>

                        <button style="height: 30px; width: 150px; background-color: transparent; color: white;">Send</button>
                        </form>


                        <!-- Back to index.php button -->
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
