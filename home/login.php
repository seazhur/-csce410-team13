<?php
session_start();

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //connect to the database
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }

    // Initialize variables and set to empty
    $username = $password = "";
    $username_err = $password_err = "";

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check for errors before accessing database
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["username"] = $username;

                            // Redirect to user's profile page
                            header("location: profile.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $username_err = "No account found with that username.";
                }
            } else {
                // Display an error message if query execution failed
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>