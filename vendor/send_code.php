<?php
include "vendor/autoload.php";

$username = "16462264945";
$debug = true;


$r = new Registration($username, $debug);

$r->codeRequest('sms');
