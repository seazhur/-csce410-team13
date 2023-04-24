<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="profile.css" importance="high">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

  <!--Navigation bar-->
  <div id="nav-placeholder"></div>
    <h2>My Profile</h2>
      <?php
      //connect to the database
      $conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
      if (!$conn) { die("Connection failed: " . $conn->connect_error); }
    
    
     ?>



</body>

<script>
  $(function(){
    $("#nav-placeholder").load("../nav.html");
  });
</script>
