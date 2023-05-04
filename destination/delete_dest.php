<!--
  NAME: Jessyka Flores
  DESCRIPTION: Lets the user DELETE a destination.
 -->

<?php include "../connect.php" 

//  echo "test!";

if (isset($_GET['destination_id'])) {
 
    $destination_id = mysqli_real_escape_string($conn, $_GET['destination_id']);
  
    $sql = "DELETE FROM destinations WHERE destination_id = '$destination_id'";
  
    if (mysqli_query($conn, $sql)) {
      echo "Destination deleted!";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }

 header("location: ../destination/read_dest.php");
 exit;

?>