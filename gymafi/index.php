<?php
    session_start();
    include('conn.php');

    if(isset($_POST['username'])) {

        
        $username = $_POST['username'];
        $pword = $_POST['pword'];

        if (empty($username) || empty($pword)) {
            $message = "";
        } else {
            $auth = "SELECT * FROM users WHERE username = '$username' AND pword = '$pword'";
            $result = $conn->query($auth);
            $numrows = $result->num_rows;

            while($row=$result->fetch_assoc()) {
                    $id = $row['id'];
                    $is_admin = $row['is_admin'];
                }

            if ($numrows > 0) {
                
                $_SESSION['keep_username'] = $username;
                $_SESSION['keep_pword'] = $pword;
                $_SESSION['keep_id'] = $id;
                $_SESSION['is_admin'] = $is_admin;

                if(isset($_SESSION['keep_username'])) {
                    if($is_admin == 0) {
                        header('location: dash.php');
                    } elseif($is_admin == 1) {
                        header('location: admin/dash.php');
                    }
                }

                if (isset($remember)) {
                    setcookie('username', $_POST['username']);
                    setcookie('pword', $_POST['pword']);
                }
            }
        }
    }

    if(isset($_SESSION['keep_username'])) {
        header('location: dash.php');
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>gymafi</title>
    <link rel="icon" type="image/x-icon" href="/gymafi/img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="myscript.js"></script>
</head>

<body>
    <img src="/gymafi/img/beachrun.jpg" class="w-100">

    <!--STICKY BOTTOM NAVBAR-->
    <nav class="navbar fixed-bottom navbar-expand-lg navbar-light floaty">
        <div class="navbar-collapse w-100 order-3 dual-collapse2">
                <span class="navbar-brand font-weight-bold text-white myheader mytitle" style="font-color: white !important;">gymafi</span>
        </div>
    </nav>


    <nav class="navbar fixed-top navbar-expand-lg justify-content-end">
        <div class="col-2 w-100">
            <div class="btn-group dropdown">
                <a type="button" class="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/gymafi/img/gymafi_logo_circle.svg"
                                width="100%" height="100%" class="d-inline-block align-top loginbutton" alt="">
                </a>
                <div class="dropdown-menu mymenu px-2">
                            <a class="btn btn-warning btn-sm btn-block mysignup" data-toggle="modal" data-target="#loginmodal" href="#">LOG IN</a>
                            <a class="btn btn-success btn-sm btn-block" href="signup.php">SIGN UP</a>
                            <a class="btn btn-dark btn-sm btn-block" href="manifesto.php">MANIFESTO</a>
                            <a class="btn btn-light btn-sm btn-block" href="services.php">SERVICES</a>
                            <a class="btn btn-light btn-sm btn-block" href="contact.php">CONTACT</a>
                        
                </div>
            </div>
        </div>
    </nav>

    <!--TOGGLER NAV-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand font-weight-bold mytitle" href="index.php">gymafi</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="manifesto.php">OUR MANIFESTO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">OUR SERVICES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">CONTACT US</a>
                    </li>
                </ul>
                <div class="row navbar-nav mr-5">
                    <p class="nav-item">
                    <button type="button" class="btn btn-warning btn-lg btn-block m-3 mysignup" data-toggle="modal" data-target="#loginmodal">GET STARTED</button>
                    </p>
                </div>
            </div>
    </nav>

    <!--START OF MODAL CONTENT-->
    <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header my-1">
        <h5>Log in and track your progress now:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
            <form class="px-4 py-3" method="POST" action="index.php">
                <div class="form-group">
                    <input name="username" type="text" class="form-control username" id="exampleDropdownFormEmail1" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input name="pword" type="password" class="form-control pword pb-3" id="exampleDropdownFormPassword1" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input name="remember" type="checkbox" class="form-check-input" id="dropdownCheck">
                        <label class="form-check-label" for="dropdownCheck">
                        Remember me
                        </label>
                    </div>
                </div>
                <button name="login" type="submit" class="btn btn-dark">Log in</button>
            </form>

  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="signup.php"><p>Need more motivation? <strong>Sign up now.</strong></p></a>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--END OF MODAL CONTENT-->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>