
<!-- only update the dates on the trip -->
<?php 
    //connect to the database
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }
    
    if(isset($_POST['submitDate'])) {
        $new_start_date = $_POST['new_start_date'];
        $new_end_date = $_POST['new_end_date'];
        $trip_id = $_POST['trip_id_date'];

        $update_date = "UPDATE trips SET start_date = '$new_start_date', end_date = '$new_end_date' WHERE trip_id = '$trip_id'";
        if(!mysqli_query($conn, $update_date)) {
            echo "ERROR: " . $update_date . mysqli_error($conn);
        }
    }
    

    header("location: ../trip/read.php");
    exit;

?>

<?php mysqli_close($conn); ?>