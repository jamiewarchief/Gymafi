<?php
session_start();
include('conn.php');

if(isset($_GET['mailboxid'])); {
    $idtodelete = $_GET['mailboxid'];
}

$query = "DELETE FROM mailboxes WHERE id = $idtodelete";
$result = $conn->query($query);
if(!$result) {
    echo $conn->error;
} else {
    echo "<script>alert('Message deleted!');</script>";
    header('location: messages.php');
}

?>