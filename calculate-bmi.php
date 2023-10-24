<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:auth/login.php");
    exit();
} else {
    include('includes/database.php');
}

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BMI Calculator</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
    <div class="container">
        <h1>BMI Calculator</h1>
        <form id="bmiForm">
            <div class="mb-3">
                <label class="form-label" for="weight">Gewicht (kg):</label>
                <input class="form-control" type="text" id="weight" name="weight" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="height">Lengte (cm):</label>
                <input class="form-control" type="text" id="height" name="height" required>
            </div>
            <button class="btn btn-primary" type="submit">Bereken BMI</button>

            <h3 id="bmiResult"></h3>
        </form>
        <div id="bmiResult"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    </body>
    </html>
<?php
