<?php
   require 'app_tokens.php';
   require 'tmhOAuth.php';
   $connection = new tmhOAuth(array(
                 'consumer_key'=>$consumer_key,
                 'consumer_secret'=>$consumer_secret,
                 'user_token'=>$user_token,
                 'user_secret'=>$user_secret  
                 ));
   $woeid = $_GET["woeid"];
   $request = $connection->request('GET',$connection->url('/1.1/trends/place.json'),
                                    array('id'=>$woeid));
                                                           
   $request_response = $connection->response['response'];
   
   echo $request_response;
   
   /*
   $data=  json_decode($request_response,true);
   $c = 0;
   
   
   foreach($data['trends'] as $value)
   {
       $store[$c++] = $value['name'];
   }
   
   print_r($store,false);*/
   ?>

