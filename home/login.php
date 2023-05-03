<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
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
    input[type="password"] {
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
    <h1>Login</h1>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Login">
  </form>

  <p>Don't have an account? Click <a href="sign_up.php">here</a> to sign up.</p>
</body>
</html>

<?php
    // start a session to persist user information across pages
    session_start();

    // check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // retrieve the username and password from the form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        //connect to the database
        $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
        if (!$conn) { die("Connection failed: " . $conn->connect_error); }

        // construct the SQL query to retrieve the user with the given username and password
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

        // execute the query
        $result = $conn->query($sql);

        // check if the query returned a matching user
        if ($result->num_rows > 0) {
            // fetch the user's information from the query result
            $user = $result->fetch_assoc();

            // store the user's information in the session for later use
            $_SESSION['username'] = $username;
            $_SESSION['is_authorized'] = $user['auth_user'];
            $_SESSION['user_id'] = $user['user_id'];

            // redirect to the appropriate profile page based on the user's authorization status
            if ($user['auth_user'] == 1) {
                header("Location: authprofile.php");
            } else {
                header("Location: profile.php");
            }
            exit();
        } else {
            // display an error message if the user's credentials are invalid
            echo "<p>Invalid username or password.</p>";
        }

        // close the database connection
        $conn->close();
    }
    ?>

</body>

</html>