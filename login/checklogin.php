
<?php include "../connect.php" ?>

<?php
function check_login($username, $password) {

  // prepare and execute SQL statement
  $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    // valid username, check password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      // valid login, return user info
      return array('status' => 'success', 'user_id' => $row['id'], 'username' => $row['username']);
    } else {
      // invalid password
      return array('status' => 'error', 'message' => 'Invalid password');
    }
  } else {
    // invalid username
    return array('status' => 'error', 'message' => 'Invalid username');
  }

  $conn->close();
}
?>