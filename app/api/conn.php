<?php

$passw = "khKmkBtMF430tPfs";

$username = "cmcgee17";

$db = "cmcgee17";

$host = "cmcgee17.lampt.eeecs.qub.ac.uk";

$conn = new mysqli($host, $username, $passw, $db);

if ($conn->error) {
    echo "not connected" . $conn->error;
} else {
    // echo "connection to DB found.";
}


?>