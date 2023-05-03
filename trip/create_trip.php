<!-- This was written by Jenny Nguyen
This processe the form for creating a new Trip
and inserts the respective values into their corresponding tables -->

<?php 
    // $user_id = intval($_SESSION['user_id']);
?>

<?php 
    //connect to the database
    $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    if (!$conn) { die("Connection failed: " . $conn->connect_error); }

    if(isset($_POST['submitTrip'])) {
        //first, insert start_date and end_date into trips table to get new trip_id
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $insert_trip = "INSERT INTO trips (start_date, end_date) VALUES ('$start_date', '$end_date')";
        if(mysqli_query($conn, $insert_trip)) {
            $trip_id = mysqli_insert_id($conn); //returns id that was generated
        } else {
            echo "ERROR: " . $insert_trip . mysqli_error($conn);
        }

        //insert into attendances table
        $attendees = $_POST['attendees'];
        foreach($attendees as $user_id) {
            $insert_attendee = "INSERT INTO attendances (user_id, trip_id) VALUES ('$user_id', '$trip_id')";
            if(!mysqli_query($conn, $insert_attendee)) {
                echo "ERROR: " . $insert_attendee . mysqli_error($conn);
            }
        }

        //insert into destinations and assignments table
        $attractions = $_POST['attractions'];
        $cities = $_POST['cities'];
        $states = $_POST['states'];
        //each element in $attractions is $attraction, and the index for it is $index
        foreach($attractions as $index => $attraction) {
            $city = $cities[$index];
            $state = $states[$index];

            //insert into destinations table if it does not already exist
            $insert_destination = "INSERT IGNORE INTO destinations (attraction, city, state) VALUES ('$attraction', '$city', '$state')";
            if(!mysqli_query($conn, $insert_destination)) {
                echo "ERROR: " . $insert_destination . mysqli_error($conn);
            }

            // //insert into destinations table if it does not already exist
            // //check if destination exists
            // $check_dest = "SELECT * FROM destinations WHERE attraction = '$attraction' AND city = '$city' AND state = '$state'";
            // //execute the query
            // $result = mysqli_query($conn, $check_dest);
            // //if row doesn't exist, create new row by inserting into the table
            // if(mysqli_num_rows($result) == 0) {
            //     $insert_destination = "INSERT INTO destinations (attraction, city, state) VALUES ('$attraction', '$city', '$state')";
            //     if(!mysqli_query($conn, $insert_destination)) {
            //         echo "ERROR: " . $insert_destination . mysqli_error($conn);
            //     }
            // }

            //get new id that was generated for destination
            $get_dest_id = "SELECT destination_id FROM destinations WHERE attraction = '$attraction' AND city = '$city' AND state = '$state'";
            $data = mysqli_query($conn, $get_dest_id); //execute query to get destination_id
            $dest_id = mysqli_fetch_assoc($data)['destination_id'];

            //assign destination to trip
            $insert_assignment = "INSERT INTO assignments (trip_id, destination_id) VALUES ('$trip_id', '$dest_id')";
            if(!mysqli_query($conn, $insert_assignment)) {
                echo "ERROR: " . $insert_assignment . mysqli_error($conn);
            }
        }
    }

    header("location: ../trip/read.php");
    exit;

?>

<?php mysqli_close($conn); ?>