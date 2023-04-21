<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Trips</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

  <!--Navigation bar-->
  <div id="nav-placeholder"></div>
    <h2>My Trips</h2>
    <?php
      //connect to the database
      $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
      if (!$conn) { die("Connection failed: " . $conn->connect_error); }

      //trial 3
      $user_id = 4; //will need to code later

      //getting all the destinations for a certain user
      $getTrip = "SELECT destinations.attraction, trips.trip_id, destinations.destination_id, 
                    trips.start_date, trips.end_date, destinations.city, destinations.state,
                    GROUP_CONCAT(users.first_name) as users_names
                FROM attendances
                JOIN trips ON attendances.trip_id = trips.trip_id
                JOIN assignments ON trips.trip_id = assignments.trip_id
                JOIN destinations ON assignments.destination_id = destinations.destination_id
                JOIN (SELECT trip_id FROM attendances WHERE user_id = $user_id) as x ON attendances.trip_id = x.trip_id
                JOIN users on attendances.user_id = users.user_id
                WHERE attendances.user_id != $user_id
                GROUP BY trips.trip_id, destinations.destination_id";
      //execute the query
      $myTrip = mysqli_query($conn, $getTrip);

      //check if empty
      if(mysqli_num_rows($myTrip) > 0) {
        //initialize variables to keep track of current variables
        $curr_trip_id = null;
        $curr_dest_id = null;
        $trip_num = 1; //used to display which trip the user is looking at, not the same as trip_id

        //loop through to display the desired attributes
        while ($row = mysqli_fetch_assoc($myTrip)) {
          $trip_id = $row['trip_id'];
          $destination_id = $row['destination_id'];

          //if the current trip ID is diff from prev one, it is a new trip
          if($trip_id != $curr_trip_id) {
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
            $u = $row['users_names'];
            $users_attending = explode(',', $u);

            echo "<br><br><h2>Trip $trip_num: From $start_date to $end_date</h2>";
            echo "<h5>Other Attendees: </h5>";
            foreach($users_attending as $name) {
              echo "<h5>$name</h5>";
            }
            $curr_trip_id = $trip_id;
            $trip_num = $trip_num + 1;
          }
        
          //display all the destinations for that one trip
          if($destination_id != $curr_dest_id) {
            $attraction = $row['attraction'];
            $city = $row['city'];
            $state = $row['state'];
            echo "<h5>Destination: $attraction in $city, $state</h5>";
            $curr_dest_id = $destination_id;
          }
        }
      } else {
        echo "No results found";
      }

      // close the database connection
      mysqli_close($conn);
    ?>


</body>

<script>
  $(function(){
    $("#nav-placeholder").load("../nav.html");
  });
</script>
