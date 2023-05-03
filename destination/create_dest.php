<!--
  NAME: Jessyka Flores
  DESCRIPTION: Lets the user CREATE a destination.
 -->

 <?php include "../connect.php" ?>

<?php

// TODO: Replace with current user
$curr_user = 4; 

$destination_id = "";
$rating = "";
$description = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // sql statement
    $stmt = $pdo->prepare("INSERT INTO destinations (attraction, city, state) VALUES (:attraction, :city, :state)");
  
    // assign values
    $attraction = $_POST['attraction'];
    $city = $_POST['city'];
    $state = $_POST['state'];
  
    // bind placeholders to variables
    $stmt->bindParam(':attraction', $attraction);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
  
    
    $stmt->execute();
  
    // Output a success message
    echo "New destination created!";
  }
  ?>
  
  <form method="post">
    <label for="attraction">Attraction:</label>
    <input type="text" id="attraction" name="attraction"><br>
  
    <label for="city">City:</label>
    <input type="text" id="city" name="city"><br>
  
    <label for="state">State:</label>
    <input type="text" id="state" name="state"><br>
  
    <input type="submit" value="Create destination">
  </form>

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


    <form method = "post">
        <div>
            <label class="col-sm-3 col-form-label">Destination</label>
        </div>
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Attraction</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="attraction"
                        value="<?php echo $attraction; ?>">
                </div>
        </div>
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="city"
                        value="<?php echo $city; ?>">
                </div>
        </div>
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">State</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="state"
                        value="<?php echo $state; ?>">
                </div>
        </div>
    </form> 
</body>

</html>
<script>
$(function() {
    $("#nav-placeholder").load("../nav.php");
});
</script>

<?php mysqli_close($conn); ?>