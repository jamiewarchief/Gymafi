<?php
    session_start();
    include('../conn.php');

    if(!isset($_SESSION['keep_username'])) {
        header('location: index.php');
    } else {
        $username = $_SESSION['keep_username'];
        $pword = $_SESSION['keep_pword'];
        $id = $_SESSION['keep_id'];
        $is_admin = $_SESSION['is_admin'];


        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header('location: ../index.php');
        }

    }

    if (empty($username)) {
        header('location: index.php');
    }

    $read = "SELECT * FROM users WHERE id = $id";
            $result = $conn->query($read);
            if(!$result) {
                echo $conn->error;
            }

            while($row = $result->fetch_assoc()) {
                $get_first_name = $row['first_name'];
                $get_last_name = $row['last_name'];
                $get_email = $row['email'];
                $get_admin = $row['is_admin'];
                
            }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="/gymafi/css/spur.css">
    <link rel="stylesheet" href="css/demo.css"/>
    <link rel="stylesheet" href="css/theme3.css"/>
    <link rel="stylesheet" href="/gymafi/stylesheet.css">
    <title>gymafi</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="../admin/dash.php" class="">
                    <img src="/gymafi/img/gymafi_logo_circle.svg"
                            width="75%" height="75%" class="d-inline-block align-top myimgbutton loginbutton" alt="">
                </a>
            </header>
            <nav class="dash-nav-list">
                <a href="../admin/dash.php" class="dash-nav-item">
                    <i class="fas fa-home"></i> Dashboard </a>
                <div class="dash-nav-dropdown">
                    <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-cogs"></i> Manage </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="schedule.php" class="dash-nav-dropdown-item"> Schedule</a>
                        <a href="register.php" class="dash-nav-dropdown-item"> Add New User</a>
                        <a href="newclass.php" class="dash-nav-dropdown-item">Add New Class</a>
                        <a href="newappt.php" class="dash-nav-dropdown-item">Add New Appt</a>
                    </div>
                </div>
                <a href="../admin/messages.php" class="dash-nav-item">
                    <i class="fas fa-paper-plane"></i> Messages</a>
                <a href="../admin/profile.php" class="dash-nav-item">
                    <i class="fas fa-edit"></i> Edit Profile </a>
                <a href="#!" class="dash-nav-item" data-toggle="modal" data-target="#logoutmodal">
                    <i class="fas fa-long-arrow-alt-left"></i> Log Out </a>
            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#" class="myburger" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars myburger"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="../admin/dash.php"><i class="fas fa-home"></i> Dashboard</a>
                            <a class="dropdown-item" href="../admin/schedule.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
                            <a class="dropdown-item" href="../admin/register.php"><i class="fas fa-address-card"></i> Add New User</a>
                            <a class="dropdown-item" href="../admin/newclass.php"><i class="fas fa-calendar-alt"></i> Add New Class</a>
                            <a class="dropdown-item" href="../admin/newappt.php"><i class="fas fa-clipboard"></i> Add New Appt</a>
                            <a class="dropdown-item" href="../admin/messages.php"><i class="fas fa-paper-plane"></i> Messages</a>
                            <a class="dropdown-item" href="../admin/profile.php"><i class="fas fa-edit"></i> Edit Profile</a>
                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutmodal"><i class="fas fa-long-arrow-alt-left"></i> Log Out</a>
                        </div>
                <div class="tools">
                    <div class="dropdown tools-item">
                       
                    </div>
                </div>
                <div class="col">
                    <a class="navbar-brand font-weight-bold mytitle">gymafi</a>
                </div>
                <div class="row">
                    <?php 

                        $img = "SELECT img_path FROM profile_img INNER JOIN users ON profile_img.img_id = users.id WHERE users.id = $id";
                        $displayimg = $conn->query($img);
                        $numrows = $displayimg->num_rows;
                        if ($numrows == 0) {
                            echo '<div class="col">
                                '.$get_first_name.' '.$get_last_name.'
                            </div>';
                        } else {
                            while($row=$displayimg->fetch_assoc()) {
                                $imgdata = $row['img_path'];
                            }

                            echo '
                                <div class="row">
                                    <div class="col">
                                        <a href="profile.php"><img class="myprofilepic" style="width:75px;height:75px;border-radius:50%" src="'.$imgdata.'"></a>
                                    </div>
                                    <div class="col">
                                        <p>'.$get_first_name.' '.$get_last_name.'</p>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
                </div>
            </header>
            <main class="dash-content mt-5 pt-5">
                <div class="container">
                <?php
                    $read = "SELECT * FROM classes ORDER BY id DESC";
                    $result = $conn->query($read);
                    if(!$result) {
                       echo $conn->error;
                    }

                    while($row=$result->fetch_assoc()) {
                        
                        $get_class_name = $row['class_name'];
                        $get_class_info = $row['class_info'];
                        $get_class_img = $row['img_path'];
                        $get_coach_id = $row['coach_id'];

                        $coachread = "SELECT first_name, last_name FROM users WHERE id = $get_coach_id";
                        $coachresult = $conn->query($coachread);
                        if(!$coachresult) {
                            echo $conn->error;
                        }
                        while($row=$coachresult->fetch_assoc()) {
                            $coach_first_name = $conn->real_escape_string($row['first_name']);
                            $coach_last_name = $conn->real_escape_string($row['last_name']);
                        }

                        echo '
                        
                            <div class="card text-center text-light mb-3 bg-warning">
                                <div class="card-body">
                                    <h4>'.$get_class_name.'</h4>
                                </div>
                            </div>    
                            <div class="card w-100">
                                <img src="'.$get_class_img.'" class="img-fluid mb-4">
                                <div class="card-body">
                                    <p class="card-text mb-2">'.$get_class_info.'</p>
                                    <p class="card-text text-center mb-4"><e>with '.$coach_first_name.' '.$coach_last_name.'</em></p>
                                    <a href="dash.php" class="btn btn-secondary btn-lg btn-block">Go Back</a>
                                </div>
                            </div>
                            <br><br>
                            ';

                    }
                ?>
                </div>
            </main>
        </div>
    </div>

    <!-- FULL APPT DETAILS MODAL -->
    <div class="modal fade fullapptdetails" id="fullapptdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <!-- END OF FULL APPT DETAILS MODAL -->

    <!-- START OF LOG OUT MODAL -->
    <div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you wish to log out?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <button name="logout" type="submit" class="btn btn-secondary">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF LOG OUT MODAL -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/spur.js"></script>
</body>

</html>