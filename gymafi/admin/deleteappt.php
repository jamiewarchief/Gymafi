<?php
session_start();
include('../conn.php');

if(isset($_POST['deleteappt'])); {
    $appttodelete = $_POST['deleteappt'];
    $client_id = $_POST['clientid'];
    $coach_id = $_POST['coachid'];
    $coach_name = $_POST['coachname'];
    $date = $_POST['date'];
    $session_name = $_POST['sessionname'];



    $query = "DELETE FROM appointments WHERE id = $appttodelete";
    $result = $conn->query($query);
    if(!$result) {
        echo $conn->error;
    }
    
    $preparedsubject = 'Cancellation on '.$date;
    $preparedmessage = 'has cancelled your session.';
    $messagebody = $coach_name.' '.$preparedmessage;
    $newmessagequery = "INSERT INTO messages (subject, message, sender_id, recipient_id)
                        VALUES ('$preparedsubject', '$messagebody', $coach_id, $client_id)";
    $insertmessage = $conn->query($newmessagequery);
        if(!$insertmessage) {
            echo $conn->error;
        }
        $lastid = $conn->insert_id;

        $mailboxquery = "INSERT INTO mailboxes (user_id, mailbox, message_id)
                        VALUES ($coach_id, 'out', $lastid), ($client_id, 'in', $lastid)";
        $updatemailbox = $conn->query($mailboxquery);
        if(!$updatemailbox) {
           echo $conn->error;
        }

        echo "<script>alert('Appointment deleted!');</script>";
        header('location: schedule.php');
    }


?>