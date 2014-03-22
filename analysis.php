<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="head.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
         <script src="jquery-1.9.1.js"></script>
         <script src="js/highcharts.js"></script>
        <script src="js/modules/exporting.js"></script>
        <style>
            .param:hover
            {
                cursor: pointer;
                color: cadetblue;
                font-weight: bold;
            }
            #graph:hover
             {
                cursor: pointer;
                color: cadetblue;
            }
            
            
            #graph
            {
                 text-align: center;
                font-family: Georgia;
                font-size: 18px;
            }
            #option
            {
                text-align: center;
                font-family: Georgia;
            }
            .a
            {
                text-align: center;
            }
            .param
             {
                 text-align: center;
                 font-family: Georgia;
                 font-size: 20px;
             }
             #main
             {
                 text-align: center;
                 font-family: Georgia;
                 font-size: 22px;
                 
             }
             .data
             {
                 text-align: center;
             }
        </style>
        <script>
            var unit,num;
            var trend = new Array();
            var xAxis = new Array();
            var tweet = new Array();
            var data = new Array();
            
            function analyze()
            {
                g = 0;
                $(trend).each(function()
                {
                   
                
                    $("#data").append("<p class='a'>Available range for "+this+" : "+getRange(g++)+" minutes</p>");
                    
                }
               
                
                );
                $("#data").append("<br><br>");
                $("#option").show();
                
            }
            
            function showParam()
            {
                $("#option").slideUp("slow");
                $("#next").show();
                 $(".data").hide("slow");
                unit = document.getElementById("unit").value;
                num = document.getElementById("num").value;
                
                
                
                
                for (i = 0 ; i <= num ; i++)
                    {
                        xAxis[i] = (-(unit*num) + (i*unit));
                    }
            }
            
            function analyzeRateParam(param)
            {
                a=0;
                               
                $(table).each(function()
                {
                    n = size[a]-1;
                    e = this[n].date + " " + this[n].time + " 2013";
                    var end = new Date(e).getTime();
                    end = end/60000;
                    start = end-(unit*num);
                    data[a] = new Array();
                    for (k = 0 ; k <= num ; k++)
                        {
                            //int data[a][k];
                            data[a][k] = 0;
                            
                            tweet[k] = 0;
                        }
                      
                    $(this).each(function()
                    {
                        n = this.date + " " + this.time + " 2013";
                        var now = new Date(n).getTime();
                        now = now/60000;
                        //alert(now-start);                        
                        if (now >= start)
                            {
                                c = now-start;
                                //alert(c);
                                index = (c - (c%unit))/unit;
                                //alert(index);
                                tweet[index]++;
                                data[a][index] += parseInt(this[param]);
                                                                     
                            }
                            
                    }
                                   
                    );
                    
                 for(q = 0 ; q <= num ; q++)
                     {
                         
                         if (parseInt(tweet[q]) !== 0 )
                         {
                            
                              data[a][q] = data[a][q]/tweet[q];
                              
                             
                         }
                        
                        
                     }
                 a++;       
                }
              );
                var series = new Array();
                
                for (p = 0 ; p < total ; p++)
                    {
                        temp = trend[p];
                        series[p] = new Object();
                        series[p].name = temp;
                        series[p].data = new Array();
                        series[p].data = data[p];
                    }
                  
                return series;
                
            }
           
            function getRange(t)
            {
                   start = table[t][0].date + " " + table[t][0].time + " 2013";
                   end = table[t][size[t]-1].date + " " + table[t][size[t]-1].time + " 2013";
                   var comp1 = new Date(start).getTime();
                   var comp2 = new Date(end).getTime();
                   range = (comp2 - comp1)/(60000);
                   return range;                   
            }
              
            
            function favorited()
            {
               
                var unit = document.getElementById("unit").value;
                var num = document.getElementById("num").value;
                
                
                a = 0;
                var data = new Array();
                var xAxis = new Array();
                var tweet = new Array();
                for (i = 0 ; i <= num ; i++)
                    {
                        xAxis[i] = (-(unit*num) + (i*unit));
                    }
                $(table).each(function()
                {
                    n = size[a]-1;
                    e = this[n].date + " " + this[n].time + " 2013";
                    var end = new Date(e).getTime();
                    end = end/60000;
                    start = end-(unit*num);
                    data[a] = new Array();
                    for (k = 0 ; k <= num ; k++)
                        {
                            //int data[a][k];
                            data[a][k] = 0;
                            
                            tweet[k] = 0;
                        }
                    $(this).each(function()
                    {
                        n = this.date + " " + this.time + " 2013";
                        var now = new Date(n).getTime();
                        now = now/60000;
                        //alert(now-start);                        
                        if (now >= start)
                            {
                                c = now-start;
                                //alert(c);
                                index = (c - (c%unit))/unit;
                                //alert(index);
                                tweet[index]++;
                                data[a][index] += parseInt(this.favorites);
                                                                     
                            }
                            
                    }
                                   
                    );
                    
                 for(q = 0 ; q <= num ; q++)
                     {
                         
                         if (parseInt(tweet[q]) !== 0 )
                         {
                            
                              data[a][q] = data[a][q]/tweet[q];
                              
                             
                         }
                        
                        
                     }
                 a++;       
                }
                 );
                var series = new Array();
                
                for (p = 0 ; p < total ; p++)
                    {
                        temp = trend[p];
                        series[p] = new Object();
                        series[p].name = temp;
                        series[p].data = new Array();
                        series[p].data = data[p];
                    }
                  
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'favorited_data',
                          type: 'line',
                          marginRight: 130                            
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        x: -20
                       },
                subtitle: {
                            text: "Favorited rate",
                            x: -20
                          },
                xAxis: {
                categories: xAxis
                       },
            yAxis: {
            title: {
                text: 'Favorited/Number of Tweets'
                    }
                    },
                legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
                },
                series: series
                });
             
            }
            
            function tweetRate()
            {
                var unit = document.getElementById("unit").value;
                var num = document.getElementById("num").value;
                
                 
                a = 0;
                var data = new Array();
                var xAxis = new Array();
                var tweet = new Array();
                for (i = 0 ; i <= num ; i++)
                    {
                        xAxis[i] = (-(unit*num) + (i*unit));
                    }
                $(table).each(function()
                {
                    n = size[a]-1;
                    e = this[n].date + " " + this[n].time + " 2013";
                    var end = new Date(e).getTime();
                    end = end/60000;
                    start = end-(unit*num);
                    data[a] = new Array();
                    for (k = 0 ; k <= num ; k++)
                        {
                            data[a][k] = 0;
                           
                        }
                    $(this).each(function()
                    {
                        n = this.date + " " + this.time + " 2013";
                        var now = new Date(n).getTime();
                        now = now/60000;
                        //alert(now-start);                        
                        if (now >= start)
                            {
                                c = now-start;
                                //alert(c);
                                index = (c - (c%unit))/unit;
                                //alert(index);
                                
                                data[a][index]++;
                                                                     
                            }
                            
                    }
                                   
                    );
                    
                a++;       
                }
                 );
                var series = new Array();
                
                for (p = 0 ; p < total ; p++)
                    {
                        temp = trend[p];
                        series[p] = new Object();
                        series[p].name = temp;
                        series[p].data = new Array();
                        series[p].data = data[p];
                    }
                  
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'tweetRate_data',
                          type: 'line',
                          marginRight: 130                            
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        x: -20
                       },
                subtitle: {
                            text: "Rate of Tweets per unit time",
                            x: -20
                          },
                xAxis: {
                categories: xAxis
                       },
            yAxis: {
            title: {
                text: 'Tweets'
                    }
                    },
           legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
                },
                series: series
                });
             
            
                
            }
            
            function mentions()
            {
                
                var unit = document.getElementById("unit").value;
                var num = document.getElementById("num").value;
                
                
                a = 0;
                var data = new Array();
                var xAxis = new Array();
                var tweet = new Array();
                for (i = 0 ; i <= num ; i++)
                    {
                        xAxis[i] = (-(unit*num) + (i*unit));
                    }
                $(table).each(function()
                {
                    n = size[a]-1;
                    e = this[n].date + " " + this[n].time + " 2013";
                    var end = new Date(e).getTime();
                    end = end/60000;
                    start = end-(unit*num);
                    data[a] = new Array();
                    for (k = 0 ; k <= num ; k++)
                        {
                            //int data[a][k];
                            data[a][k] = 0;
                            
                            tweet[k] = 0;
                        }
                    $(this).each(function()
                    {
                        n = this.date + " " + this.time + " 2013";
                        var now = new Date(n).getTime();
                        now = now/60000;
                        //alert(now-start);                        
                        if (now >= start)
                            {
                                c = now-start;
                                //alert(c);
                                index = (c - (c%unit))/unit;
                                //alert(index);
                                tweet[index]++;
                                data[a][index] += parseInt(this.mentions);
                                                                     
                            }
                            
                    }
                                   
                    );
                    
                 for(q = 0 ; q <= num ; q++)
                     {
                         
                         if (parseInt(tweet[q]) !== 0 )
                         {
                            
                              data[a][q] = data[a][q]/tweet[q];
                              
                             
                         }
                        
                        
                     }
                 a++;       
                }
                 );
                var series = new Array();
                
                for (p = 0 ; p < total ; p++)
                    {
                        temp = trend[p];
                        series[p] = new Object();
                        series[p].name = temp;
                        series[p].data = new Array();
                        series[p].data = data[p];
                    }
                  
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'mentions_data',
                          type: 'line',
                          marginRight: 130                            
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        x: -20
                       },
                subtitle: {
                            text: "Level of Engagement : Mentions",
                            x: -20
                          },
                xAxis: {
                categories: xAxis
                       },
            yAxis: {
            title: {
                text: 'Mentions/Number of Tweets'
                    }
                    },
                legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
                },
                series: series
                });
             
            }
            
            function verified()
            {
                 var unit = document.getElementById("unit").value;
                var num = document.getElementById("num").value;
                
                
                a = 0;
                var data = new Array();
                var xAxis = new Array();
                var tweet = new Array();
                for (i = 0 ; i <= num ; i++)
                    {
                        xAxis[i] = (-(unit*num) + (i*unit));
                    }
                $(table).each(function()
                {
                    n = size[a]-1;
                    e = this[n].date + " " + this[n].time + " 2013";
                    var end = new Date(e).getTime();
                    end = end/60000;
                    start = end-(unit*num);
                    data[a] = new Array();
                    for (k = 0 ; k <= num ; k++)
                        {
                            //int data[a][k];
                            data[a][k] = 0;
                            
                            tweet[k] = 0;
                        }
                    $(this).each(function()
                    {
                        n = this.date + " " + this.time + " 2013";
                        var now = new Date(n).getTime();
                        now = now/60000;
                        //alert(now-start);                        
                        if (now >= start)
                            {
                                c = now-start;
                                //alert(c);
                                index = (c - (c%unit))/unit;
                                //alert(index);
                                tweet[index]++;
                                if(this.verified === "1")
                                    {
                                        temp = 1;
                                    }
                                    else temp = 0;
                                data[a][index] += parseInt(temp);
                                                                     
                            }
                            
                    }
                                   
                    );
                    
                 a++;       
                }
                 );
                var series = new Array();
                
                for (p = 0 ; p < total ; p++)
                    {
                        temp = trend[p];
                        series[p] = new Object();
                        series[p].name = temp;
                        series[p].data = new Array();
                        series[p].data = data[p];
                    }
                  
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'verified_data',
                          type: 'line',
                          marginRight: 130                            
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        x: -20
                       },
                subtitle: {
                            text: "Level Of Engagement of Verified users",
                            x: -20
                          },
                xAxis: {
                categories: xAxis
                       },
            yAxis: {
            title: {
                text: "Verified Users' tweets"
                    }
                    },
                legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
                },
                series: series
                });
            }
            
            function replies()
            {
                
                var unit = document.getElementById("unit").value;
                var num = document.getElementById("num").value;
                
                
                a = 0;
                var data = new Array();
                var xAxis = new Array();
                var tweet = new Array();
                for (i = 0 ; i <= num ; i++)
                    {
                        xAxis[i] = (-(unit*num) + (i*unit));
                    }
                $(table).each(function()
                {
                    n = size[a]-1;
                    e = this[n].date + " " + this[n].time + " 2013";
                    var end = new Date(e).getTime();
                    end = end/60000;
                    start = end-(unit*num);
                    data[a] = new Array();
                    for (k = 0 ; k <= num ; k++)
                        {
                            //int data[a][k];
                            data[a][k] = 0;
                            
                            tweet[k] = 0;
                        }
                    $(this).each(function()
                    {
                        n = this.date + " " + this.time + " 2013";
                        var now = new Date(n).getTime();
                        now = now/60000;
                        //alert(now-start);                        
                        if (now >= start)
                            {
                                c = now-start;
                                //alert(c);
                                index = (c - (c%unit))/unit;
                                //alert(index);
                                tweet[index]++;
                                if(this.in_reply_to === "no")
                                    {
                                        temp = 0;
                                    }
                                    else temp = 1;
                                data[a][index] += parseInt(temp);
                                                                     
                            }
                            
                    }
                                   
                    );
                    
                 a++;       
                }
                 );
                var series = new Array();
                
                for (p = 0 ; p < total ; p++)
                    {
                        temp = trend[p];
                        series[p] = new Object();
                        series[p].name = temp;
                        series[p].data = new Array();
                        series[p].data = data[p];
                    }
                  
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'replies_data',
                          type: 'line',
                          marginRight: 130                            
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        x: -20
                       },
                subtitle: {
                            text: "Level Of Engagement : Replies",
                            x: -20
                          },
                xAxis: {
                categories: xAxis
                       },
            yAxis: {
            title: {
                text: 'Replies'
                    }
                    },
                legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
                },
                series: series
                });
             
            }
                
            function FParam()
            {
                var series = new Array()
                series = analyzeRateParam("F");
                  
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'F_data',
                          type: 'line',
                          marginRight: 130                            
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        x: -20
                       },
                subtitle: {
                            text: '"F" ( (Followers)^2/Following )',
                            x: -20
                          },
                xAxis: {
                categories: xAxis
                       },
            yAxis: {
            title: {
                text: '"F" /Number of Tweets'
                    }
                    },
                legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
                },
                series: series
                });
             
            }
            function retweet()
            {
                var series = new Array();
                series = analyzeRateParam("retweets");
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'retweet_data',
                          type: 'line',
                          marginRight: 130                            
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        x: -20
                       },
                subtitle: {
                            text: "Retweet rate",
                            x: -20
                          },
                xAxis: {
                categories: xAxis
                       },
            yAxis: {
            title: {
                text: 'Retweets/Number of Tweets'
                    }
                    },
                legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
                },
                series: series
                });
             
            }
    
        </script>
        
        <script>
         var size = new Array();
         var table = new Array();
         
        
         $(document).ready(function()
            {
                $("#graph").click(function()
                {
                    $("#option").slideToggle("slow");
                }
                );      
             
                $("#retweet").click(function()
                {
                    $("#retweet_data").slideToggle("fast",retweet());
                    
                }
                );
                    
                $("#favorited").click(function()
                {
                    $("#favorited_data").slideToggle("fast",favorited());
                    
                }
                );
                    
                $("#tweetRate").click(function()
                {
                    $("#tweetRate_data").slideToggle("fast",tweetRate());
                    
                }
                );
                    
                 $("#mentions").click(function()
                {
                    $("#mentions_data").slideToggle("fast",mentions());
                    
                }
                );
                $("#replies").click(function()
                {
                    $("#replies_data").slideToggle("fast",replies());
                    
                }
                );
                $("#F").click(function()
                {
                    $("#F_data").slideToggle("fast",FParam());
                    
                }
                );
                $("#verified").click(function()
                {
                    $("#verified_data").slideToggle("fast",verified());
                    
                }
                );
                  
            }
            );    
        </script>
    
        <script>
            function print()
            {
                alert(table[0]["retweets"]);
            }
        </script>
    </head>
  
    <body>
        
  
        <script language="javascript" type="text/javascript" src="head.txt"></script>
        <div id="main"><br>PARAMETER-WISE ANALYSIS REPORTS<br><hr><br><br></div>
        <div id ="graph">Set/Change Graph parameters</div>
        <div id ="option" style="display:none"><div id="data"></div><p class ="a">Unit (in minutes):  <input type ="text" id="unit"/></p><p class ="a">Number of entries :  <input type ="text" id="num"/></p><button type="button" onclick="showParam();">Go!</button></div>
        <center>
        <div id ="next" style="display:none"> <br><br><br>
        
        <span id="retweet" class="param">RETWEETS</span><br>
        <div id="retweet_data" class="data" style="display:none; width:100%; height:400px;"></div>
        <span id="favorited" class="param">FAVORITED</span><br>
        <div id="favorited_data" class="data" style="display:none; width:100%; height:400px;"></div>
        <span id="mentions" class="param">MENTIONS</span><br>
        <div id="mentions_data" class="data" style="display:none; width:100%; height:400px;"></div>
        <span id="tweetRate" class="param">RATE OF TWEET INCREASE</span><br>
        <div id="tweetRate_data" class="data" style="display:none; width:100%; height:400px;"></div>
        <span id="replies" class="param">REPLIES</span><br>
        <div id="replies_data" class="data" style="display:none; width:100%; height:400px;"></div>
        <span id="F" class="param">"F" ( (Followers)^2/Following )</span><br>
        <div id="F_data" class="data" style="display:none; width:100%; height:100%;"></div>
        <span id="verified" class="param">VERIFIED USERS' ENGAGEMENT</span><br>
        <div id="verified_data" class="data" style="display:none; width:100%; height:400px;"></div>
        </div>
        </center>
        
        
        <?php
             $con = mysqli_connect("localhost", "root", "", "twitter_data");
             if (mysqli_connect_errno($con))
             {
                 echo "Failed to connect to MySQL: " . mysqli_connect_error().'<br>';
             }
             $a = 0;
             while(1)
             {
                 if(isset($_GET['table'.$a]))
                 {
                     $table_name = $_GET['table'.$a];
                     $query = "SELECT * FROM `".urldecode($table_name)."`";
                     $res = mysqli_query($con, $query);
                     //echo mysqli_error($con);
                     echo '<script>
                                                                      
                                    table['.$a.']= new Array();
                                                                        
                          </script>';
                     $b = 0;
                     while(1)
                       {
                        
                        $result = mysqli_fetch_array($res, MYSQLI_ASSOC);
                        if(isset($result))
                        {    
                        echo '<script>
                              table['.$a.']['.$b.']= new Object();
                              table['.$a.']['.$b.'].retweets="'.$result["retweets"].'";
                              table['.$a.']['.$b.'].favorites="'.$result["favorites"].'";
                              table['.$a.']['.$b.'].mentions="'.$result["mentions"].'";
                              table['.$a.']['.$b.'].inReplyTo="'.$result["in_reply_to"].'";
                              table['.$a.']['.$b.'].F="'.$result["F"].'";
                              table['.$a.']['.$b.'].verified="'.$result["verified_user"].'";
                              table['.$a.']['.$b.'].date="'.$result["date"].'";
                              table['.$a.']['.$b++.'].time="'.$result["time"].'";
                              
                            </script>';
                        }
                        else
                        {
                          
                          echo '<script>
                                           
                                           trend['.$a.'] = "'.urldecode($table_name).'";
                                           
                                           size['.$a++.']='.$b.'; 
                                         
                                </script>';
                          break;
                        }
                      }
                      
                    }
                 
                 else 
                 {
                   
                     echo '<script>total='.$a.';
                           analyze();
                           </script>';
                     break;
                 }
             }
             
        ?>
    </body>
</html>
