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

    echo "<h1>Home Page</h1>";

    $curr_user = 4;

    // Create connection
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }

    $result = $conn->query("SELECT * FROM `destinations`");
    if (!$result) { echo "SQL Query Error!"; }

    while($dest_row = $result->fetch_assoc()) {

        // TODO: Get the average rating

        echo "<br>
              <div class='comment_block'>
                <h2>$dest_row[attraction]</h2>
                <p>$dest_row[city], $dest_row[state]</p></div>";
        
    }

    mysqli_close($conn);
    

?>

</body>
</html>
