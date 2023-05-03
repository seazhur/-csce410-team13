<!--
  NAME: Cesar Fuentes
  DESCRIPTION: Lets the user DELETE one of their comments.
 -->

<?php include "../connect.php" ?>

<?php 

if ( isset($_GET["comment_id"]) ) {
    $comment_id = $_GET["comment_id"];
    $sql = "DELETE FROM comments WHERE comment_id=$comment_id";
    $conn->query($sql);
}

header("location: ../comment/read.php");
exit;

?>

<?php mysqli_close($conn); ?>