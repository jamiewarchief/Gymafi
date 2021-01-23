<?php
    session_start();
    include('conn.php');

    if(!isset($_SESSION['keep_id'])) {
        header('location: index.php');
    } else {
        $username = $_SESSION['keep_username'];
        $pword = $_SESSION['keep_pword'];
        $id = $_SESSION['keep_id'];

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
                $get_id = $row['id'];
                $get_first_name = $row['first_name'];
                $get_last_name = $row['last_name'];
                $get_username = $row['username'];
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
                                        <img class="myprofilepic" style="width:75px;height:75px;border-radius:50%" src="'.$imgdata.'"></a>
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

                        <?php

                            $read = "SELECT * FROM users WHERE id = $id";
                            $result = $conn->query($read);
                            if(!$result) {
                                echo $conn->error;
                            }

                            while($row = $result->fetch_assoc()) {
                                $get_id = $row['id'];
                                $get_first_name = $row['first_name'];
                                $get_last_name = $row['last_name'];
                                $get_postcode = $row['postcode'];
                                $get_house_number = $row['house_number'];
                                $get_phone_number = $row['phone_number'];
                                $get_username = $row['username'];
                                $get_email = $row['email'];
                                $get_admin = $row['is_admin'];
                                
                            }

                            if(isset($_POST['changefirstname'])) {
                                $newvalue = $conn->real_escape_string($_POST['newfirstname']);
                                $update = "UPDATE users SET first_name = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                            if(isset($_POST['changelastname'])) {
                                $newvalue = $conn->real_escape_string($_POST['newlastname']);
                                $update = "UPDATE users SET last_name = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                            if(isset($_POST['changeusername'])) {
                                $newvalue = $conn->real_escape_string($_POST['newusername']);
                                $update = "UPDATE users SET username = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                            if(isset($_POST['changeemail'])) {
                                $newvalue = $conn->real_escape_string($_POST['newemail']);
                                $update = "UPDATE users SET email = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                            if(isset($_POST['changepostcode'])) {
                                $newvalue = $conn->real_escape_string($_POST['newpostcode']);
                                $update = "UPDATE users SET postcode = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                            if(isset($_POST['changehousenumber'])) {
                                $newvalue = $conn->real_escape_string($_POST['newhousenumber']);
                                $update = "UPDATE users SET house_number = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                            if(isset($_POST['changephonenumber'])) {
                                $newvalue = $conn->real_escape_string($_POST['newphonenumber']);
                                $update = "UPDATE users SET phone_number = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                            if(isset($_POST['changepword'])) {
                                $newvalue = $conn->real_escape_string($_POST['newpword']);
                                $update = "UPDATE users SET pword = '$newvalue' WHERE id = $id";
                                $result = $conn->query($update);
                                if(!$result) {
                                    echo $conn->error;
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
                            }

                                echo '
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                        <div class="card text-white bg-dark m-3 d-inline-block" style="width: 25rem">
                                            <h5 class="card-header">Edit your personal details</h5>
                                            <div class="card-body">
                                                <span> Username </span>
                                                <form class="form-inline" action="profile.php" method="POST">
                                                    <label class="sr-only" for="inlineFormInputName2">Username</label>
                                                    <input name="newusername" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="'.$get_username.'">
                                                    <button name="changeusername" type="submit" class="btn btn-warning mb-2">Save</button>
                                                </form>
                                                <span> First Name </span>
                                                <form class="form-inline" action="profile.php" method="POST">
                                                    <label class="sr-only" for="inlineFormInputName2">First Name</label>
                                                    <input name="newfirstname" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="'.$get_first_name.'">
                                                    <button name="changefirstname" type="submit" class="btn btn-warning mb-2">Save</button>
                                                </form>
                                                <span> Last Name </span>
                                                <form class="form-inline" action="profile.php" method="POST">
                                                    <label class="sr-only" for="inlineFormInputName2">Last Name</label>
                                                    <input name="newlastname" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="'.$get_last_name.'">
                                                    <button name="changelastname" type="submit" class="btn btn-warning mb-2">Save</button>
                                                </form>
                                                <span> Email </span>
                                                <form class="form-inline" action="profile.php" method="POST">
                                                    <label class="sr-only" for="inlineFormInputName2">Email</label>
                                                    <input name="newemail" type="email" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="'.$get_email.'">
                                                    <button name="changeemail" type="submit" class="btn btn-warning mb-2">Save</button>
                                                </form>
                                                <span> Postcode </span>
                                                <form class="form-inline" action="profile.php" method="POST">
                                                    <label class="sr-only" for="inlineFormInputName2">Postcode</label>
                                                    <input name="newpostcode" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="'.$get_postcode.'">
                                                    <button name="changepostcode" type="submit" class="btn btn-warning mb-2">Save</button>
                                                </form>
                                                <span> House Number </span>
                                                <form class="form-inline" action="profile.php" method="POST">
                                                    <label class="sr-only" for="inlineFormInputName2">House Number</label>
                                                    <input name="newhousenumber" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="'.$get_house_number.'">
                                                    <button name="changehousenumber" type="submit" class="btn btn-warning mb-2">Save</button>
                                                </form>
                                                <span> Phone Number </span>
                                                <form class="form-inline" action="profile.php" method="POST">
                                                    <label class="sr-only" for="inlineFormInputName2">House Number</label>
                                                    <input name="newphonenumber" type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" value="'.$get_phone_number.'">
                                                    <button name="changephonenumber" type="submit" class="btn btn-warning mb-2">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                        '?>

                                        <div class="col">
                                        <div class="card text-white bg-dark m-3 d-inline-block" style="width: 25rem">
                                            <h5 class="card-header">Change your profile picture</h5>
                                            <div class="card-body">
                                                <form class="form-inline-block" action="profile.php" method="POST" enctype="multipart/form-data">
                                                    <input name="changeimg" type="file" class="form-control-file card-text mb-3">

                                                    <?php
                                                    if(isset($_POST['submitimg'])) {

                                                        if($_FILES['changeimg']['name'] != '') {
                                                            $filename = $_FILES['changeimg']['name'];
                                                            $filetemp = $_FILES['changeimg']['tmp_name'];
                                                            move_uploaded_file($filetemp, "profileimg/$filename");
                                                            $insertimg = "UPDATE profile_img SET img_path = 'profileimg/$filename' WHERE img_id = $id";
                                                            $result = $conn->query($insertimg);
                                                            if(!$result) {
                                                                echo $conn->error;
                                                            } else {
                                                            
                                                            }
                                                            echo '<p class="text-success">Profile picture changed!</p>';

                                                        } else {
                                                            echo '<p class="text-danger">Please choose an image to upload!</p>';
                                                        }

                                                    }
                                                    ?>

                                                    <button name="submitimg" type="submit" class="btn btn-warning mb-3 btn-block">Save</button>
                                                </form>
                                                <img class="card-img myprofilepic mt-3" src="<?php echo $imgdata;?>">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
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

    <!-- CONFIRMATION MODAL -->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Changes saved!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END  -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/spur.js"></script>
</body>

</html>