<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $age = $_POST['age'];

    // Connect to the database
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }

    // Check if the username already exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "Error: Username already exists.";
        exit();
    }

    // Insert the new user into the database
    $query = "INSERT INTO users (username, password, first_name, last_name, phone_number, age) VALUES ('$username', '$password', '$first_name', '$last_name', '$phone_number', '$age')";
    if (mysqli_query($conn, $query)) {
        // Redirect to the login page
        header("Location: login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
        <br>
        <label for="phone_number">Phone Number:</label>
        <input type="tel" name="phone_number" id="phone_number" required>
        <br>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required>
        <br>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>