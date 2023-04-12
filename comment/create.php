<?php
$conn = new mysqli("localhost", "Cesar", "DX8317oZ]XFs0mMo", "trip2gether");
if (!$conn) { die("Connection failed: " . $conn->connect_error); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>

    <!--Navigation bar-->
    <div id="nav-placeholder"></div>

    <div class="container my-5">
        <h2>New Comment</h2> 
        <form method="post">

            <!-- Inputs -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Destination</label>
                <div class="col-sm-6">
                    <!-- <input type="text" class="form-control" name="destination" value="">  -->
                    <select class="form-select" aria-label="Default select example">
                        <div class="col-sm-6"><option selected></option>

                        <?php
                        $result = $conn->query("SELECT * FROM `destinations`");
                        if (!$result) { echo "SQL Query Error!"; }
                        while($dest_row = $result->fetch_assoc()) {
                            echo "<option value=`dest_row[attraction]`>$dest_row[attraction] ($dest_row[city], $dest_row[state])</option>";
                        }
                        ?>

                    </select>
                </div>
            </div> 

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Rating</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="rating" value="" min="0" max="5"> </div>
            </div> 

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="description" rows="6" maxlength="255"></textarea> </div>
            </div> 

            <!-- Buttons -->
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary"> Submit</buttons>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="read.php" role="button">Cancel</a>
                </div>
            </div>


        </form>
    </div>
    
</body>
</html>

<script>
  $(function(){
    $("#nav-placeholder").load("../nav.html");
  });
</script>

<?php
mysqli_close($conn);
?>