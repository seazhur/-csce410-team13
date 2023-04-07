<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Comments</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

  <!--Navigation bar-->
  <div id="nav-placeholder"></div>

  <div class="container my-5">
    <h2>My Comments</h2>
    <a class="btn btn-primary" href="../comment/create.php">New Comment</a>
    <br>
    <br>
    <table class="table">
      <!-- HEADER -->
      <thead>
        <tr>
          <th>Date</th>
          <th>Destination</th>
          <th>Description</th>
          <th>Rating</th>
          <!-- <th>User</th> -->
        </tr>
      </thead>
      <!-- BODY -->
      <tbody>

        <?php

          // TODO: Replace with current user
          $curr_user = 4; 

          $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
          if (!$conn) { die("Connection failed: " . $conn->connect_error); }

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

              // reformat date
              $valid_date = date( 'm/d/y', strtotime("$comm_row[creation_time]")); // (g:i A)

              echo "
              <tr>
                <td>$valid_date</td>
                <td>$dest_row[attraction]</td>
                <td>$comm_row[description]</td>
                <td>$stars</td>
                <td>
                  <a class='btn btn-primary btn-sm' href='#'>Edit</a>
                  <a class='btn btn-danger btn-sm' href='#'>Delete</a>
                </td>
              </tr>
              ";

              // <td>$user_row[first_name]</td>

          }

          mysqli_close($conn);

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



<!-- TODO: finish the CUD operations -->
<!-- edit.php, delete.php?id=$row[id] -->
