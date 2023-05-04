<!-- This was written by Adidev Mohapatra 
This form is to direct any potential new users and let them get 
added to the database.  -->
<!DOCTYPE html>
<html>
<head>
  <title>Signup Page</title>
  <style>
    /* css portion to make login page visually aesthetic */
    body {
      background-color: #e6f2ff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      max-width: 500px;
      width: 100%;
    }

    h1 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="tel"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      font-size: 16px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    p {
      text-align: center;
    }
  </style>
</head>

<body>
  <form method="POST">
    <h1>Signup</h1>
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