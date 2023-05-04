<!--
  NAME: Cesar Fuentes
  DESCRIPTION: Lets the user VIEW their comments.
 -->

<?php include "../connect.php" ?>

<?php 
    session_start();
    $curr_user = intval($_SESSION['user_id']);
    $is_authorized = intval($_SESSION['is_authorized']);

    if ($is_authorized == 0) {
        $title = "My Comments";
    } else {
        $title = "All User Comments";
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Comments</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>

<body>

    <!--Navigation bar-->
    <div id="nav-placeholder"></div>

    <div class="container my-5">

        <h2><?php echo $title; ?></h2>

        <?php if ($is_authorized == 0) { ?>
        <a class="btn btn-primary" href="../comment/create.php"><i class="bi bi-plus-lg">
                Add Comment</i></a>
        <?php }?>

        <br>
        <br>

        <table class="table">

            <!-- TABLE HEADER -->
            <thead>
                <tr>
                    <th>Date</th>

                    <?php if ($is_authorized == 1) { ?>
                    <th>Name</th>
                    <?php }?>

                    <th>Destination</th>
                    <th>Rating</th>
                    <th>Description</th>

                    <?php if ($is_authorized == 0) { ?>
                    <th></th> <!-- edit -->
                    <?php }?>

                    <th></th> <!-- delete -->
                </tr>
            </thead>

            <!-- TABLE BODY -->
            <tbody>

                <?php


            $condition = "";
            if ($is_authorized == 0) { // user, not admin
                $condition= "WHERE `user_id`=$curr_user";
            }            


          // query all of the users comments
          $result = $conn->query("SELECT * FROM `comments` " . $condition);
          if (!$result) { echo "SQL Query Error!"; }

          while($comm_row = $result->fetch_assoc()) {

              // Get user row
              $result3 = $conn->query("SELECT * FROM `users` WHERE `user_id`=$comm_row[user_id]");
              if (!$result3) { echo "SQL Query Error!"; }
              $user_row = $result3->fetch_assoc();

              // Get user name
              $username = $user_row['username'];

              // Get destination name from destination_id
              $result2 = $conn->query("SELECT * FROM `destinations` WHERE `destination_id`=$comm_row[destination_id]");
              if (!$result2) { echo "SQL Query Error!"; }
              $dest_row = $result2->fetch_assoc();

              // Get stars from rating
              $rating = intval("$comm_row[rating]");
              $stars = str_repeat("★", $rating) . str_repeat("☆", 5 - $rating);

              // Reformat date
              $valid_date = date( 'm/d/y', strtotime("$comm_row[creation_time]")); // (g:i A)

              echo "<tr>";
              echo "<td>$valid_date</td>";

                if ($is_authorized == 1) {
                    echo "<td>$username</td>";
                }

            echo "<td>$dest_row[attraction]</td>";
            echo "<td>$stars</td>";
            echo "<td>$comm_row[description]</td>";

                if ($is_authorized == 0) {
                    echo "<td><a class='btn btn-primary btn-sm' href='../comment/edit.php?comment_id=$comm_row[comment_id]'><i class='bi bi-pencil-fill'></i></a></td>";
                }
                
              echo "<td><a class='btn btn-danger btn-sm' href='../comment/delete.php?comment_id=$comm_row[comment_id]'><i class='bi bi-trash-fill'></i></a></td>";
              echo "</tr>";
              
          }

        ?>

            </tbody>
        </table>

    </div>
</body>

<script>
$(function() {
    $("#nav-placeholder").load("../nav.php");
});
</script>

<?php
mysqli_close($conn);
?>