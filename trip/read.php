<!-- This was written by Jenny Nguyen
This is read.php so it handles all of the information being displayed, 
the javascript for the functionality of the buttons, and any forms
that are needed. -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Trips</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="trips.css" importance="high">
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

      $user_id = 4; //will need to code later

      //get trips for a certain user
      $getTripID = "SELECT trips.trip_id, trips.start_date, trips.end_date
                    FROM trips
                    JOIN attendances ON trips.trip_id = attendances.trip_id
                    WHERE attendances.user_id = $user_id
                    ORDER BY trips.start_date ASC";

      //execute the query
      $myTrip = mysqli_query($conn, $getTripID);

      //check if empty
      if(mysqli_num_rows($myTrip) > 0) {
        $curr_trip = null;
        $curr_dest = null;
        $trip_num = 1; //not the same as trip_id, keeping count of the trips

        while($row = mysqli_fetch_assoc($myTrip)) {
          $trip_id = $row['trip_id'];

          //check if it is a new trip
          if($trip_id != $curr_trip) {
            $start_date = date('F d, Y', strtotime($row['start_date']));
            $end_date = date('F d, Y', strtotime($row['end_date']));
            echo '<button class = "accordion">';
            echo "<h2>Trip $trip_num From $start_date to $end_date</h2></button>";
            $curr_trip = $trip_id;
            $trip_num++;
          }

          //get destination(s) for a trip
          $getDestination = "SELECT destinations.attraction, destinations.city, destinations.state
                            FROM trips
                            JOIN assignments ON trips.trip_id = assignments.trip_id
                            JOIN destinations ON assignments.destination_id = destinations.destination_id
                            WHERE trips.trip_id = $trip_id";

          //execute the query
          $myDestination = mysqli_query($conn, $getDestination);
          //check if empty
          if(mysqli_num_rows($myDestination) > 0) {
            $destination_num = 1; //not same as destination_id, keeps count of destinations in a trip
            echo '<div class = "panel">';
            while($row = mysqli_fetch_assoc($myDestination)) {
              $attraction = $row['attraction'];
              $city = $row['city'];
              $state = $row['state'];
              echo "Destination $destination_num: $attraction in $city, $state <br>";
              $destination_num++;
            }
            // echo "</div>";
          }

          //get the attendees for a trip
          $getAttendance = "SELECT users.first_name
                            FROM users
                            JOIN attendances ON users.user_id = attendances.user_id
                            WHERE attendances.trip_id = $trip_id";

          //execute the query
          $attendances = mysqli_query($conn, $getAttendance);
          //check if empty
          if(mysqli_num_rows($attendances) > 0) {
            echo "Attendees:<br>";
            while($row = mysqli_fetch_assoc($attendances)) {
              $attendee = $row['first_name'];
              echo "$attendee <br>";
            }
            // echo '<br><div><button class="update-btn" id="update" data-tripid="'.$trip_id.'">Update trip</button>';
            // echo '<div>';
              echo '<br><br>Update trip date range here: <br>';
              echo '<form id="update_form" action="update_trip.php" method="POST">
              <label for="new_start_date">New Start Date: </label>
              <input type="date" name="new_start_date" required><br>
              <label for="new_end_date">New End Date: </label>
              <input type="date" name="new_end_date" required><br>
              <input type="hidden" name="trip_id_date" value="'.$trip_id.'">';
              echo '<input type="submit" value="Submit" name="submitDate"><br><br>';
              echo '</form>';
            // echo '</div>'; //end form div

            echo '<button class="delete-btn" data-tripid="'.$trip_id.'">Cancel trip</button></div>';
            echo "</div>"; //end of the panel
          }
        }
      }

      echo '<br><button id="create_btn">Add new trip</button>';
      //create a form to create a new trip
      echo '<form id="trip_form" action="create_trip.php" method="POST" style="display:none">
              <label for="start_date">Start Date: </label>
              <input type="date" name="start_date" required><br>
              <label for="end_date">End Date: </label>
              <input type="date" name="end_date" required><br><br>';

      //get all users as options for the form
      echo  '<label for="attendees">Attendees: </label>
              <select name="attendees[]" multiple required>';
              $get_users = "SELECT * FROM users";
              $users = $conn->query($get_users);
              while($row = mysqli_fetch_assoc($users)) {
                echo '<option value="'.$row["user_id"].'">'.$row["first_name"].'</option>';
              }
      echo '</select><br><br>';
      
      echo '<div id="dest_container">
            <label for="attraction"> Destination: </label>
            <input type="text" name="attractions[]" required><br>
            <label for="city">City: </label>
            <input type="text" name="cities[]" required><br>
            <label for="state">State: </label>
            <input type="text" name="states[]" required><br><br></div>';
      echo '<button id="add_new_dest">Add additional destination</button><br><br>';

      echo '<input type="submit" value="Submit" name="submitTrip"><br>';
      echo '</form>';

      // close the database connection
      mysqli_close($conn);
    ?>

</body>

</html>

<script>
$(function() {
    $("#nav-placeholder").load("../nav.php");
});

// var updateTrip = document.getElementById("update");
// var updateForm = document.getElementById("update_form");
// updateTrip.addEventListener("click", function() { //display form when the update trip button is clicked
//   updateForm.style.display = "block";
// });

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() { //for the accordion
        // Toggle between adding and removing the "active" class,
        // to highlight the button that controls the panel 
        this.classList.toggle("active");

        // Toggle between hiding and showing the active panel 
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

$(document).ready(function() {
    $(".delete-btn").click(function() { //when the cancel trip button is clicked
        var trip_id = $(this).data("tripid");
        $.post("delete_trip.php", {
            del_trip_id: trip_id
        }, function() {
            location.reload();
        })
    })
})

var createTrip = document.getElementById("create_btn");
var tripForm = document.getElementById("trip_form");

createTrip.addEventListener("click", function() { //display form when the add trip button is clicked
    tripForm.style.display = "block";
});

$(document).ready(function() {
    $("#add_new_dest").click(function() { //when the add additional destination button is clicked
        var add_attraction = '<label for="attraction">Destination:</label>' +
            '<input type="text" name="attractions[]" required><br>';
        var add_city = '<label for="city">City:</label>' +
            '<input type="text" name="cities[]" required><br>';
        var add_state = '<label for="state">State:</label>' +
            '<input type="text" name="states[]" required><br><br>';

        $("#dest_container").append(add_attraction);
        $("#dest_container").append(add_city);
        $("#dest_container").append(add_state);

    });
});
</script>