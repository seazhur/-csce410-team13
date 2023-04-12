<?php include "../connect.php" ?>

<?php

// TODO: Replace with current user
$curr_user = 4; 

$destination_id = "";
$rating = "";
$description = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") { 

    // get the form inputs
    $destination_id = $_POST["dest-select"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];

    do {

        // validate inputs
        if ( empty($destination_id) || empty($rating) ||  empty($description)) {
            $errorMessage = "All fields are required";
            break;
        }

        // add new comment to database
        $query = "INSERT INTO `comments` (`comment_id`, `rating`, `description`, `creation_time`, `user_id`, `destination_id`)" . 
                 "VALUES (NULL, '$rating', '$description', current_timestamp(),  $curr_user, $destination_id)";
        $result = $conn->query($query);
        if (!$result) { $errorMessage = "Invalid Query: " . $conn->connect_error; break; }

        // reset the form values
        $destination_id = "";
        $rating = "";
        $description = "";

        // go back to comments page
        header("location: ../comment/read.php");
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
    <title>Add Comment</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
<body>

    <!--Navigation bar-->
    <div id="nav-placeholder"></div>

    <div class="container my-5">
        <h2>New Comment</h2> 

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

        <!-- Input Form -->
        <form method="post">

            <!-- Destination -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Destination</label>
                <div class="col-sm-6">

                    <select class="form-select" name="dest-select">
                        <div class="col-sm-6">
                            
                            <option selected></option>

                            <?php
                            $result2 = $conn->query("SELECT * FROM `destinations`");
                            if (!$result2) { echo "SQL Query Error!"; }
                            while($dest_row = $result2->fetch_assoc()) {
                                echo "<option value='$dest_row[destination_id]'>$dest_row[attraction] ($dest_row[city], $dest_row[state])</option>";
                            }
                            ?>

                        </div>
                    </select>
                </div>
            </div> 

            <!-- Rating -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Rating</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="rating" min="0" max="5" value="<?php echo $rating; ?>"> </div>
            </div> 

            <!-- Description -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="description" rows="6" maxlength="255" value="<?php echo $description; ?>"></textarea> </div>
            </div> 

            <!-- Buttons -->
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</buttons>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="../comment/read.php" role="button">Cancel</a>
                </div>
            </div>

        </form>


    </div>
    
</body>
</html>

<script>
  $(function(){
    $("#nav-placeholder").load("../nav.html");
  });
</script>

<?php mysqli_close($conn); ?>