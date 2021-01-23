<?php

    $user = "jnevin02";
    $pw = "mDQY18Xv5RBhXrYn";
    $server = "jnevin02.lampt.eeecs.qub.ac.uk";
    $db = "jnevin02";

    $conn = new mysqli($server, $user, $pw, $db);

    if($conn->connect_error) {
        echo $conn->connect_error;
    }

?>