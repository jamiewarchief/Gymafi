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
                $coach_id = $row['ass_coach_id'];
                
            }

            $coachread = "SELECT * FROM users WHERE id = $coach_id";
            $coachresult = $conn->query($coachread);
            if(!$coachresult) {
                echo $conn->error;
            }

            while($row = $coachresult->fetch_assoc()) {
                $coach_first_name = $row['first_name'];
                $coach_last_name = $row['last_name'];
                
            }

            
            // APPT REQUEST
            if(isset($_POST['apptsubmit'])) {
                
                $coachselect = $conn->real_escape_string($_POST['coachselect']);
                $sessionselect = $conn->real_escape_string($_POST['sessionselect']);
                $tempdate = $conn->real_escape_string($_POST['dateselect']);
                $dateselect = date('D d M Y @ H:i', strtotime($tempdate));
                
                $read = "SELECT * FROM appointments WHERE date = '$dateselect' ";
                $result = $conn->query($read);
                $numrows = $result->num_rows;
                
                if($numrows > 0) {
                    echo "Class already exists";
                } else {
                    $sessionread = "SELECT * FROM session WHERE id = $sessionselect";
                    $sessionresult = $conn->query($sessionread);
                    if(!$sessionresult) {
                        echo $conn->error;
                    }
                    while($row=$sessionresult->fetch_assoc()) {
                        $sessionrequestname = $row['session_name'];
                    }
                    
                    $preparedsubject = 'Appointment Request';
                    $messagebody = $get_first_name.' has requested a '.$sessionrequestname.' for '.$dateselect;
                    
                    
                    $newmessagequery = "INSERT INTO messages (subject, message, sender_id, recipient_id)
                                    VALUES ('$preparedsubject', '$messagebody', $id , $coach_id)";
                    $insertmessage = $conn->query($newmessagequery);
                    if(!$insertmessage) {
                        echo $conn->error;
                    }
                    $lastid = $conn->insert_id;
                    
                    $mailboxquery = "INSERT INTO mailboxes (user_id, mailbox, message_id)
                                    VALUES ($id, 'out', $lastid), ($coach_id, 'in', $lastid)";
                    $updatemailbox = $conn->query($mailboxquery);
                    if(!$updatemailbox) {
                        echo $conn->error;
                    }
                }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script type="text/javascript" src="js/caleandar.js"></script>
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
                <div id="caleandar">
                    
                    <?php

                        $readuserapp = "SELECT appointments.id AS aptid, date, client_id, coach_id, session_id, session_name FROM appointments
                                        INNER JOIN session
                                        ON session.id = appointments.session_id
                                        WHERE client_id = $id";
                        $userappresult = $conn->query($readuserapp);
                        if(!$userappresult) {
                           echo $conn->error;
                        }

                    ?>

                </div>
                
                <script>

                    <?php

                         echo " var eventsarray = [ ";

                        while($row=$userappresult->fetch_assoc()) {

                            $session_id = $row['aptid'];
                            $date = $row['date'];
                            $coach_id = $row['coach_id'];
                            $session_name = $row['session_name'];
                            $fixed_date = date('Y, m-1, d', strtotime($date));

                            echo "{'Date': new Date($fixed_date), 'Title': '$session_name', 'Link': 'scheduleinfo.php?rowid=$session_id'},";

                        }

                        echo " ]; "

                    ?>     
                    var settings = { NavShow: true,  EventTargetWholeDay: false};
                    var calelement = document.getElementById('caleandar');
        
                    caleandar(calelement, eventsarray, settings);
    
                </script>
                <div class="row my-3 py-3">
                    <button href="#!" type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#requestsessionmodal">REQUEST A SESSION</button>
                </div>
            </div>
            </main>
        </div>
    </div>

    <!-- REQUEST SESSION MODAL -->
    <div class="modal fade fullapptdetails" id="requestsessionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body">
               <div class="row" style="justify-content:center">
                        <!-- ADD NEW APPT  -->
                        <div class="col">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="spur-card-title"> Request an appointment below </div>
                                </div>
                                <div class="card-body">
                                    <?php

                                    if(isset($_POST['apptsubmit'])) {
                                        echo '<p class="text-center text-success">Request made! '.$coach_first_name.' will get back to you shortly.</p>';
                                    }

                                    ?>
                                    <form class="new-appt" method="POST" action="schedule.php">
                                        <div class="form-group my-2">
                                            <label for="coachselect"><strong>Assigned Coach: </strong></label>
                                            <?php echo '<p>'.$coach_first_name.' '.$coach_last_name.'</p>';?>
                                            <input name="coachselect" type="hidden" value="<?php echo $coach_id;?>">
                                        </div>
                                        <div class="form-group my-2">
                                            <select name="sessionselect" class="form-control">
                                            <?php
                                                $sessionselect = "SELECT * FROM session";
                                                $result = $conn->query($sessionselect);
                                                if(!$result) {
                                                    echo $conn->error;
                                                }
                                                while($row=$result->fetch_assoc()) {
                                                    $sessionid = $row['id'];
                                                    $sessionname = $row['session_name'];
                                                    echo '<option value='.$sessionid.'>'.$sessionname.'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <span>Select a date:  </span>
                                        <div class="input-group date my-2">
                                            <input name="dateselect" type="text" class="form-control datepickr" id="datepickr" data-provide="datepicker">
                                        </div>
                                        <button name="apptsubmit" type="submit" class="btn btn-dark mt-3">Make Request</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END ADD NEW APPT -->
                    </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END OF REQUEST SESSION MODAL -->

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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(".datepickr").flatpickr({
            enableTime: true,
            time_24hr: true,
            minTime: "09:00",
            maxTime: "18:00",
            altInput: true,
            altFormat: "F j, Y - h:i:K",
            dateFormat: "Y-m-d H:i:S",
            minDate: "today",
        });
    </script>
</body>

</html>