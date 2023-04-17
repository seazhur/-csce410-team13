<?php include "../connect.php" ?>

<?php 
// TODO: Replace with current user
$curr_user = 4; 
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
<body>

  <!--Navigation bar-->
  <div id="nav-placeholder"></div>

  <div class="container my-5">

    <h2>My Comments</h2>
    <a class="btn btn-primary" href="../comment/create.php"><i class="bi bi-plus-lg"> Add Comment</i></a>
    <br>
    <br>

    <table class="table">

      <!-- TABLE HEADER -->
      <thead>
        <tr>
          <th>Date</th>
          <th>Destination</th>
          <th>Rating</th>
          <th>Description</th>
          <th></th> <!-- edit -->
          <th></th> <!-- delete -->
        </tr>
      </thead>

      <!-- TABLE BODY -->
      <tbody>

        <?php

          // query all of the users comments
          $result = $conn->query("SELECT * FROM `comments` WHERE `user_id`=$curr_user");
          if (!$result) { echo "SQL Query Error!"; }

          while($comm_row = $result->fetch_assoc()) {

              // Get user name
              $result3 = $conn->query("SELECT * FROM `users` WHERE `user_id`=$comm_row[user_id]");
              if (!$result3) { echo "SQL Query Error!"; }
              $user_row = $result3->fetch_assoc();

              // Get destination name from destination_id
              $result2 = $conn->query("SELECT * FROM `destinations` WHERE `destination_id`=$comm_row[destination_id]");
              if (!$result2) { echo "SQL Query Error!"; }
              $dest_row = $result2->fetch_assoc();

              // Get stars from rating
              $rating = intval("$comm_row[rating]");
              $stars = str_repeat("★", $rating) . str_repeat("☆", 5 - $rating);

              // Reformat date
              $valid_date = date( 'm/d/y', strtotime("$comm_row[creation_time]")); // (g:i A)

              echo "
              <tr>
                <td>$valid_date</td>
                <td>$dest_row[attraction]</td>
                <td>$stars</td>
                <td>$comm_row[description]</td>
                <td><a class='btn btn-primary btn-sm' href='../comment/edit.php?comment_id=$comm_row[comment_id]'><i class='bi bi-pencil-fill'></i></a></td>
                <td><a class='btn btn-danger btn-sm' href='../comment/delete.php?comment_id=$comm_row[comment_id]'><i class='bi bi-trash-fill'></i></a></td>
              </tr>
              ";
              
          }

        ?>

      </tbody>
    </table>
  </div>
</body>

<script>
  $(function(){
    $("#nav-placeholder").load("../nav.html");
  });
</script>

<?php
mysqli_close($conn);
?>
