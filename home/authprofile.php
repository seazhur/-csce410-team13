<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="new_username" id="username" value="<?php echo $user['username']; ?>" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="new_password" id="password" value="<?php echo $user['password']; ?>" required>
        <br>
        <label for="first_name">First Name:</label>
        <input type="text" name="new_first_name" id="first_name" value="<?php echo $user['first_name']; ?>"<?php if (!$auth_user) echo " readonly"; ?> required>
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="new_last_name" id="last_name" value="<?php echo $user['last_name']; ?>"<?php if (!$auth_user) echo " readonly"; ?> required>
        <br>
        <label for="phone_number">Phone Number:</label>
        <input type="tel" name="new_phone_number" id="phone_number" value="<?php echo $user['phone_number']; ?>"required>
        <br>
        <label for="age">Age:</label>
        <input type="number" name="new_age" id="age" value="<?php echo $user['age']; ?>"<?php if (!$auth_user) echo " readonly"; ?> required>
        <br>
        <input type="submit" value="Update">
    </form>
    <?php if (!$auth_user) echo "Note: You are an authorized user."; ?>
</body>
</html>


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

// Check if user is authorized
$auth_user = $user['auth_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $new_first_name = $_POST['new_first_name'];
    $new_last_name = $_POST['new_last_name'];
    $new_phone_number = $_POST['new_phone_number'];
    $new_age = $_POST['new_age'];

    // Check if the new username already exists
    if ($new_username != $username) {
        $query = "SELECT * FROM users WHERE username = '$new_username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Error: Username already exists.";
            exit();
        }
    }

    // Update the user's information in the database
    $query = "UPDATE users SET username = '$new_username', password = '$new_password', first_name = '$new_first_name', last_name = '$new_last_name', phone_number = '$new_phone_number', age = '$new_age' WHERE username = '$username'";
    if (mysqli_query($conn, $query)) {
        // Update the session variable with the new username
        $_SESSION['username'] = $new_username;

        // Reload the page to reflect the changes
        header("Location: ".$_SERVER['PHP_SELF']);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    exit();
}
?>
</body>
</html>
