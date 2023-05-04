<!-- This was written by Adidev Mohapatra 
This form is the any of the users to delete their 
account and wipes them out of the database. -->

<?php
session_start();

//connect to the database
$conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
if (!$conn) { die("Connection failed: " . $conn->connect_error); }

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get the user's information from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Delete the user's account from the database
$query = "DELETE FROM users WHERE username = '$username'";
if (mysqli_query($conn, $query)) {
    // Log the user out
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    echo "Error deleting account: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
