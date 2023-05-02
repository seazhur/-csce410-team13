<?php
session_start();
//connect to the database
$conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
if (!$conn) { die("Connection failed: " . $conn->connect_error); }

if (isset($_SESSION['user_id'])) {
  // user is already logged in, redirect to profile
  header('Location: nav.html');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // retrieve and sanitize input values
  $username = htmlspecialchars(trim($_POST['username']));
  $password = htmlspecialchars(trim($_POST['password']));

  // call checklogin.php to validate login
  require_once('checklogin.php');
  $result = check_login($username, $password);

  if ($result['status'] == 'success') {
    // valid login, store session variables and redirect to nav
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['username'] = $result['username'];
    header('Location: ../nav.html');
    exit();
  } else {
    // invalid login, display error message
    $error_msg = $result['message'];
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <?php if (isset($error_msg)) { ?>
    <p><?php echo $error_msg; ?></p>
  <?php } ?>

  <form method="POST" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>
  </form>
</body>
</html>


