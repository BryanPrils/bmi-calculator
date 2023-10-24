<?php
session_start();
require '../includes/database.php';
//if ( !empty($_GET['page'])) {
//    $page = $_REQUEST['page'];
//    $previouspage = $page;
//}
//else {
//    $previouspage = "index.php";
//}
try {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST["login"])) {
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            $message = '<label>All fields are required</label>';
        } else {
            $password_entered = $_POST["password"];
            $sql = "SELECT password,id FROM users WHERE email = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($_POST["email"]));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $q->rowCount();

            if ($count > 0) {
                $stored_pwd = $data['password'];
                echo($password_entered);
                echo('<br>');
                echo($stored_pwd);
                if (password_verify($password_entered, $stored_pwd)) {
                    session_start();
                    $_SESSION["user_id"] = $data['id'];
                    header("location:../index.php");
                }
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
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
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
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
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       required>
                            </div>
                        </div>

                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" name="login" class="btn btn-info btn-sm" value="Login"/>
                            </div>
                        </div>
                    </form>

                    <a href="register.php" class="btn-link link-secondary">Registreer</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>