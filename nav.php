<?php 
  session_start();
  $uid = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $is_authorized = $_SESSION['is_authorized'];
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <!-- Home -->
        <a class="navbar-brand" href="">Trip2Gether</a>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../trip/read.php">Trips</a>
                    <!-- ?uid=<?php echo $uid; ?> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../comment/read.php">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../destination/read_dest.php">Destinations</a>
                </li>
                <li class="nav-item">

                    <?php 
                      if ($_SESSION['is_authorized'] == 1) { 
                    ?>
                    <a class="nav-link" href="../home/authprofile.php">Profile</a>
                    <?php } else { ?>
                    <a class="nav-link" href="../home/profile.php">Profile</a>
                    <?php } ?>

                </li>


            </ul>
        </div>


        <!-- Logout -->
        <!--<button class="btn btn-sm btn-outline-secondary" type="button">Logout</button>-->
        <form method="post" action="../home/logout.php">


            <?php
                echo "Hello, $username!";
                echo str_repeat('&nbsp;', 3)
            ?>

            <button type="submit">Logout</button>
        </form>


    </div>

</nav>