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

    echo "<h1>My Comments</h1>";

    $curr_user = 4;

    // Create connection
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");

    // Check connection
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }

    $result = $conn->query("SELECT * FROM `comments` WHERE `user_id`=$curr_user");
    if (!$result) { echo "SQL Query Error!"; }

    while($row = $result->fetch_assoc()) {

        // Get user name
        $result3 = $conn->query("SELECT * FROM `users` WHERE `user_id`=$row[user_id]");
        if (!$result3) { echo "SQL Query Error!"; }
        $row3 = $result3->fetch_assoc();

        // Get destination name from destination_id
        $result2 = $conn->query("SELECT * FROM `destinations` WHERE `destination_id`=$row[destination_id]");
        if (!$result2) { echo "SQL Query Error!"; }
        $row2 = $result2->fetch_assoc();

        // Get stars from rating
        $rating = intval("$row[rating]");
        $stars = str_repeat("★", $rating) . str_repeat("☆", 5 - $rating);

        // reformat date
        $valid_date = date( 'm/d/y (g:i A)', strtotime("$row[creation_time]"));

        echo "<br>
              <div class='comment_block'>
                <h2>$row2[attraction]</h2>
                <p>$row3[first_name] | $valid_date</p>
                <p> $stars ($row[rating])</p>
                <p>$row[description]</p>
              </div>";

    }

    mysqli_close($conn);

?>

</body>
</html>