<?php
require 'app_tokens.php';
require 'tmhOAuth.php';
       
$query = $_GET["q"];
$connection = new tmhOAuth(array(
                      'consumer_key'=>$consumer_key,
                      'consumer_secret'=>$consumer_secret,
                      'user_token'=>$user_token,
                      'user_secret'=>$user_secret
                      ));
$res = $connection->request('GET',$connection->url('/1.1/search/tweets.json'),array(
                                    'q'=> $query,
                                    'count'=> 100,
                                    'include_entities'=>true,
                                    'result_type'=>'mixed',
                                    'callback'=>'?'
                                    ));
        $search = $connection->response['response'];


?>
