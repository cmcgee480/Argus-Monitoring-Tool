<?php


function pageload($url){
    $t = microtime( TRUE );
    $url="http://phpweb.c40112620.qpc.hal.davecutting.uk/";
    file_get_contents( $url+"index.php" );
    $t = microtime( TRUE ) - $t;
    print "It took $t seconds!";
}




?>