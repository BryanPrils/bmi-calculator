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

    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.2.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.css"
          rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.6/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/kt-2.10.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.2.0/sb-1.6.0/sp-2.2.0/sl-1.7.0/sr-1.3.0/datatables.min.js"></script>

    <script src="js/script.js"></script>
</head>
<body>
<div class="container">
    <h1>All BMI calculations</h1>
    <div class="d-flex justify-content-end mt-4 mb-3">
        <a href="calculate-bmi.php" class="btn btn-primary">Create new bmi measurment</a>
    </div>
    <table id="myTable" class="table table-striped table-bordered" width="100%" cellspacing="0" style="display:none">
        <thead>
        <tr>
            <th>Height</th>
            <th>Weight</th>
            <th>Bmi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //<a class="btn" href="read_produit.php?id='.$row['id'].
        $pdo = database::connect();

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM bmi WHERE user_id = :user";
        $q = $pdo->prepare($sql);

        $q->bindParam(":user", $_SESSION['user_id']);

        $q->execute();

        while ($row_bmi = $q->fetch(PDO::FETCH_ASSOC)) {
            extract($row_bmi);

            echo '<tr>';
            echo "<td>" . $row_bmi['height'] . "</td>";
            echo "<td>" . $row_bmi['weight'] . "</td>";
            echo "<td>" . $row_bmi['bmi'] . "</td>";
            echo '</tr>';
        }
        Database::disconnect();
        ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        console.log('test');
        var table = $('#myTable').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'f><'col-sm-3'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "order": []

        });
        $('#myTable').show();
    });

</script>

</body>
</html>
