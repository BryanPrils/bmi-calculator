$(document).ready(function() {
    $("#bmiForm").submit(function(e) {
        e.preventDefault();
        var weight = parseFloat($("#weight").val());
        var height = parseFloat($("#height").val()) / 100;
        var bmi = weight / (height * height);

        $.ajax({
            type: "POST",
            url: "includes/functions.php",
            data: { weight: weight, height: height, bmi: bmi },
            success: function(response) {
                console.log(response)
                $("#bmiResult").html(response);
            }
        });
    });
});