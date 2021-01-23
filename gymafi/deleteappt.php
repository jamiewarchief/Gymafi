<?php
session_start();
include('conn.php');

if(isset($_POST['deleteappt'])); {
    $appttodelete = $_POST['deleteappt'];
    $coach_id = $_POST['coachid'];
    $client_id = $_POST['clientid'];
    $client_name = $_POST['clientname'];
    $date = $_POST['date'];
    $session_name = $_POST['sessionname'];



    $query = "DELETE FROM appointments WHERE id = $appttodelete";
    $result = $conn->query($query);
    if(!$result) {
        echo $conn->error;
    }

    $preparedsubject = 'Cancellation on '.$date;
    $preparedmessage = 'has cancelled your session.';
    $messagebody = $client_name.' '.$preparedmessage;
    $newmessagequery = "INSERT INTO messages (subject, message, sender_id, recipient_id)
                        VALUES ('$preparedsubject', '$messagebody', $client_id , $coach_id)";
    $insertmessage = $conn->query($newmessagequery);
        if(!$insertmessage) {
            echo $conn->error;
        }
        $lastid = $conn->insert_id;

        $mailboxquery = "INSERT INTO mailboxes (user_id, mailbox, message_id)
                        VALUES ($client_id, 'out', $lastid), ($coach_id, 'in', $lastid)";
        $updatemailbox = $conn->query($mailboxquery);
        if(!$updatemailbox) {
           echo $conn->error;
        }

        header('location: schedule.php');
    }


?>