<?php
include "vendor/autoload.php";
//https://github.com/mgp25/Chat-API/wiki/WhatsAPI-Documentation#number-registration



/*

Dependencies

PHP >= 5.6 is required

To support encryption, API requires (MUST):

    PHP Protobuf
    Curve25519 PHP
    crypto PECL

git clone https://github.com/allegro/php-protobuf.git

composer install
phpize
./configure
make
sudo make install

git clone https://github.com/mgp25/curve25519-php

phpize
./configure
make
sudo make install


php -i | grep .ini

You will see something like: Loaded Configuration File => /etc/php5/cli/php.ini
This is the configuration path. Edit this file:

extension=curve25519.so
extension=protobuf.so








https://github.com/megaspy/whatsapp_api.git

*/




//$username = "16462264945";
//$debug = true;

// Create a instance of Registration class.
//$r = new Registration($username, $debug);

//$r->codeRequest('sms');
//exit;

/*
Array
(
    [cc] => 1
    [in] => 6462264945
    [lg] => en
    [lc] => US
    [id] => ������]����u3^�
    [token] => XciykzZtezAXtkqRIM4m4ZrUeW4=
    [mistyped] => 6
    [network_radio_type] => 1
    [simnum] => 1
    [s] => 
    [copiedrc] => 1
    [hasinrc] => 1
    [rcmatch] => 1
    [pid] => 6098
    [rchash] => dbaec7dec68584c635ddd3fcaf17ecaf693f58fe85d1cfa4b3c798b41e7fb7bc
    [anhash] => 7336feba5ed3028fb06226de77ca4f52
    [extexist] => 1
    [extstate] => 1
    [mcc] => 310
    [mnc] => 260
    [sim_mcc] => 310
    [sim_mnc] => 260
    [method] => sms
)
stdClass Object
(
    [status] => sent
    [length] => 6
    [method] => sms
    [retry_after] => 64
    [sms_wait] => 64
    [voice_wait] => 64
)


*/

//$code = 186282;



//$res = $r->codeRegister($code);


//print_r($res);

//exit;
//stdClass Object ( [status] => ok [login] => 16462264945 [type] => existing [pw] => Mpojoo6iNBaQisxNELEKBvOsNFg= [expiration] => 4444444444 [kind] => free [price] => $0.99 [cost] => 0.99 [currency] => USD [price_expiration] => 1472874613 ) 






//---------------


$username = "16462264945";
$nickname = "darkromanovich";
$password = "S0f219B2QCGgVMPH35JPiKkFU2A="; // The one we got registering the number
$debug = true;

// Create a instance of WhastPort.
$w = new WhatsProt($username, $nickname, $debug);
$events = new MyEvents($w);
$events->setEventsToListenFor($events->activeEvents);
$w->setMessageStore(new SqliteMessageStore($username));
$w->connect(); // Connect to WhatsApp network
$res = $w->loginWithPassword($password);

print_r($res);

$target = '64221077162'; // The number of the person you are sending the message
$message = 'test';

//$res = $w->sendMessage($target , $message);

//print_r($res);

//$res =$w->pollMessage();

//print_r($res);


function onMessage($mynumber, $from, $id, $type, $time, $name, $body)
{
    echo "Message from $name:\n$body\n\n";
}

//$w = new WhatsProt($username, $identity, $nickname, $debug);
//$events = new MyEvents($w);
//$res = $w->eventManager()->bind("onGetMessage", "onMessage");


print_r($res);


while($w->pollMessage()) {

}


