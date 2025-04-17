<?php
require('vendor/autoload.php');

$rcsdk = new RingCentral\SDK\SDK( "client_id", "client_secret", "server_url" );

$platform = $rcsdk->platform();
$platform->login( "username", "extension_number", "password" );

$resp = $platform->post('/account/~/extension/~/ring-out',
    array(
      'from' => array( 'phoneNumber' => "13445554444" ),
      'to' => array( 'phoneNumber' => "13455553434" ),
      'playPrompt' => true
    ));

print_r ("Call placed. Call status: " . $resp->json()->status->callStatus);
?>