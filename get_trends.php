<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="head.css">
        
        <style>
            #get
            {
                margin-top: 100px;
                margin-left:  400px;
                margin-right:  400px;
            }
            .trend
            {
                font-family: Georgia;
                font-size: 20px;
                text-align: center;
            }
            #track
            {
                text-align: center;
                margin-left:  400px;
                margin-right:  400px;
            }
            #save
            {
                 text-align: center;
                margin-left:  400px;
                margin-right:  400px;
                
            }
            .head
            {
                font-family: Georgia;
                font-size: 25px;
                text-align: center;
                font-weight: bold;
            }
        </style>
            
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="jquery-1.9.1.js"></script>
        <script>
            var store = new Array();
            function save_trends()
            {
                var param = "";
                for(s=0; s < store.length ; s++)
                    {
                        param += ("trend"+s+"="+encodeURIComponent(store[s])+"&");
                    }
                    param+= "place="+encodeURIComponent(place)+"&length="+store.length;
                window.location.replace("parameters.php?"+param);
                
            }
       
            
            
            function track_trends()
            {
                var now = new Date();
                var outStr = now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
                $("#get").append("<p class ='trend'>Query started at "+outStr+"<br>Wait for 10 minutes for possible detection.</p>");
                $("#tr").hide();
                
                setTimeout(function()
                    {
                                $("#save").hide();
                                c = 0;
                                url = "trend_location.php?woeid="+woeid;
                                $.getJSON(url,function(trend)
                                {
                                    
                                    var array = trend[0];
                                    alert("Calling Server");
                                    $("#track").html("<div class = 'head'>Tracked Trends</div><br>");
                                    $(array.trends).each(function(i)
                                    {
                                        
                                        temp = 0;
                                        for(s=0;s<10;s++)
                                            {
                                                if(this.name === prev[s])
                                                    {
                                                        temp = 1;
                                                    }
                                            }
                                         if(temp===0)
                                             {
                                                 store[c] = this.name;
                                                 $('#track').append('<p class ="trend">'+ store[c++]+"</p>");
                                             }
                                             
                                                                                    
                                    }
                                    );
                                    $("#save").show();
                                });
                            $("#get").hide(); 
                            $("#save").append("<br><button type ='button' onclick='save_trends();'>Save Data</button>");                                    
                            },
        
                600000);
            }
        
        </script>
        
        
        <script>
        var prev = new Array();
       
        function print_output(data)
        {
                var obj = data[0];
                a = 0;
             $(document).ready(function()
             {
                var now = new Date();
                var outStr = now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
                $("#get").append('<div class = "head">'+place+' trends at '+outStr+'</div><br>');
                $(obj.trends).each(function(index)
                {
                    $("#get").append('<p class = "trend">'+this.name+'</p>');
                    prev[a++] = this.name;
                });
             
             });
             
         }
         /*   
         function post()
            
               $.ajax(
                    {
                        
                        url:'/oauth2/token',
                        type: 'POST',
                        beforeSend: function(req)
                        {
                            req.setRequestHeader("Host","api.twitter.com");
                            req.setRequestHeader("User-Agent","My Twitter App v1.0.23");
                            req.setRequestHeader("Authorization","Basic aEV4NURnSHAxazNTaUZaRG5XQ0xGdzpJTjk4YndSMXl0UjA4RG5hbnNPVWJBaWw3MHZhQTBUY0NVZXFIRFYwSlENCg==");
                            req.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
                            req.setRequestHeader("Content-Length", 29);
                            req.setRequestHeader("Accept-Encoding","gzip");
                        },
                        data: {grant_type:'client_credentials'},
                        success: function(tes,status,req)
                        {
                           alert("hey");
                        },
                        error: function(req)
                        {
                          alert(req.readyState);
                          alert(req.status);
                          
                        }
                    }
                            
            );
            }
           */ 
    </script>
               
        <title></title>
    </head>
    <body>
        <script type="text/javascript" src="head.txt"></script>
        <div id="get"></div>
        <div id ="track"><button type="button" id ="tr" onclick="track_trends();">Track trends</button></div>
        <div id="save"></div>
   <?php
   require 'app_tokens.php';
   require 'tmhOAuth.php';
   /*
   require 'rate_limits.php';
   if ($place === 1)
   {
        echo '<script>alert("Rate limits exceeded. Please try after some time.");</script>';
        exit();
   }*/
   
   $connection = new tmhOAuth(array(
                 'consumer_key'=>$consumer_key,
                 'consumer_secret'=>$consumer_secret,
                 'user_token'=>$user_token,
                 'user_secret'=>$user_secret  
                 ));
   $woeid = $_GET["woeid"];
   $place = $_GET['place'];
   $request = $connection->request('GET',$connection->url('/1.1/trends/place.json'),
                                    array('id'=>$woeid));
   $request_response = $connection->response['response'];
   
   echo '<script>
             var data = '.$request_response.';
             print_output(data);
             var woeid ='.$woeid.';
             var place ="'.$place.'"
        </script>';
   
   /*
   $data=  json_decode($request_response,true);
   $c = 0;
   
   
   foreach($data['trends'] as $value)
   {
       $store[$c++] = $value['name'];
   }
   
   print_r($store,false);*/
   ?>
    </body>
</html>
