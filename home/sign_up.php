<!DOCTYPE html>
<html>

<head>
    <title>Signup Page</title>
</head>

<body>
    <h1>Signup</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" required><br><br>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>
        <input type="submit" name="submit" value="Sign up">
    </form>

    <p>Already have an account? Click <a href="login.php">here</a> to log in.</p>



    <?php
//connect to the database
$conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
if (!$conn) { die("Connection failed: " . $conn->connect_error); }

// check if form is submitted
if (isset($_POST['submit'])) {
	// get the form data
	$username = $_POST['username'];
	$password = $_POST['password'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$phone_number = $_POST['phone_number'];
	$age = $_POST['age'];

	// insert the data into the database
	$query = "INSERT INTO users (username, password, first_name, last_name, phone_number, age, auth_user) VALUES ('$username', '$password', '$first_name', '$last_name', '$phone_number', '$age', 0)";
	mysqli_query($conn, $query);
	
	// redirect the user to the login page
	header('Location: login.php');
	exit;
}
?>

</body>

</html>