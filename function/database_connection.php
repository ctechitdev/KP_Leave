<?php

//database_connection.php

$username = 'kplaocom';
$password = '0n8fRMmIFV1F';
$connect = new PDO( 'mysql:host=localhost;dbname=kplaocom_KPleave', $username, $password );


//$username = 'devapp';
//$password = 'Admin123';
//$connect = new PDO( 'mysql:host=localhost;dbname=kp_leave', $username, $password );

$connect -> exec("set names utf8");

?>
