<?php
require_once "database.php";
session_start();

if (isset($_POST['weight'], $_POST['height'], $_POST["bmi"])){



    $weight = ($_POST['weight']);
    $height = ($_POST['height']);
    $bmi = ($_POST['bmi']);
    $user = $_SESSION['user_id'];

    if (!is_numeric($weight) || !is_numeric($height) || ! is_numeric($bmi)){

        header("Location:index.php");
        http_response_code(400);
        exit();
    }
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO bmi(weight, height, bmi, user_id) values (:weight,:height,:bmi,:user)";

    $q = $pdo->prepare($sql);

    $q->bindParam(':weight', $weight );
    $q->bindParam(':height', $height );
    $q->bindParam(':bmi', $bmi);
    $q->bindParam(':user', $user, PDO::PARAM_INT);

    $q->execute();
    database::disconnect();
    echo "Your bmi is : ". $bmi;
//    header("Location: ../index.php");
}
