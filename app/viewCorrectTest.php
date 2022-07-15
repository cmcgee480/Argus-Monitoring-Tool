<?php
if (isset($_GET['info'])) {
    $find = $_GET['info'];

    //Test page where users can view Method Result Tests//
    //Method Execution time tests
    //Or Bandwidth Test

    include('config/conn.php');
    $sql = "SELECT * FROM argus_services WHERE serviceID=$find;";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }

    $sql2 = "SELECT * FROM argus_services WHERE serviceID=$find;";

    $result2 = $conn->query($sql);

    if (!$result2) {
        echo $conn->error;
    }
}

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $ch = curl_init($row['url']);
        $url = $row['url'];
        $hostname = $row['hostName'];
        $serviceID = $row['serviceID'];
        $status = $row['Status'];
        $serviceName = $row['ServiceName'];
    }
}

$sql3 = "SELECT * FROM argus_services WHERE serviceID=$find;";

$result3 = $conn->query($sql3);

if (!$result3) {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style5.css">

    <title>Service Details</title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <style type="text/css">
        #chart-container {
            width: 460PX;
            height: auto;
        }

        #chart-container2 {
            width: 460PX;
            height: auto;
        }

        #chart-container3 {
            width: 460PX;
            height: auto;
        }
    </style>
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

    </header>

    <div class="title">
        <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 30px; font-family: sans-serif;text-align:center;">
            Service ID:<?php echo "$find" ?></br>Name: <?php echo "$serviceName" ?>

        </h2>
        <div class="text-center" style="text-align:center;">
            <?php
            if ($result3->num_rows > 0) {
                while ($row = $result3->fetch_assoc()) {
                    echo " <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href='methodTests.php?info={$row['serviceID']}' class='btn'>Method Tests</a>
                    <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href='methodTimeTests.php?info={$row['serviceID']}' class='btn'>Method Execution Times</a>
                <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href='Chart1.php?info={$row['serviceID']}' class='btn'>Bandwith Test</a>";
                }
            }
            ?>


        </div>
    </div>




    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>