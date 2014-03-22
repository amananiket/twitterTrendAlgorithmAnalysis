<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $service_url = 'https://www.googleapis.com/freebase/v1/topic';
    $topic_id = '/travel/tour_operator';
  $params = array('key'=>'AIzaSyCWEWgNUbgofdRcl70E5EWXNuirmiPofjI');
  $url = $service_url . $topic_id . '?' . http_build_query($params);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $topic = json_decode(curl_exec($ch), true);
  curl_close($ch);
  print_r($topic, false);
        ?>
    </body>
</html>
