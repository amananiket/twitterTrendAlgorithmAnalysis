<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require 'app_tokens.php';
require 'tmhOAuth.php';

$connection = new tmhOAuth(array(
'consumer_key' => $consumer_key,
'consumer_secret' => $consumer_secret,
'user_token' => $user_token,
'user_secret' => $user_secret
        ));
$code = $connection->request('POST', 
$connection->url('1.1/statuses/update'), 
array('status' => ' ^-^ '));

if ($code == 200) 
{
print "Tweet sent";
} else {
print "Error: $code";
}

?>
