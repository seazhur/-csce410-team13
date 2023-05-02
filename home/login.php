<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="auth.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>


<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
if (!$conn) { die("Connection failed: " . $conn->connect_error); }

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database for the user with the given username and password
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if a matching user was found
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Set session variables for user type
        if ($user['auth_user'] == 1) {
            $_SESSION['auth_user'] = true;
        } else {
            $_SESSION['auth_user'] = false;
        }

        // Set session variable for username
        $_SESSION['username'] = $username;

        // Redirect to the profile page
        header("Location: profile.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

mysqli_close($conn);
?>