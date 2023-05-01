<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

  <!--Navigation bar-->
  <div id="nav-placeholder"></div>



</body>

<script>
  $(function(){
    $("#nav-placeholder").load("../nav.html");
  });
</script>





<?php  

    // echo "<h1>Home Page</h1>";

    // $curr_user = 4;

    // // Create connection
    // $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
    // if (!$conn) { die("Connection failed: " . $conn->connect_error); }

    // $result = $conn->query("SELECT * FROM `destinations`");
    // if (!$result) { echo "SQL Query Error!"; }

    // while($dest_row = $result->fetch_assoc()) {

    //     // TODO: Get the average rating

    //     echo "<br>
    //           <div class='comment_block'>
    //             <h2>$dest_row[attraction]</h2>
    //             <p>$dest_row[city], $dest_row[state]</p></div>";
        
    // }

    // mysqli_close($conn);
    
?>