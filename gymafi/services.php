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
                    <a class="nav-link" href="services.php">OUR SERVICES <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACT US</a>
                </li>
                </ul>
                <form action="signup.php" class="form-inline my-2 my-lg-0">
                    <button class="btn btn-lg btn-success my-2 my-sm-0" type="submit">SIGN UP</button>
                </form>
            </div>
        </nav>

        <br><br><br><br>

        <div class="container my-5 pt-5 bg-warning">
            <div class="jumbotron bg-warning">
                <h1 class="display-4">What we do at GYMAFI.</h1>
                <p class="lead">We offer a personally tailored lifestyle plan to each valuable client, with independent coaching at an expert level. You will grow together with us, as we expand our horizons and strengthen our minds and bodies, joining an ever-growing team of walking success stories.</p>
                <p>On top of our bespoke one-on-one sessions, we also provide a selection of group classes to suit everyone. Browse these below, and get in touch to make a big change to yourself and others around you, today.</p>
                <hr class="my-4">
            <a href="signup.php" role="button" class="btn btn-success btn-lg btn-block">SIGN UP TODAY</a>
            </div>
            <div class="row row-cols-1 row-cols-md-2">

            <?php

            $read = "SELECT * FROM classes ORDER BY id ASC";
            $result = $conn->query($read);
            if(!$result) {
               echo $conn->error;
            }

            while($row=$result->fetch_assoc()) {
                        
                $get_class_name = $row['class_name'];
                $get_class_info = $row['class_info'];
                $get_class_desc = $row['class_desc'];
                $get_class_img = $row['img_path'];
                $get_coach_id = $row['coach_id'];
                $get_class_id = $row['id'];

                $coachread = "SELECT first_name, last_name FROM users WHERE id = $get_coach_id";
                $coachresult = $conn->query($coachread);
                if(!$coachresult) {
                    echo $conn->error;
                }
                while($row=$coachresult->fetch_assoc()) {
                    $coach_first_name = $row['first_name'];
                    $coach_last_name = $row['last_name'];
                }
        
            echo '
            
                <div class="col mb-4">
                    <div class="card bg-dark text-warning text-center">
                        <a href="classlong.php?id='.$get_class_id.'"><img src="'.$get_class_img.'" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h5 class="card-title text-warning text-center">'.$get_class_name.'</h5>
                            <p class="card-text text-white">'.$get_class_desc.'</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><em>by '.$coach_first_name.' '.$coach_last_name.'</em></small>
                            <hr>
                            <a href="classlong.php?id='.$get_class_id.'"><button type="button" class="btn btn-success">find out more</button></a>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
            </div>
        </div>
  
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>