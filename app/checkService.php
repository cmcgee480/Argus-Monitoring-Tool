<?php

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


date_default_timezone_set("Europe/London");


$endp = "http://cmcgee17.lampt.eeecs.qub.ac.uk/Argus/app/api/index.php?allservices";
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
    $email = 'mcgee.cp@gmail.com';
    $status = $value['Status'];
    $timeStamp = $value['TimeStamp'];
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
            $newStatus = 'NOT ACTIVE';
            if ($newStatus != $status) {
                $date = date("Y-m-d H:i:s");
                $timeStamp = $date;
                $sql15 = "UPDATE argus_services SET `Status` = '$newStatus',`TimeStamp`='$timeStamp'
                WHERE `url` = '$url';";
                $result15 = $conn->query($sql15);
                if (!$result15) {
                    echo $conn->error;
                }
            } else {
                $timeStamp = $value['TimeStamp'];
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $mail->smtpClose();
    } else {
        $newStatus = 'ACTIVE';
        if ($newStatus != $status) {
            $date = date("Y-m-d H:i:s");
            $timeStamp = $date;
            $sql14 = "UPDATE argus_services SET `Status` = '$newStatus',`TimeStamp`='$timeStamp'
            WHERE `url` = '$url';";
            $result14 = $conn->query($sql14);
            if (!$result14) {
                echo $conn->error;
            }
        } else {
            $timeStamp = $value['TimeStamp'];
        }
    }
}
