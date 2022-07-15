<?php

session_start();
include('config/conn.php');
include('config/email-config.php');

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


if (!isset($_SESSION['argusemail'])) {
    header('Location: login.php');
}

$useremail = $_SESSION["argusemail"];
$sql = "SELECT argus_users.username, argus_users.userID FROM argus_users WHERE argus_users.email ='$useremail';";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = $row["username"];
        $find = $row["userID"];
    }
} else {
    echo "0 results";
}



$endp = "http://cmcgee17.lampt.eeecs.qub.ac.uk/Argus/app/api/index.php?userID=$find";
$user = "cmcgee480";

$pw = "Mus1c5020";

$opts = array(

    'http' => array(
        'method' => "GET",
        'header' => "Authorization: Basic " . base64_encode("$user:$pw")
    )
);

$context = stream_context_create($opts);

$res = file_get_contents($endp, false, $context);

$servicedata = json_decode($res, true);

foreach ($servicedata as $value) {

    $url = $value['url'];
    $email = $useremail;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
    curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if (($httpcode != 200) && ($httpcode != 302)) {

        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = "true";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = $fromEmail;
            $mail->Password = $fromPassword;
            $mail->Subject = "Warning from ARGUS";
            $mail->setFrom("mcgee.cp@gmail.com");
            $mail->Body = "Hi there, your site $url returned an error code and appears to be down.";
            $mail->addAddress($email);
            $mail->Send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $mail->smtpClose();
        $sql3 = "UPDATE argus_services SET `Status` = 'NOT ACTIVE' WHERE `url` = '$url';";
        $result3 = $conn->query($sql3);
        if (!$result3) {
            echo $conn->error;
        }
    } else {
        $sql4 = "UPDATE argus_services SET `Status` = 'ACTIVE' WHERE `url` = '$url';";
        $result4 = $conn->query($sql4);
        if (!$result4) {
            echo $conn->error;
        }
    }
}

$sql2 = "SELECT argus_users.userID,username, password,email, FullName,argus_services.serviceID,argus_services.url,argus_services.ServiceName,argus_services.Status
FROM argus_users JOIN argus_services 
ON argus_users.userID = argus_services.userID WHERE argus_users.username = '$username';";

$result2 = $conn->query($sql2);
if (!$result2) {
    echo $conn->error;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <title>LOCUST Load test</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1>ARGUS</h1>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="services.php">Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <div class="title">
            <h2 style="color: white;font-size: 60px; font-family: sans-serif;text-align:center;">
                Load test your site using Locust io</h2>
        </div>

        <div class="button">
            <a href="#middle2" class="btn">Click here</a>
        </div>


    </header>


    <div id="middle2">
        <h1>Choose a service you'd like to load test</h1>

        <div class="content" style="height: 50px;font-size: 20px; margin-bottom: 0px;
        padding-bottom: 0px;">
            <div data-aos='fade-up' data-aos-duration='800' class='servicedashboard'>

                <table class='table table-dark table-hover'>
                    <thead>
                        <tr>
                            <th>ServiceID</th>
                            <th>Username</th>
                            <th>ServiceName</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>

                    <?php
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "  <tbody>
                        <tr>
                            <td>{$row['serviceID']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['ServiceName']}</td>
                            <td>{$row['Status']}</td>
                            <td><a href='{$row['url']}'target='_blank' class='viewbutton'>View</a></td>
                            <td><a href='httpserverupload.php?info={$row["serviceID"]}' class='viewbutton'>Test</a></td>
                        </tr>
                    </tbody>";
                        }
                    }
                    ?>








                </table>



            </div>
        </div>


    </div>








</body>

</html>