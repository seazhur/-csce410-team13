<!--
  NAME: Jessyka Flores
  DESCRIPTION: Lets the user CREATE a destination.
 -->

<?php include "../connect.php" ?>

<?php

$attraction = "";
$city = "";
$state = "";

$errorMessage = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") { 

    // get the form inputs
    $attraction = $_POST["attraction"];
    $city = $_POST["city"];
    $state = $_POST["state"];

    do {

        // validate inputs
        if ( empty($attraction) || empty($city) ||  empty($state)) {
            $errorMessage = "All fields are required";
            break;
        }

        // add new comment to database
        $query = "INSERT INTO `destinations` (`attraction`, `city`, `state`)" . 
                 "VALUES ('$attraction', '$city', '$state')";

        echo "$query";

        $result = $conn->query($query);

        if (!$result) { $errorMessage = "Invalid Query: " . $conn->connect_error; break; }
            
        // reset the form values
        $attraction = "";
        $city = "";
        $state = "";

        // go back to comments page
        header("location: ../destination/read_dest.php");
        exit;

    } while (false);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Destination</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<body>
    <div id="nav-placeholder"></div>

    <div class="container my-5">

        <h2>Create Destination</h2>

        <!-- Error Message -->
        <?php
        if ( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-danger'>
                <strong>Error!</strong> $errorMessage
            </div>
            ";
        }
        ?>

        <form method="post">
            <!-- <div>
                <label class="col-sm-3 col-form-label">Destination</label>
            </div> -->

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Attraction</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="attraction" value="<?php echo $attraction; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">State</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="state" value="<?php echo $state; ?>">
                </div>
            </div>

            <!-- submit -->
            <!-- Buttons -->
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</buttons>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="../destination/read_dest.php" role="button">Cancel</a>
                </div>
            </div>

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