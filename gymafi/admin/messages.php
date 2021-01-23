<?php
    session_start();
    include('../conn.php');


    if(!isset($_SESSION['keep_id'])) {
        header('location: ../index.php');
    } else {
        $id = $_SESSION['keep_id'];
        $is_admin = $_SESSION['is_admin'];

        if($is_admin == 0) {
            header('location: ../dash.php');
        }

        if (isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header('location: ../index.php');
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
    <script src="/gymafi/js/chart-js-config.js"></script>
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
                                        <a href="../admin/profile.php"><img class="myprofilepic" style="width:75px;height:75px;border-radius:50%" src="'.$imgdata.'"></a>
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
                <!-- MESSAGES -->
                <div class="container">
                    
                    <ul class="nav nav-tabs">
                        <li class="nav-item btn-dark">
                            <a class="nav-link active text-warning" data-toggle="tab" href="#inbox">INBOX</a>
                        </li>
                        <li class="nav-item btn-dark">
                            <a class="nav-link text-warning" data-toggle="tab" href="#outbox">SENT</a>
                        </li>
                        <li class="nav-item btn-dark">
                            <a class="nav-link text-warning" data-toggle="tab" href="#newmessage">NEW MESSAGE</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="inbox">
                            <!-- INBOX -->
                            <div class="card spur-card">
                                <div class="card-body card-body-with-dark-table">
                                    <table class="table table-hover table-dark table-in-card">
                                        <thead>
                                            <tr>
                                                <th scope="col">Received</th>
                                                <th scope="col">From</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $read = "SELECT mailboxes.id AS mailbox_id, message_id, subject, message, sender_id, created FROM mailboxes
                                                    LEFT JOIN messages
                                                    ON messages.id = mailboxes.message_id
                                                    WHERE mailboxes.user_id = $id
                                                    AND mailboxes.mailbox = 'in'
                                                    ORDER BY messages.created DESC";
                                            $result = $conn->query($read);
                                            if(!$result) {
                                                echo $conn->error;
                                            }

                                            while($row=$result->fetch_assoc()) {
                                                $datetime = strtotime($row['created']);
                                                $humandate = date('d M y @ H:i', $datetime);
                                                $sender_id = $row['sender_id'];
                                                $subject = $row['subject'];
                                                $message = $row['message'];
                                                $mailbox_id = $row['mailbox_id'];
                                                $message_id = $row['message_id'];

                                                $findsender = "SELECT first_name, last_name
                                                            FROM users
                                                            INNER JOIN messages
                                                            ON messages.sender_id = users.id
                                                            WHERE messages.sender_id = $sender_id";
                                                $senderresult = $conn->query($findsender);
                                                if(!$senderresult) {
                                                    $conn->error;
                                                }
                                                if($sender_id == 0) {
                                                    $senderfirstname = 'New';
                                                    $senderlastname = 'Customer';
                                                } else {
                                                    while($row=$senderresult->fetch_assoc()) {
                                                            $senderfirstname = $row['first_name'];
                                                            $senderlastname = $row['last_name'];
                                                        }
                                               }

                                                echo '
                                                <tr>
                                                    <td>'.$humandate.'</td>
                                                    <td>'.$senderfirstname.' '.$senderlastname.'</td>
                                                    <td>'.$subject.'</td>
                                                    <td>'.$message.'</td>
                                                    <td><a style="color:green" href="readmessage.php?id='.$message_id.'">read</a></td>
                                                    <td><a style="color:red" href="../deletemessage.php?mailboxid='.$mailbox_id.'">delete</a></td>
                                                </tr>
                                                ';
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END OF INBOX -->
                        </div>
                        <div class="tab-pane fade" id="outbox">
                            <!-- OUTBOX -->
                            <div class="card spur-card">
                                <div class="card-body card-body-with-dark-table">
                                    <table class="table table-hover table-dark table-in-card">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sent</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $read = "SELECT mailboxes.id AS mailbox_id, message_id, subject, message, recipient_id, created FROM mailboxes
                                                    LEFT JOIN messages
                                                    ON messages.id = mailboxes.message_id
                                                    WHERE mailboxes.user_id = $id
                                                    AND mailboxes.mailbox = 'out'
                                                    ORDER BY messages.created DESC";
                                            $result = $conn->query($read);
                                            if(!$result) {
                                                echo $conn->error;
                                            }

                                            while($row=$result->fetch_assoc()) {
                                                $datetime = strtotime($row['created']);
                                                $humandate = date('d M y @ H:i', $datetime);
                                                $recipient_id = $row['recipient_id'];
                                                $subject = $row['subject'];
                                                $message = $row['message'];
                                                $message_id = $row['message_id'];
                                                $mailbox_id = $row['mailbox_id'];

                                                $findrecipient = "SELECT first_name, last_name
                                                            FROM users
                                                            INNER JOIN messages
                                                            ON messages.recipient_id = users.id
                                                            WHERE messages.recipient_id = $recipient_id";
                                                $recipientresult = $conn->query($findrecipient);
                                                if(!$recipientresult) {
                                                    $conn->error;
                                                } 
                                                while($row=$recipientresult->fetch_assoc()) {
                                                    $recipientfirstname = $row['first_name'];
                                                    $recipientlastname = $row['last_name'];
                                                }

                                                echo '
                                                <tr>
                                                    <td>'.$humandate.'</td>
                                                    <td>'.$recipientfirstname.' '.$recipientlastname.'</td>
                                                    <td>'.$subject.'</td>
                                                    <td>'.$message.'</td>
                                                    <td><a style="color:green" href="readmessage.php?id='.$message_id.'">read</a></td>
                                                    <td><a style="color:red" href="../deletemessage.php?mailboxid='.$mailbox_id.'">delete</a></td>
                                                </tr>
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END OF OUTBOX -->
                        </div>
                        <div class="tab-pane fade" id="newmessage">
                            <!-- NEW MESSAGE -->
                            <div class="card spur-card bg-dark text-white">
                                <div class="card-body">
                                    <form action="messages.php" method="POST">
                                        <div class="form-group">
                                            <label for="clientselect"><strong>Choose a client</strong></label>
                                            <select name="clientselect" class="form-control bg-dark text-white" id="clientselect">
                                            <?php

                                                $read = "SELECT * FROM users WHERE is_admin = 0";
                                                $result = $conn->query($read);
                                                if(!$result) {
                                                    echo $conn->error;
                                                }

                                                while($row=$result->fetch_assoc()) {
                                                    $get_client_first_name = $row['first_name'];
                                                    $get_client_last_name = $row['last_name'];
                                                    $get_client_id = $row['id'];
                                                    echo '<option value='.$get_client_id.'>'.$get_client_first_name.' '.$get_client_last_name.'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject"><strong>Subject</strong></label>
                                            <input name="messagesubject" type="text" class="form-control bg-dark text-white" id="subject">
                                        </div>
                                        <div class="form-group">
                                            <label for="messagebody"><strong>Message</strong></label>
                                            <textarea name="messagetosend" class="form-control bg-dark text-white" id="messagebody" rows="5"></textarea>
                                        </div>
                                        <button name="sendmessage" type="submit" class="btn btn-light">Send</button>
                                    </form>
                                </div>
                            </div>
                            <!-- END OF NEW MESSAGE -->
                        </div>
                    </div>
                </div>
                <!-- END OF MESSAGES -->
            </main>
        </div>
    </div>

    <?php

        if(isset($_POST['sendmessage'])) {
            $clientselect = $conn->real_escape_string($_POST['clientselect']);
            $messagesubject = $conn->real_escape_string($_POST['messagesubject']);
            $messagetosend = $conn->real_escape_string($_POST['messagetosend']);

            $newmessagequery = "INSERT INTO messages (subject, message, sender_id, recipient_id)
                                VALUES ('$messagesubject', '$messagetosend', $id, $clientselect)";
            $insertmessage = $conn->query($newmessagequery);
            if(!$insertmessage) {
               echo $conn->error;
            }
            $lastid = $conn->insert_id;

            $mailboxquery = "INSERT INTO mailboxes (user_id, mailbox, message_id)
                            VALUES ($id, 'out', $lastid), ($clientselect, 'in', $lastid)";
            $updatemailbox = $conn->query($mailboxquery);
            if(!$updatemailbox) {
               echo $conn->error;
            }

            echo "<meta http-equiv='refresh' content='0'>";
        }

    ?>

    <!-- READ MESSAGE MODAL -->
    <div class="modal fade" id="readmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $message_id; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <!-- END OF READ MESSAGE MODAL -->

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