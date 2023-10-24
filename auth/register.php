<?php
require_once "../includes/database.php";

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Use placeholders in the SQL query
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $q = $pdo->prepare($sql);

// Bind the variables to the placeholders
    $q->bindParam(':email', $email, PDO::PARAM_STR);
    $q->bindParam(':password', $password, PDO::PARAM_STR);

// Execute the prepared statement
    $q->execute();

    $sql = $sql = "SELECT id FROM users WHERE email = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST["email"]));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION["user_id"] = $data['id'];
    header("location:../index.php");

   database::disconnect();
} else {
    echo "Invalid data received.";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form role="form" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>

                <div class="form-group last">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="submit" name="login" class="btn btn-info btn-sm" value="Register"/>
                    </div>
                </div>
            </form>

            <a href="login.php" class="btn-link link-secondary">Login</a>
        </div>
    </div>
</div>
</body>

