<!--
  NAME: Jessyka Flores
  DESCRIPTION: Lets the user DELETE a destination.
 -->

<?php include "../connect.php" ?>

<?php 

if (isset($_GET['destination_id'])) {
 
    $destination_id = $_GET['destination_id'];
    $sql = "DELETE FROM destinations WHERE destination_id=$destination_id";
    $conn->query($sql);
  }

 header("location: ../destination/read_dest.php");
 exit;

?>

<?php mysqli_close($conn); ?>