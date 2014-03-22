<!DOCTYPE html>
<head>
<script src="jquery-1.9.1.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Track Trends</title>
<style>
          #take
          {
              border-style: solid;
              margin-left: 500px;
              margin-right: 500px;
                  
          }
          #button
          {
              font-family: Georgia;
              margin-left: 600px;
              margin-right: 400px;
              
          }
		  #trend
		  {
			  text-align:center;
			  font-size:30px;
			  font-family: Georgia, "Times New Roman", Times, serif;
			  
		  }
 </style>
 <script>
             var prev = new Array();
             var tracked = new Array("notrend");
             c = 0;
             /*
             function track_trends(url)
             {
                 var req = "trend_for_location.php?woeid=" + url;
                 $.getJSON(req,function(trend)
                 {
                            alert("Calling Server");
                            var cache = trend[0];
                            $(cache.trends).each(function()
                            {
                                temp = 0;
                                a = 0;
                                for (s = 0;s < 10;s++)
                                    {
                                    if(prev[s] === recent)
                                       { 
                                           temp = 1;
                                       }
                                    }
                             if(temp === 0)
                             {
                                 tracked[a++] = recent;
                                 alert("Trend "+a+" tracked");
                             }
                                
                            }
                            );
                     if (tracked[0] === "notrend")
                     {
                        alert("No Trend tracked.Waiting for next call");
                     }
             
                 }
                 );
               }
             
            */ 
             function redirect(url)
             {
             
             req = "trend_for_location.php?woeid=" + url;
             $.getJSON(req,function(trend)
                        {
                            $("#take").html("");
                            cache = trend[0];
                            $(cache.trends).each(function(index)
                            {
                                prev[$c++] = this.name;
                                alert(this.name);
                                $("#take").append(this.name+'<br>');
                            }
                            );
                        }
                        );
             
             
             //setInterval(track_trends(url),30000);
                                 
             }
             
            var woeid; 
                      
            function get_trends()
            {
                $(".city").each(function()
                {
                if(this.checked)
                    {
                     got = this.name;
                     $(avail).each(function()
                        {
                            if (this.name === got)
                                {
                                   redirect(this.woeid);
                                   if (gowaay) return false;
                                }
                        }
                        );
                     }
                        
                  }
                );
                
                               
                if ($("#country_get").is(':checked'))
                    {
                     got2 = $("#country_get").prop("name");
                     $(avail).each(function()
                        {
                            if (this.country === got2)
                                { 
                                 redirect(this.parentid);
                                 if (gowaay) return false;
                                                                 
                                }
                        }
                        );
                     }
                else redirect(1);
            }
        </script>
        <script>
            
            var keep = "Current Trends set to : ";
            function output(avail)
            {
                    document.getElementById("take").innerHTML="<input type = 'checkbox' class = 'keep' checked = 'yes' name = 'Worldwide'/><span class='count'>"+keep+"Worldwide</span><br>";
                    var temp = avail[0].country;
                    $(avail).each(function(i)
                    {
                        if(this.country !== temp)
                            {
                              temp = this.country;
                               $("#take").append("<input type = 'checkbox' class = 'count' name = '"+this.country+"'/>  <span class = 'count'>"+this.country+"</span><br>") ;
                            }
                    }           
                    );
                    
            }
           
        </script>
        
    </head>
    <body>
    	<div id ='trend'>Track Trends</div>
        <div id ="take"></div>
        <div id="button"><button type="button" onclick="get_trends();">Get Trends!</button></div>
        <?php
        require 'app_tokens.php';
        require 'tmhOAuth.php';
   
        $connection = new tmhOAuth(array(
                    'consumer_key'=>$consumer_key,
                    'consumer_secret'=>$consumer_secret,
                    'user_token'=>$user_token,
                    'user_secret'=>$user_secret
                
                ));
        $req = $connection->request('GET',$connection->url('/1.1/trends/available.json'),array()
                                    );
        $avail = $connection->response['response'];
        echo '<script>
                var avail ='.$avail.';
                output(avail);
              </script>
                ';
         ?>
       
    <script>
             $(".count").change(function() 
                {
                if(this.checked)
                    {     
                        var tempo = this.name;
                          $(".count").hide();
                          $(".keep").hide();
                          document.getElementById("take").innerHTML="<input type = 'checkbox' id='country_get' checked = 'yes' name = '"+this.name+"'/><span class='count'>"+keep+this.name+"</span><br>";
                          $(avail).each(function(i)
                            {
                                
                                if(this.country === tempo)
                                {
                                    $("#take").append("<input type = 'checkbox' class = 'city' name = '"+this.name+"'/>  "+this.name+"<br>") ;
                                }
                            }                  
                            );
                           
                    }
                });
        </script>         
    </body>
</html>
