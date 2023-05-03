<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form method="POST">
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
    // start a session to persist user information across pages
    session_start();

    // check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // retrieve the username and password from the form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // connect to the database
        $servername = "localhost";
        $dbusername = "your_db_username";
        $dbpassword = "your_db_password";
        $dbname = "your_db_name";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // check for errors connecting to the database
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

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