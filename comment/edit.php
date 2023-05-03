<!--
  NAME: Cesar Fuentes
  DESCRIPTION: Lets the user EDIT one of their comments.
 -->

<?php include "../connect.php" ?>

<?php

$comment_id = "";
$destination_id = "";
$rating = "";
$description = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == "GET") { 
    // GET: show the comment data

    if ( !isset($_GET["comment_id"]) ) {
        header("location: ../comment/read.php");
        exit;
    }

    $comment_id = $_GET["comment_id"];

    // read the comment
    $sql = "SELECT * FROM `comments` " . 
           "WHERE `comment_id`=$comment_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ../comment/read.php");
        exit;
    }

    // set the form inputs
    $destination_id = $row["destination_id"];
    $rating = $row["rating"];
    $description = $row["description"];

} else {
    // POST: update the comment data

    // get the form inputs
    $comment_id = $_POST["comment_id"];
    $destination_id = $_POST["dest-select"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];

    do {

        // validate inputs
        if ( empty($comment_id) || empty($destination_id) || empty($rating) ||  empty($description)) {
            $errorMessage = "All fields are required";
            break;
        }

        // update comment to database
        $sql = "UPDATE comments " . 
               "SET rating=$rating, description='$description', destination_id=$destination_id " . 
               "WHERE comments.comment_id=$comment_id";
        $result = $conn->query($sql);
        if (!$result) { $errorMessage = "Invalid Query: " . $conn->connect_error; break; }

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
    <title>Edit Comment</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<body>

    <!--Navigation bar-->
    <div id="nav-placeholder"></div>

    <div class="container my-5">
        <h2>Update Comment</h2>

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

            <!-- Store user id -->
            <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">

            <!-- Destination -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Destination</label>
                <div class="col-sm-6">

                    <select class="form-select" name="dest-select">
                        <div class="col-sm-6">

                            <?php
                            $result2 = $conn->query("SELECT * FROM `destinations`");
                            if (!$result2) { echo "SQL Query Error!"; }
                            while($dest_row = $result2->fetch_assoc()) {

                                $isSelected = "";
                                if ($dest_row["destination_id"] == $destination_id) {
                                    $isSelected = " selected";
                                }
                                echo "<option value='$dest_row[destination_id]'" . $isSelected . ">$dest_row[attraction] ($dest_row[city], $dest_row[state])</option>";
                                
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
                    <input type="number" class="form-control" name="rating" min="0" max="5"
                        value="<?php echo $rating; ?>">
                </div>
            </div>

            <!-- Description -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="description" rows="6"
                        maxlength="255"><?php echo $description; ?></textarea>
                </div>
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
$(function() {
    $("#nav-placeholder").load("../nav.php");
});
</script>

<?php mysqli_close($conn); ?>