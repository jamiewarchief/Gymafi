<?php
    session_start();
    include('conn.php');

    if(isset($_SESSION['keep_username'])) {
        header('location: dash.php');
    } elseif (isset($_SESSION['keep_id'])) {
        header('location: dash.php');
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
                    <a class="nav-link" href="contact.php">CONTACT US <span class="sr-only">(current)</span></a>
                </li>
                </ul>
                <form action="signup.php" class="form-inline my-2 my-lg-0">
                    <button class="btn btn-lg btn-success my-2 my-sm-0" type="submit">SIGN UP</button>
                </form>
            </div>
        </nav>

        <br><br><br><br>

        <div class="container my-5 pt-5">

        <div class="jumbotron bg-warning mb-0">
            <h1 class="display-4">Send us a message.</h1>
                <hr>
        </div>

        <?php

        if(isset($_POST['customersubmit'])) {
            $customername = $_POST['customername'];
            $customeremail = $_POST['customeremail'];
            $customermessage = $_POST['customermessage'];
            $messagesubject = 'Name: '.$customername.' |  Email: '.$customeremail;

            $newmessagequery = "INSERT INTO messages (subject, message, sender_id, recipient_id)
                                VALUES ('$messagesubject', '$customermessage', 0, 100)";
            $insertmessage = $conn->query($newmessagequery);
            if(!$insertmessage) {
                echo $conn->error;
            }
            $lastid = $conn->insert_id;

            $mailboxquery = "INSERT INTO mailboxes (user_id, mailbox, message_id)
                            VALUES (100, 'in', $lastid)";
            $updatemailbox = $conn->query($mailboxquery);
            if(!$updatemailbox) {
               echo $conn->error;
               echo '<h2 class="py-3 text-center text-danger">Sorry, something went wrong! Please try again.</h2>';
            } else {
                echo '<h2 class="py-3 text-center text-success">Message sent! We\'ll be in touch soon.</h2>';
            }

        }

        ?>

        <div class="card">
            <div class="card-body bg-dark text-white">
                <form class="form" method="POST" action="contact.php">
                            <div class="text-left mb-4">
                                <h5 class="text-warning">Don't hesitate to get in touch if you have any questions, and one of our coaches will get back to you as soon as possible.</h5>
                            </div>
                            <div class="row pb-4">
                                <div class="col">
                                <div class="form-label-group">
                                    <input name="customername" type="text" class="form-control" placeholder="Your Name" required autofocus>
                                </div>
                                </div>
                                <div class="col">
                                <div class="form-label-group">
                                    <input name="customeremail" type="email" class="form-control" placeholder="Your Email Address" required>
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="customermessage" class="form-control" rows="5" placeholder="Your Message Here" required></textarea>
                            </div>


                            <button name="customersubmit" class="btn btn-lg btn-success btn-block" type="submit">Send</button>
                        </form>
            </div>
        </div>

        </div>

  
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>




