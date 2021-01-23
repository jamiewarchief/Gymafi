<?php
    session_start();
    include('conn.php');


    if(!isset($_SESSION['keep_id'])) {
        header('location: index.php');
    } else {
        $username = $_SESSION['keep_username'];
        $pword = $_SESSION['keep_pword'];
        $id = $_SESSION['keep_id'];
        $is_admin = $_SESSION['is_admin'];

        if($is_admin == 1) {
            header('location: admin/dash.php');
        }

        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header('location: index.php');
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="/gymafi/css/spur.css">
    <link rel="stylesheet" href="/gymafi/stylesheet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="/gymafi/js/chart-js-config.js"></script>
    <script src="myscript.js"></script>
    <title>gymafi</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="dash.php">
                    <img src="/gymafi/img/gymafi_logo_circle.svg"
                            width="75%" height="75%" class="d-inline-block align-top" alt="">
                </a>
            </header>
            <nav class="dash-nav-list">
                <a href="dash.php" class="dash-nav-item">
                    <i class="fas fa-home"></i> Dashboard </a>
                <a href="schedule.php" class="dash-nav-item">
                    <i class="fas fa-calendar-alt"></i> Schedule </a>
                <a href="messages.php" class="dash-nav-item">
                    <i class="fas fa-paper-plane"></i> Messages </a>
                <a href="performance.php" class="dash-nav-item">
                    <i class="fas fa-running"></i> Performance </a>
                <a href="profile.php" class="dash-nav-item">
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
                            <a class="dropdown-item" href="dash.php"><i class="fas fa-home"></i> Dashboard</a>
                            <a class="dropdown-item" href="schedule.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
                            <a class="dropdown-item" href="messages.php"><i class="fas fa-paper-plane"></i> Messages</a>
                            <a class="dropdown-item" href="performance.php"><i class="fas fa-running"></i> Performance</a>
                            <a class="dropdown-item" href="profile.php"><i class="fas fa-edit"></i> Edit Profile</a>
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

                    <div class="card text-center text-light mb-3 bg-dark">
                        <div class="card-body">
                            <?php echo '<h1 class="">Welcome, '.$get_first_name.'.</h1>';?>
                        </div>
                    </div>

                    <?php
                        $read = "SELECT date_created FROM users WHERE id = $id";
                        $result = $conn->query($read);
                        if(!$result) {
                            echo $conn->error;
                        }
                        while($row=$result->fetch_assoc()) {
                            $dateadded = $row['date_created'];
                        }
                        $currentdate = date('Y-m-d');
                        $date1 = new DateTime($dateadded);
                        $date2 = new DateTime($currentdate);
                        $diff = $date1->diff($date2)->days;

                        if($diff > 2) {
                            echo '<div class="jumbotron text-center pt-5 mt-4">
                                <h4>You\'ve been with us for <strong> '.$diff.' days</strong>, keep it up!</h4>
                                <p class="lead">Browse a selection of our most popular forthcoming classes...</p>
                                <hr>
                            </div>';

                        } elseif ($diff == 1) {
                            echo '<div class="jumbotron text-center pt-5 mt-4">
                                <h4>You\'ve been with us for <strong> '.$diff.' day</strong> so far, we hope you have a long journey with us.</h4>
                                <p class="lead">Browse a selection of our most popular forthcoming classes...</p>
                                <hr>
                            </div>';
                        } elseif ($diff == 0) {
                            echo '<div class="jumbotron text-center pt-5 mt-4">
                                <h4>You\'ve just joined us. Welcome to the family.</h4>
                                <p class="lead">Browse a selection of our most popular forthcoming classes...</p>
                                <hr>
                            </div>';
                        }


                    $read = "SELECT * FROM classes WHERE id = 1";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id1 = $conn->real_escape_string($row['id']);
                        $get_class_name1 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc1 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info1 = $conn->real_escape_string($row['class_info']);
                        $get_img1 = $conn->real_escape_string($row['img_path']);
                    }

                    $read = "SELECT * FROM classes WHERE id = 2";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id2 = $conn->real_escape_string($row['id']);
                        $get_class_name2 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc2 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info2 = $conn->real_escape_string($row['class_info']);
                        $get_img2 = $conn->real_escape_string($row['img_path']);
                    }

                    $read = "SELECT * FROM classes WHERE id = 3";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id3 = $conn->real_escape_string($row['id']);
                        $get_class_name3 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc3 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info3 = $conn->real_escape_string($row['class_info']);
                        $get_img3 = $conn->real_escape_string($row['img_path']);
                    }

                    $read = "SELECT * FROM classes WHERE id = 4";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id4 = $conn->real_escape_string($row['id']);
                        $get_class_name4 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc4 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info4 = $conn->real_escape_string($row['class_info']);
                        $get_img4 = $conn->real_escape_string($row['img_path']);
                    }

                    $read = "SELECT * FROM classes WHERE id = 5";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id5 = $conn->real_escape_string($row['id']);
                        $get_class_name5 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc5 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info5 = $conn->real_escape_string($row['class_info']);
                        $get_img5 = $conn->real_escape_string($row['img_path']);
                    }

                    $read = "SELECT * FROM classes WHERE id = 6";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id6 = $conn->real_escape_string($row['id']);
                        $get_class_name6 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc6 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info6 = $conn->real_escape_string($row['class_info']);
                        $get_img6 = $conn->real_escape_string($row['img_path']);
                    }

                    $read = "SELECT * FROM classes WHERE id = 7";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id7 = $conn->real_escape_string($row['id']);
                        $get_class_name7 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc7 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info7 = $conn->real_escape_string($row['class_info']);
                        $get_img7 = $conn->real_escape_string($row['img_path']);
                    }

                    $read = "SELECT * FROM classes WHERE id = 8";
                    $result = $conn->query($read);
                    if(!$result) {
                        echo $conn->error;
                    }
                    while($row = $result->fetch_assoc()) {
                        $get_id8 = $conn->real_escape_string($row['id']);
                        $get_class_name8 = $conn->real_escape_string($row['class_name']);
                        $get_class_desc8 = $conn->real_escape_string($row['class_desc']);
                        $get_class_info8 = $conn->real_escape_string($row['class_info']);
                        $get_img8 = $conn->real_escape_string($row['img_path']);
                    }

                    // CAROUSEL IMAGE SIZE MUST BE 960x540 PIXELS

                    echo '
                    <div id="carouselExampleCaptions" class="carousel slide mb-3" data-ride="carousel" data-interval="8000">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="6"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="classes.php?id='.$get_id1.'"><img src="'.$get_img1.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name1.'</h5>
                                    <p>'.$get_class_desc1.'</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <a href="classes.php?id='.$get_id2.'"><img src="'.$get_img2.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name2.'</h5>
                                    <p>'.$get_class_desc2.'</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <a href="classes.php?id='.$get_id3.'"><img src="'.$get_img3.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name3.'</h5>
                                    <p>'.$get_class_desc3.'</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <a href="classes.php?id='.$get_id4.'"><img src="'.$get_img4.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name4.'</h5>
                                    <p>'.$get_class_desc4.'</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <a href="classes.php?id='.$get_id5.'"><img src="'.$get_img5.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name5.'</h5>
                                    <p>'.$get_class_desc5.'</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <a href="classes.php?id='.$get_id6.'"><img src="'.$get_img6.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name6.'</h5>
                                    <p>'.$get_class_desc6.'</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <a href="classes.php?id='.$get_id7.'"><img src="'.$get_img7.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name7.'</h5>
                                    <p>'.$get_class_desc7.'</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <a href="classes.php?id='.$get_id8.'"><img src="'.$get_img8.'" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>'.$get_class_name8.'</h5>
                                    <p>'.$get_class_desc8.'</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    ';
                    ?>
                    <div class="card text-center text-light bg-dark">
                        <div class="card-body">
                            <h4>...or view a full list of our classes <a href="classeslist.php">here</a>, available soon...</h4>
                        </div>
                    </div>
                </div>
                <br>
            </main>
        </div>
    </div>

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