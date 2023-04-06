<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

<a href="index.php">Home</a> <br>
<a href="trip.php">My Trips</a> <br>
<a href="comment.php">My Comments</a> <br>
<a href="profile.php">My Profile</a> <br><br><br>

<?php  

    echo "<h1>Detail Page (Destination)</h1>";

    $curr_destination = 4;

    // Create connection
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }



    // $result = $conn->query("SELECT * FROM `destinations` WHERE `destination_id`=$curr_destination");
    // if (!$result) { echo "SQL Query Error!"; }

    

    $result = $conn->query("SELECT * FROM `comments` WHERE `destination_id`=$curr_destination");
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
        $valid_date = date( 'm/d/y (g:i A)', strtotime("$comm_row[creation_time]"));

        echo "<br>
              <div class='comment_block'>
                <p>$user_row[first_name] | $valid_date</p>
                <p> $stars ($comm_row[rating])</p>
                <p>$comm_row[description]</p>
              </div>";

    }





    mysqli_close($conn);
    

?>

</body>
</html>


