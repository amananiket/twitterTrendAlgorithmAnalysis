<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
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
             




?>

</body>
</html>
