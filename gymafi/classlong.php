<?php
    session_start();
    include('conn.php');

    if(isset($_SESSION['keep_username'])) {
        header('location: dash.php');
    } elseif (isset($_SESSION['keep_id'])) {
        header('location: dash.php');
    }

    if(isset($_GET['id'])) {
        $class_id = $_GET['id'];
    }

    $readclass = "SELECT * FROM classes WHERE id = '$class_id'";
    $resultclass = $conn->query($readclass);
    if(!$resultclass) {
        echo $conn->error;
    }

    while($row=$resultclass->fetch_assoc()) {
        $get_class_name = $row['class_name'];
        $get_class_info = $row['class_info'];
        $get_class_img = $row['img_path'];
        $get_coach_id = $row['coach_id'];
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
                    <a class="nav-link" href="contact.php">CONTACT US</a>
                </li>
                </ul>
            </div>
        </nav>

        <br><br><br><br>

        <div class="container my-5 pt-5 bg-warning">
                        <?php
                            echo '
                            <div class="card text-center text-light bg-dark">
                                <div class="card-body">
                                    <h4>'.$get_class_name.'</h4>
                                </div>
                            </div>    
                            <div class="card bg-dark text-white w-100">
                                <img src="'.$get_class_img.'" class="img-fluid mb-4">
                                <div class="card-body">
                                    <p class="card-text mb-4">'.$get_class_info.'</p>
                                    <a href="signup.php" class="btn btn-success btn-lg btn-block">SIGN UP TODAY</a>
                                    <a href="services.php" class="btn btn-light btn-lg btn-block">Go Back</a>
                                </div>
                            </div>
                            ';
                        ?>
        </div>
        

        


  
    <script src="js/alertify.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>