<?php
session_start();
if (!isset($_SESSION['argusemail'])) {
    header('Location: login.php');
}
//Check Response URL page
//Once a user has added the servie they want to check in CheckURL Argus will check the response code of the URL
//Using the PHP framework cURL, if the url returns an error code argus will send the user an email warning
//If the service is not in the users dashboard Argus will add it 
//This service is also performed periodically by a cron job

include('config/email-config.php');
include('config/conn.php');


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

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$url = $_POST["userurl"];
$email = $_POST["useremail"];
$serviceName = $_POST["serviceName"];
$hostName = $_POST["hostName"];
$Status = "";
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
        $Status = "NOT ACTIVE";
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
} else {
    $Status = "ACTIVE";
}

$useremail = $_SESSION["argusemail"];
$sql = "SELECT argus_users.username FROM argus_users WHERE argus_users.email ='$useremail';";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = $row["username"];
    }
} else {
    echo "0 results";
}

//API endpoint that brings the user data down by passing a user's username 

$endp = "http://cmcgee17.lampt.eeecs.qub.ac.uk/Argus/app/api/index.php?username=$username";

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

$userdata = json_decode($res, true);

foreach ($userdata as $value) {

    $userID = $conn->real_escape_string($value['userID']);

    $sqlcheck = "SELECT * FROM argus_services WHERE url = '$url' AND userID = '$userID';";
    $resultcheck = mysqli_query($conn, $sqlcheck);
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
    <link rel="stylesheet" type="text/css" href="css/style3.css">

    <title>RESPONSE CODE</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1>ARGUS</h1>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="services.php"><a href="services.php">Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <?php
        foreach ($userdata as $value) {

            if (mysqli_num_rows($resultcheck) == 1) {
                $alreadythere = true;
                echo "<div class='title'>
                    <h1>Thank you {$useremail} We'll send an alert by email to you if your site is down. This workload is already on your Dashboard</h1>
                    <div class='button2' style='margin-top:90px;'>
                        <a href='services.php' class='btn'>BACK TO SERVICES</a>
                    </div>
                </div>";
            } else if (mysqli_num_rows($resultcheck) == 0) {
                $alreadythere = false;
                echo "<div class='title'>
                     <h1>Thank you {$useremail}. We've added this to your Dashboard and will send an alert by email to you if your site is down.</h1>
                     <div class='button2' style='margin-top:90px;'>
                    <a href='services.php' class='btn'>BACK TO SERVICES</a>
                    </div>
                     </div>";
            }
        }

        if (!$alreadythere) {
            $sql2 = "INSERT INTO argus_services (serviceID,url,ServiceName,Status,userID,hostName)
                    VALUES(null,'$url','$serviceName','$Status',$userID,'$hostName')";

            $result2 = $conn->query($sql2);

            if (!$result2) {
                echo $conn->error;
            }
        }

        ?>




    </header>









</body>

</html>