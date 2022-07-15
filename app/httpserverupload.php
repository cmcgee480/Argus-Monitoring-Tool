<?php
session_start();

if (isset($_GET['info'])) {
    $find = $_GET['info'];

    $endp = "http://cmcgee17.lampt.eeecs.qub.ac.uk/Argus/app/api/index.php?serviceID=$find";

    $user = 'cmcgee480';

    $pw = 'Mus1c5020';

    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => 'Authorization: Basic ' . base64_encode("$user:$pw"),
        ],
    ];

    $context = stream_context_create($opts);

    $res = file_get_contents($endp, false, $context);

    $servicedata = json_decode($res, true);
}

$output = shell_exec('ipconfig');
echo $output;

?>


