<!--
  NAME: Jessyka Flores
  DESCRIPTION: Lets the user UPDATE a destination.
 -->
 <?php include "../connect.php" ?>

 <?php 
// TODO: Replace with current user
$curr_user = 4; 
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $attraction = mysqli_real_escape_string($conn, $_POST["attraction"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $state = mysqli_real_escape_string($conn, $_POST["state"]);
    $destination_id = mysqli_real_escape_string($conn, $_POST["destination_id"]);

   
    $sql = "UPDATE destinations SET attraction='$attraction', city='$city', state='$state' WHERE destination_id='$destination_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Destination updated!";
    } else {
        echo "Error updating destination: " . mysqli_error($conn);
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinations</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
    <body>
        <div id="nav-placeholder"></div>
        <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="hidden" name="destination_id" value="1">
                Attraction: <input type="text" name="attraction"><br>
                City: <input type="text" name="city"><br>
                State: <input type="text" name="state"><br>
                <input type="submit" value="Update">
            </form>
        </div>
    </body>
</html>
<script>
$(function() {
    $("#nav-placeholder").load("../nav.php");
});
</script>

<?php mysqli_close($conn); ?>
