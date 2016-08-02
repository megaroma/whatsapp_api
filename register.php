<?php
include "vendor/autoload.php";

$username = "16462264945";
$debug = true;


$r = new Registration($username, $debug);

$code = 186282;



$res = $r->codeRegister($code);

echo "<pre>";
print_r($res);
echo "</pre>";
