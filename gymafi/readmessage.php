<?php
    session_start();
    include('conn.php');


    if(!isset($_SESSION['keep_username'])) {
        header('location: index.php');
    } else {
        $username = $_SESSION['keep_username'];
        $pword = $_SESSION['keep_pword'];
        $id = $_SESSION['keep_id'];
        $is_admin = $_SESSION['is_admin'];

        if($is_admin == 1) {
            header('location: admin/messages.php');
        }

        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header('location: index.php');
        }

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
    <link rel="stylesheet" href="/gymafi/stylesheet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="../js/chart-js-config.js"></script>
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
            <main class="dash-content pt-5 mt-5">
                <div class="container">

                    <?php

                        if(isset($_GET['id'])) {
                            $message_id = $_GET['id'];
                        }

                        $infoquery = "SELECT * FROM messages WHERE id = $message_id";
                        $inforesult = $conn->query($infoquery);
                        if(!$inforesult) {
                            echo $conn->error;
                        }
                        while($row=$inforesult->fetch_assoc()) {
                            $subject = $row['subject'];
                            $message = $row['message'];
                            $sender_id = $row['sender_id'];
                            $date = $row['created'];
                            $fixed_date = date('D d M Y - H:i', strtotime($date));

                        }

                        $readsendername = "SELECT first_name, last_name FROM users WHERE id = $sender_id";
                        $resultsendername = $conn->query($readsendername);
                        if(!$readsendername) {
                            $conn->error;
                        }
                        while($row=$resultsendername->fetch_assoc()) {

                        $senderfirstname = $row['first_name'];
                        $senderlastname = $row['last_name'];

                        }

                        echo '
                        <div class="container w-75">
                            <div class="card spur-card bg-dark text-white">
                                <div class="card-header bg-dark text-warning">
                                    '.$fixed_date.'
                                </div>
                                <div class="card-body">
                                    <p class="card-title">Subject: '.$subject.' </p>
                                    <hr>
                                    <h2 class="card-text">'.$message.'</h2>
                                    <hr>
                                    <p class="card-text"><em>sent by '.$senderfirstname.' '.$senderlastname.'</em></p>
                                    <a href="replymessage.php?id='.$message_id.'" class="btn btn-success">Reply</a>
                                    <a href="messages.php" class="btn btn-secondary">Back to Messages</a>
                                </div>
                                <div class="card-footer text-muted">
                                </div>
                            </div>
                        </div>
                        ';

                    ?>

                </div>
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