<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="head.css">
        <script src="jquery-1.9.1.js"></script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>
            #limit
            {
                text-align: center;
                font-family: Georgia;
                font-size: 20px;
            }
            
            .no
            {
                font-family: Georgia;
                font-size: 24px;
                font-weight: bold;
            }
        </style>
        <script>
            function printLimits()
            {
                $("#limit").append("<br><br>\"Search\" Queries left in current time window  <div class='no'>"+search+"</div>");
                $("#limit").append("<br><br>\"Get Locations for trends\" Queries left in current time window  <div class='no'>"+avail+"</div>");
                $("#limit").append("<br><br>\"Get Trends for a particular place\" Queries left in current time window  <div class='no'>"+place+"</div>");
                
            }
        </script>
    </head>
    <body>
        <script language="javascript" type="text/javascript" src="head.txt"></script>
        
        <div id="limit"></div>
        <?php
        require 'app_tokens.php';
        require 'tmhOAuth.php';
        
        $rate = new tmhOAuth(array(
                      'consumer_key'=>$consumer_key,
                      'consumer_secret'=>$consumer_secret,
                      'user_token'=>$user_token,
                      'user_secret'=>$user_secret
                      ));
        
        $limit = $rate->request('GET', $rate->url('/1.1/application/rate_limit_status.json?resources=search,trends'));
        $lim = $rate->response['response'];
        $status = $rate->response['code'];
        if ($status <> 200)
        {
            echo'<script>window.location.reload()</script?';
        }
        
        $l = json_decode($lim,true);
        $search = $l['resources']['search']['/search/tweets']['remaining'];
        $avail= $l['resources']['trends']['/trends/available']['remaining'];
        $place = $l['resources']['trends']['/trends/place']['remaining'];   
        echo'<script>
                search='.$search.';
                avail='.$avail.';
                place='.$place.';
                printLimits();
             </script>';   
        
        ?>
    </body>
</html>
