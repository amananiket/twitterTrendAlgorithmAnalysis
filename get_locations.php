<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="head.css">
       <style>
           .city
           {               
               font-size: 15px;
               font-family: Georgia;
           }
           .country
           {
               font-size: 15px;
               font-family: Georgia;
               
           }
          #take
          {
                margin-left: 250px;
                margin-right:250px;
          }
          #button
          {
              font-family: Georgia;
              margin-left: 600px;
              margin-right: 400px;
              
          }
         
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="jquery-1.9.1.js"></script>
        <title></title>
        <script>
             
             function redirect(url,name)
             {
                
                window.location.href= "get_trends.php?woeid="+url+"&place="+name;
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
                                   redirect(this.woeid,this.name);
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
                                 redirect(this.parentid,this.country);
                                 if (gowaay) return false;
                                                                 
                                }
                        }
                        );
                     }
                else window.location.replace("get_trends.php?woeid=1&place=Worldwide")
            }
        </script>
        <script>
            
            var keep = "Current Trends set to : ";
            function output(avail)
            {
                    document.getElementById("top").innerHTML="<input type = 'checkbox' class = 'keep' checked = 'yes' name = 'Worldwide'/><span class='country'>"+keep+"Worldwide</span><br><br>";
                    var temp = avail[0].country;
                    c = 0;
                    $("#take").append("<table border='0' >");
                    $(avail).each(function(i)
                    {
                        if(this.country !== temp)
                        {
                              temp = this.country;
                             if(c === 0)
                             {
                                 $("#take").append("<tr><td></td>");
                                 $("#take").append("<td class='country'><input type = 'checkbox' class = 'count' name = '"+this.country+"'/>  "+this.country+"</td>") ;
                                 
                                 c++;
                             }
                             else if (c === 4)
                             {
                                 $("#take").append("<td class='country'><input type = 'checkbox' class = 'count' name = '"+this.country+"'/>  "+this.country+"</td></tr>") ;
                                 c=0;
                                 
                             }
                             else
                             {
                              
                                 $("#take").append("<td class='country'><input type = 'checkbox' class = 'count' name = '"+this.country+"'/>  "+this.country+"</td>") ;
                                 c++;
                                
                             }
                        }
                                   
                            
                    }           
                    );
                    
                    $("#take").append("</table>");
                    
            }
           
        </script>
        
    </head>
    <body>
        <script language="javascript" type="text/javascript" src="head.txt"></script>
        
        <center><div id="top"></div></center><div id ="take"></div><br><br>
        
        <div id="button"><button type="button" onclick="get_trends();">Get Trends!</button></div>
        <?php
        require 'app_tokens.php';
        require 'tmhOAuth.php';
        /*require 'rate_limits.php';
        
        if ($avail === 1)
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
        $req = $connection->request('GET',$connection->url('/1.1/trends/available.json'),array()
                                    );
        $avail = $connection->response['response'];
        $status = $connection->response['code'];
        if ($status <> 200)
        {
            echo '<script>$("#button").hide();
                  alert("Error : '.$status. ' Refreshing to begin.");
                  window.location.reload(); 
                  </script>';
        }
        else
        {
        echo '<script>
                var avail ='.$avail.';
                output(avail);
              </script>
                ';
         
        }
        ?>
        <script>
        /*$(".city").change(function()
                 {
                    if(this.checked)]
                    {
                        var city_get = this.name;
                        alert(city_get);
                    }
                 }
                 );*/
         
        </script>
               
    <script>
             $(".count").change(function() 
                {
                if(this.checked)
                    {     
                        var tempo = this.name;
                          $(".country").hide();
                          $(".count").hide();
                          $(".keep").hide();
                          document.getElementById("top").innerHTML="<input type = 'checkbox' id='country_get' checked = 'yes' name = '"+this.name+"'/><span class='count'>"+keep+this.name+"</span><br>";
                          c = 0;
                          $("#take").append("<table border='0' >");
                          $(avail).each(function(i)
                            {
                                
                                if(this.country === tempo)
                                {
                                    if(c === 0)
                                    {
                                        $("#take").append("<tr><td></td>");
                                        $("#take").append("<td class='city'><input type = 'checkbox' class = 'city' name = '"+this.name+"'/>  "+this.name+"</td>") ;
                                        c++;
                                    }
                                    else if (c === 4)
                                    {
                                        $("#take").append("<td class='city'><input type = 'checkbox' class = 'city' name = '"+this.name+"'/>  "+this.name+"</td></tr>") ;
                                        c=0;
                                    }
                                    else
                                    {
                                        $("#take").append("<td class='city'><input type = 'checkbox' class = 'city' name = '"+this.name+"'/>  "+this.name+"</td>") ;
                                        c++;
                                    }
                                }
                            }                  
                            );
                           
                    }
                });
                 
         
        </script>
 
        
    
        
    
    </body>
</html>
