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
            .inp
            {
                border-radius: 0.35em;
                width: 90%;
                height: 25px;
                font-size: 12px;
                font-family: Georgia;
            }
            #data
            {
                font-family: Georgia;
                font-size: 14px;
            }
            body
            {
                 font-family: Georgia;
            }
            .param:hover
            {
                cursor: pointer;
                
                font-variant: small-caps;
            } 
            
            #option
            {
                text-align: center;
                 }
            .a
            {
                text-align: center;
            }
            .param
             {
                 text-align: center;
                 font-size: 18px;
                 color: black;
             }
             #retweet
             {
                 color: black;
             }
            
             .data
             {
                 text-align: center;
                 width: 100%;
                 height: 500px;
                 overflow: scroll;
                 overflow-x: auto;
                 overflow-y: hidden;
                     
             }
             .block
             {
                 display: inline-block;
                 vertical-align: top;
                 
             }
             #body
             {
                 float:top;
                 margin-top: -10px;
             }
             
             #parameters
             {
                 padding-top: 0px;
                 padding-left: 0px;
                 width: 23%;
                 
                 height: 570px;
                 overflow: scroll;
                 overflow-x: hidden;
                 overflow-y:auto;
                                 
             }
             .top
             {
                 font-size: 20px;
                 font-family: Georgia;
                 font-variant: small-caps;
                 font-weight: bold;
                 
                 
             }
             #graphs
             {
                
                height: 570px;
                border: solid;
                width: 76%;
                border-color: #ccc;
                border-width: 1px;
                overflow: scroll;
                overflow-x: hidden;
                overflow-y: auto;
             }
             .op
             {
                 border-top: 1px solid whitesmoke;
                 
             }
             .top:hover
             {
                 cursor: pointer;
                 color: cadetblue;
             }
        </style>
        <script>
           
            var unit,num;
            var trend = new Array();
            var xAxis = new Array();
            var tweet = new Array();
            var data = new Array();
            
            function showParam()
            {
                
                $("#data").hide("slow");
                $("#par").hide("Fast");
                $(".para").show("slow");
                unit = document.getElementById("unit").value;
                num = document.getElementById("num").value;
                for (i = 0 ; i <= num ; i++)
                    {
                        xAxis[i] = (-(unit*num) + (i*unit));
                    }
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
              
            
            function analyze()
            {
                g = 0;
                $(trend).each(function()
                {
                    
                    
                    $("#data").append("<span>&bull;"+this+"<br>"+getRange(g++)+" minutes</span><hr class='op'>");
                }
                );
               $("#par").show("slow"); 
             }
          
            function analyzeMul()
            {
                $(".data").hide();
                $("#graphs").width("100%");
                $(":checkbox").each(function()
                {
                    if ($(this).is(':checked'))
                        {
                          
            if ($(this).prop("id") === 'retweet_check')
            {
                $("#retweet_data").show();
                retweet();                
            }
            
             else if ($(this).prop("id") === 'favorited_check')
            {
                $("#favorited_data").show();
                favorited();                
            }
            else if ($(this).prop("id") === 'mentions_check')
            {
                $("#mentions_data").show();
                mentions();                
            }
        else if ($(this).prop("id") === 'tweetRate_check')
            {
                $("#tweetRate_data").show();
                tweetRate();                
            }
            else 
        if ($(this).prop("id") === 'replies_check')
            {
                $("#replies_data").show();
                replies();                
            }
        else 
        if ($(this).prop("id") === 'FParam_check')
            {
                $("#FParam_data").show();
                FParam();                
            }
        else 
        if ($(this).prop("id") === 'verified_check')
            {
                $("#verified_data").show();
                verified();                
            }    
                        }             
                                
                }
                );
              
               $("#parameters").slideToggle("slow");
               $(".data").css('overflow-x','hidden');
                                  
                         
                         $("#show").show();
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
           
              
            function favorited()
            {
                var series = new Array();
                series = analyzeRateParam("favorites");
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
                a = 0;
                 var data = new Array();
                 var tweet = new Array();
             
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
                var series = new Array();
                series = analyzeRateParam("mentions");
               
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
                a = 0;
                var data = new Array();
                var tweet = new Array();
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
            { a = 0;
                var data = new Array();
                var tweet = new Array();
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
                                if(this.inReplyTo === "no")
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
                 var series = new Array();
                 series = analyzeRateParam("F");     
                 
                var chart1 = new Highcharts.Chart({
                chart: {
                          renderTo: 'FParam_data',
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
            
            function bar()
            {
               var bar = url.split("/");
               bar = bar[5].substring(13);
               window.location.href = "bar_plot.php"+bar;
            }
    
           
        </script>
        
        <script>
         var size = new Array();
         var table = new Array();
         var url;
        
         $(document).ready(function()
            {
                
                $("#toggle").click(function()
                {
                    $(".para").slideToggle("slow");
                }
                );
                $("#fullScreen").click(function()
                    {
                         $("#parameters").hide("fast");
                         $(".data").css('overflow-x','hidden');
                                      
                         $("#graphs").width("100%");
                         $("#show").show();
                    }            
                );
                    
                $("#show").click(function()
                {
                    $(":checkbox").each(function()
                    {
                        this.setAttribute("checked", ""); 
                        this.removeAttribute("checked"); 
                        this.checked = false; 
                    });
                              
                    
                    $("#parameters").show("fast");
                    $(".data").css('overflow-x','auto');
                    
                    
                    $("#graphs").width("76%");
                    $("#show").hide();
                }
                );
                
                    
                $("#availData").click(function()
                {
                    $("#data").slideToggle("slow");
                }
                );      
             
                
                 $("#parShow").click(function()
                {
                    $(".data").hide("fast");
                    $('#data').show("slow");
                    $("#par").slideToggle("slow");
                    $('.para').hide("fast");
                }
                );      
               
             
                $("#retweet").click(function()
                {
                                              
                            if ($("#retweet_data").css("display") === 'none')
                                {
                                    $(".data").hide();
                                    $("#retweet_data").slideToggle("fast",retweet());
                                    
                                }
                            else ($("#retweet_data").css('display',"none"));
                }
                );
                    
                $("#favorited").click(function()
                {
                    if ($("#favorited_data").css("display") === 'none')
                                {
                                    $(".data").hide();
                                    $("#favorited_data").slideToggle("fast",favorited());
                                    
                                }
                            else ($("#favorited_data").css('display',"none"));
                }
                );
                    
                $("#tweetRate").click(function()
                {
                  if ($("#tweetRate_data").css("display") === 'none')
                                {
                                    $(".data").hide();
                                    $("#tweetRate_data").slideToggle("fast",tweetRate());
                                    
                                }
                            else ($("#tweetRate_data").css('display',"none"));
                }
                );
                    
                 $("#mentions").click(function()
                {if ($("#mentions_data").css("display") === 'none')
                                {
                                    $(".data").hide();
                                    $("#mentions_data").slideToggle("fast",mentions());
                                   
                                }
                            else ($("#mentions_data").css('display',"none"));
                }
                );
                $("#replies").click(function()
                {
                    if ($("#replies_data").css("display") === 'none')
                                {
                                    $(".data").hide();
                                    $("#replies_data").slideToggle("fast",replies());
                                    
                                }
                            else ($("#replies_data").css('display',"none"));
                }
                );
                $("#FParam").click(function()
                {if ($("#FParam_data").css("display") === 'none')
                                {
                                    $(".data").hide();
                                    $("#FParam_data").slideToggle("fast",FParam());
                                    
                                }
                            else ($("#FParam_data").css('display',"none"));
                }
                );
                $("#verified").click(function()
                {if ($("#verified_data").css("display") === 'none')
                                {
                                    $(".data").hide();
                                    $("#verified_data").slideToggle("fast",verified());
                                    
                                }
                            else ($("#verified_data").css('display',"none"));
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
       <div id="body"><br>
           
            <div id ="parameters" class="block">
                <span class="top" id="availData">Available Datasets</span><hr class ='op'>
                <div id="data"></div>
                <span class="top" id="parShow">Set graph parameters</span><hr class ='op'>
                <div id="par" style='display:none'><input class ="inp" type ="text" id="unit"  value="Set unit (in minutes)" onblur="if (this.value == '') {this.value = 'Set unit (in minutes)';}"
                 onfocus="if (this.value == 'Set unit (in minutes)') {this.value = '';}"/><br><input class="inp" type ="text" id="num" value="Number of data entries" onblur="if (this.value == '') {this.value = 'Number of data entries';}"
                 onfocus="if (this.value == 'Number of data entries') {this.value = '';}"/><br><button type="button" onclick="showParam();">Go!</button><hr class="op"/></div>
                <span class="top" id ="toggle">Parameters</span><hr class ='op'>
                <div class ="para" style="display:none"><input id="retweet_check" type="checkbox"/>
                <span id="retweet" class="param">Retweets</span><hr class="op"/><input id="favorited_check" type="checkbox"/>
                <span id="favorited" class="param">Favorited</span><hr class="op"/><input id="mentions_check" type="checkbox"/>                
                <span id="mentions" class="param">Mentions</span><hr class="op"/><input id="tweetRate_check" type="checkbox"/>
                <span id="tweetRate" class="param">Rate of tweet increase</span><hr class="op"/><input id="replies_check" type="checkbox"/>
                <span id="replies" class="param">Replies</span><hr class='op'/><input id="FParam_check" type="checkbox"/>
                <span id="FParam" class="param">"F" ( (Followers)^2/Following )</span><hr class='op'/><input id="verified_check" type="checkbox"/>
                <span id="verified" class="param">Verified Users' engagement</span><hr class='op'/><button type="button" onclick="analyzeMul();">Analyze selected</button><hr class='op'/></div>
                <span class="top" id="fullScreen">Full Screen</span><hr class ='op'>
                <span class="top" id="line" onclick="bar();">View Bar Plot</span><hr class ='op'>
                <span class="top" id="previous" onclick="window.location.href='tables.php';">Choose different dataset</span><hr class ='op'>
            </div>
            <div id ="graphs" class="block">
                <center><div id="show" class ="top" style="display:none">BACK<br><br></div>
                    <div id="retweet_data" class="data" style="display:none;"></div>
                <div id="favorited_data" class="data" style="display:none;"></div>
                <div id="mentions_data" class="data" style="display:none;"></div>
                <div id="tweetRate_data" class="data" style="display:none;"></div>
                <div id="replies_data" class="data" style="display:none;"></div>
                <div id="FParam_data" class="data" style="display:none;"></div>
                <div id="verified_data" class="data" style="display:none;"></div>      </center>
            </div>
            
        </div>
    
        <?php
        
            set_time_limit(0);
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            echo '<script>url="'.$url.'"</script>'; 
        
             $con= mysqli_connect("208.91.198.197", "amananiket","superman", "twitter_data");
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
             //echo '<script>analyze();</script>';
        ?>
    </body>
</html>
