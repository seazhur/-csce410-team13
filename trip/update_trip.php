
<!-- only update the dates on the trip -->
<?php 
    //connect to the database
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }
    
    

    header("location: ../trip/read.php");
    exit;

?>

<?php mysqli_close($conn); ?>