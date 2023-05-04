<!-- This was written by Adidev Mohapatra 
This form is the authorize users, by adding a 1 in the auth_user column
onces an authorized user approves them. -->

<?php
session_start();

//connect to the database
$conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
if (!$conn) { die("Connection failed: " . $conn->connect_error); }

// Check if user is logged in and authorized
if (!isset($_SESSION['username']) || $_SESSION['is_authorized'] != 1) {
    header("Location: login.php");
    exit();
}

// Get the form data
$username = $_POST['username'];

// Update the user's authorized status in the database
$query = "UPDATE users SET auth_user = '1' WHERE username = '$username'";
if (mysqli_query($conn, $query)) {
    echo "User $username has been authorized.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
exit();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Authorize User</title>
</head>
<body>
	<a href="authprofile.php">Go back to profile</a>
</body>
</html>