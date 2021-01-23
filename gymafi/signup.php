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
                    <a class="nav-link" href="manifesto.php"> OUR MANIFESTO</a>
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

        <div class="container my-5 bg-warning">
            <div class="jumbotron bg-warning">
                <h1 class="display-4 text-center">Get started with GYMAFI!</h1>
                <p class="lead text-center">Fill in the details below to begin your journey.</p>
                <hr class="my-4">

                    <?php

                                // store all form data in local variables
                                if(isset($_POST['submit'])) {
                                    // echo "<meta http-equiv='refresh' content='0'>";
                                    $email = $conn->real_escape_string($_POST['email']);
                                    $temppword = $_POST['pword'];
                                    $temppwordrepeat = $_POST['pwordconfirm'];

                                    if($temppword != $temppwordrepeat) {
                                        echo '<h4 class="text-danger text-center">Passwords don\'t match! Please try again.</h4>';
                                    } else {
                                        $pword = $conn->real_escape_string($_POST['pword']);
                                        
                                        // store and run SQL query 
                                        $read = "SELECT * FROM users WHERE email = '$email' AND pword = '$pword' ";
                                        $result = $conn->query($read);
                                        $numrows = $result->num_rows;
                                        
                                        if($numrows > 0) {
                                            echo '<h4 class="text-danger text-center">Account already exists! Please try again.</h4>';
                                        } else {
                                            
                                            $clientinsert = "INSERT INTO users (email, pword, is_admin) VALUES ('$email', '$pword', 0)";
                                            $result = $conn->query($clientinsert);
                                            // echo "<meta http-equiv='refresh' content='0'>";
                                            if(!$result) {
                                                echo $conn->error;
                                            }
                                            $lastid = $conn->insert_id;
                                            $activatelink = "http://jnevin02.lampt.eeecs.qub.ac.uk/gymafi/activate.php?id=$lastid";
                                            $subject = "Gymafi Account Activation";
                                            $content = "You're nearly there!"."\r\n"."Please follow the link below to activate your account:"."\r\n\r\n".$activatelink;
                                            
                                            mail($email, $subject, $content);
                                            echo '<h3 class="py-3 text-center text-success">Confirmation sent - check your mailbox!</h3>';
                                            echo '<h5 class="pb-3 text-center text-success">Click <a href="index.php">here</a> to return to the home page.</h5>';
                                        }
                                    }
                                }
                            ?>
            <div class="row">
                <div class="col-sm"></div>
                <div class="card mb-3 bg-dark text-white w-75">
                    <div class="card-body">


                        <form action="signup.php" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="pword">Password</label>
                                <small id="emailHelp" class="form-text text-muted">Make sure your password is between 5-12 characters, with no special characters.</small>
                                <input name="pword" type="password" pattern=".{5,12}" class="form-control" id="pword" required title="Your password must be 5-12 characters in length">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Repeat Password</label>
                                <span id='pwordmessage'></span>
                                <input name="pwordconfirm" type="password" class="form-control" id="pwordrepeat" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">I agree to T&Cs</label>
                            </div>
                            <button name="submit" type="submit" class="btn btn-success">Submit</button>
                        </form>

                    </div>
                </div>
                <div class="col-sm"></div>
                    <img src="img/neon.jpg" class="card-img-top" alt="...">
            </div>
            </div>
        </div>
        
    <script>
        $(function(){

            $('#pword, #pwordrepeat').on('keyup', function () {
                if ($('#pword').val() == $('#pwordrepeat').val()) {
                    $('#pwordmessage').html('Matching').css('color', 'green');
                } else 
                    $('#pwordmessage').html('Not Matching').css('color', 'red');
            });

        });
    </script>
    <script src="js/alertify.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>