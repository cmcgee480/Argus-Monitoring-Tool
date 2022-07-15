<?php
if (isset($_GET['info'])) {
    $find = $_GET['info'];

    include('config/conn.php');

    $sql2 = "SELECT * FROM argus_methodTests WHERE serviceID=$find;";

    $result2 = $conn->query($sql2);


    if (!$result2) {
        echo $conn->error;
    }


    $sql3 = "SELECT * FROM argus_methodTimeTests WHERE serviceID=$find;";

    $result3 = $conn->query($sql3);


    if (!$result3) {
        echo $conn->error;
    }
}


function bandwithTest($serviceID)
{
    $kb = 1024;
    flush();
    $time = explode(" ", microtime());
    $start = $time[0] + $time[1];
    for ($x = 0; $x < $kb; $x++) {
        echo str_pad('', 1024, '.');
        flush();
    }
    $time = explode(" ", microtime());
    $finish = $time[0] + $time[1];
    $deltat = $finish - $start;

    $speed = round($kb / $deltat, 3);
    $duration = $deltat;
    $KB = $kb;
    include('config/conn.php');
    $sql2 = "UPDATE argus_bandwithTests SET duration=$duration,speed=$speed WHERE serviceID =$serviceID;";

    $result = $conn->query($sql2);
    if (!$result) {
        echo $conn->error;
    }
}

bandwithTest($find);

$sql3 = "SELECT * FROM argus_bandwithTests WHERE serviceID =$find;";
$result1 = $conn->query($sql3);
if (!$result1) {
    echo $conn->error;
}

if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $newKB = $row['kb'];
        $newDuration = $row['duration'];
        $newSpeed = $row['speed'];
    }
}

header(
    'Location: Chart1.php?info=$find'
);




?>


