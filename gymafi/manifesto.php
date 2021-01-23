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
                    <a class="nav-link" href="manifesto.php">OUR MANIFESTO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">OUR SERVICES</a>
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
            
            <div class="jumbotron bg-dark text-white">
                <div class="container">
                    <h1 class="display-4 text-warning">OUR MANIFESTO</h1>
                    <hr class="my-4">
                    <p class="lead">GYMAFI was born out of a lifelong pursuit of going beyond expectations, breaking barriers, and doing the best we can for those around us. For years we have learned, grown, listened, and trusted our process. Do you trust yours?</p>
<br>
<p>My name is Jamie Nevin. I will lead you by the hand and take you on a journey across the story arc of the future you want to see - for yourself, your friends, your loved ones - with a perfect ending. You’ll discover the new you over a series of personal, tailored, one-to-to sessions, and are welcome to participate in a variety of classes that will show you a new marriage of fun and excellent lifestyle choices.</p>
<br>
<p>What’s more - you will be at the beginning of a very special era. The GYMAFI family will be growing with you and our strong community spirit will be the strong glue that binds us.</p>
                </div>
            </div>
                <a href="signup.php" role="button" class="btn btn-success btn-lg btn-block">SIGN UP TODAY</a>

        </div>
  
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>