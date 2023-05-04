<!--
  NAME: Jessyka Flores
  DESCRIPTION: Lets the user UPDATE a destination.
 -->
<?php include "../connect.php" ?>

<?php 

$attraction = "";
$city = "";
$state = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == "GET") { 
    // GET: show the comment data

    if ( !isset($_GET["destination_id"]) ) {
        header("location: ../destination/read_dest.php");
        exit;
    }

    $destination_id = $_GET["destination_id"];

    // read the dest
    $sql = "SELECT * FROM `destinations` " . 
           "WHERE `destination_id`=$destination_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ../destination/read_dest.php");
        exit;
    }

    // set the form inputs
    $attraction = $row["attraction"];
    $city = $row["city"];
    $state = $row["state"];

} else {
    // POST: update the dest data

    // get the form inputs
    $destination_id = $_POST["destination_id"];
    $attraction = $_POST["attraction"];
    $city = $_POST["city"];
    $state = $_POST["state"];

    do {


        // validate inputs
        if (  empty($destination_id) || empty($attraction) || empty($city) ||  empty($state)) {
            $errorMessage = "All fields are required";
            break;
        }

        // update comment to database
        $sql = "UPDATE destinations " . 
               "SET attraction='$attraction', city='$city', state='$state' " . 
               "WHERE destinations.destination_id=$destination_id";

        echo "bitchhoe";
        $result = $conn->query($sql);

        echo "bitchhoe";
        if (!$result) { $errorMessage = "Invalid Query: " . $conn->connect_error; break; }

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
    <title>Edit Destinations</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<body>
    <div id="nav-placeholder"></div>

    <div class="container my-5">

        <h2>Update Destination</h2>

        <?php
        if ( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-danger'>
                <strong>Error!</strong> $errorMessage
            </div>
            ";
        }
        ?>


        <!-- Input Form -->
        <form method="post">

            <!-- Store user id -->
            <input type="hidden" name="destination_id" value="<?php echo $destination_id; ?>">

            <!-- attraction -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Attraction</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="attraction" value="<?php echo $attraction; ?>">
                </div>
            </div>

            <!-- city -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>">
                </div>
            </div>

            <!-- state -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">State</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="state" value="<?php echo $state; ?>">
                </div>
            </div>

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