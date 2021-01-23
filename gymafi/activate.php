<?php
    session_start();
    include('conn.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $checkactivate = "SELECT * FROM users WHERE id = $id";
    $checkresult = $conn->query($checkactivate);
    if(!$checkresult) {
        echo $conn->error;
    }

    $numrows = $checkresult->num_rows;
    if($numrows > 0) {
        $updatestatus = "UPDATE users SET user_status = 1 WHERE id = $id";
        $statusresult = $conn->query($updatestatus);
        if(!$statusresult) {
            echo $conn->error;
        }
    }

    $checkstatus = "SELECT * FROM users WHERE id = $id";
    $checkstatresult = $conn->query($checkstatus);
    if(!$checkstatresult) {
        echo $conn->error;
    }
    while($row=$checkstatresult->fetch_assoc()) {
        $userstatus = $row['user_status'];
    }

    if($userstatus == 1) {
        $_SESSION['keep_id'] = $id;
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>gymafi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="css/alertify.bootstrap.css" />
</head>

<body class="signupbody">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a href="index.php">
            <img src="/gymafi/img/gymafi_logo_circle.svg"
                            width="70" height="70" class="d-inline-block align-top loginbutton" alt=""></a>
            <span class="navbar-brand font-weight-bold text-white myheader mytitle" style="font-color: white !important;">gymafi</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="manifesto.php">OUR MANIFESTO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">OUR SERVICES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACT US</a>
                </li>
                </ul>
            </div>
        </nav>

        <br><br><br><br>

        <?php

                                // store all form data in local variables
                                if(isset($_POST['submit'])) {

                                    $searchemail = "SELECT email, pword FROM users WHERE id = $id";
                                    $emailresult = $conn->query($searchemail);
                                    if(!$emailresult) {
                                        echo $conn->error;
                                    }

                                    while($row=$emailresult->fetch_assoc()) {
                                        $savedemail = $row['email'];
                                        $savedpword = $row['pword'];

                                        $tempemail = $conn->real_escape_string($_POST['email']);
                                        $temppword = $conn->real_escape_string($_POST['pword']);
                                        if($savedemail == $tempemail && $savedpword == $temppword) {
                                            $email = $savedemail;
                                            $pword = $savedpword;
                                        }
                                    }


                                    $fname = $conn->real_escape_string($_POST['fname']);
                                    $lname = $conn->real_escape_string($_POST['lname']);
                                    $housenumber = $conn->real_escape_string($_POST['housenumber']);
                                    $postcode = $conn->real_escape_string($_POST['postcode']);
                                    $phonenumber = $conn->real_escape_string($_POST['phonenumber']);
                                    $username = $conn->real_escape_string($_POST['username']);

                                    $clientinsert = "UPDATE users SET username = '$username', first_name = '$fname', last_name = '$lname', postcode = '$postcode', house_number = '$housenumber', phone_number = '$phonenumber' WHERE id = $id";
                                    $result = $conn->query($clientinsert);
                                    if(!$result) {
                                        echo $conn->error;
                                    }

                                    $imginsert = "INSERT INTO profile_img (img_id) VALUES ($id)";
                                    $imgresult = $conn->query($imginsert);
                                    if(!$imgresult) {
                                        echo $conn->error;
                                    }
                                    if(isset($_SESSION['keep_id'])) {
                                        header('location: dash.php');
                                    }

                                }
                            ?>

        <div class="container my-5 pt-5 bg-warning">
            <div class="jumbotron bg-warning">
                <h1 class="display-4 text-center">Welcome to GYMAFI!</h1>
                <p class="lead text-center">Please fill in your profile details below to complete registration.</p>
                <hr class="my-4">
            <div class="row">
                <div class="col-sm"></div>
                <div class="card mb-3 bg-dark text-white w-50">
                    <img src="img/sweaty.jpg" class="card-img-top" alt="...">
                    <div class="card-body">

                        <form action="activate.php?id=<?php echo $id ?>" method="POST">
                            <span>For your added security, please re-enter your email and password</span>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="pword" type="password" class="form-control" id="pword" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Username</label>
                                <input name="username" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">First Name</label>
                                <input name="fname" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input name="lname" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">House Number / Name</label>
                                <input name="housenumber" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Postcode</label>
                                <input name="postcode" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone Number</label>
                                <input name="phonenumber" type="number" class="form-control" required>
                            </div>
                            <button name="submit" type="submit" class="btn btn-success">Submit</button>
                        </form>
                        
                    </div>
                </div>
                <div class="col-sm"></div>
            </div>
            </div>
        </div>
        

        


    <script src="js/alertify.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>