<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head><link rel="stylesheet" type="text/css" href="head.css">
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
            
            
            #option
            {
                text-align: center;
                 }
            .a
            {
                text-align: center;
            }
            .param:hover
            {
                cursor: pointer;
            }
            .param
             {
                 text-align: center;
                 font-size: 12px;
                 color: black;
             }
             #retweet
             {
                 color: black;
             }
            
             #plot
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
                 margin-top: 10px;
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
            var size = new Array();
            var table = new Array();
            var trend = new Array();
            
             
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
                
                $(".para").show("slow");
                $("#par").show("slow");
             }
             
            function barPlot()
            {
                
               
                var tweet = 0;
                var xaxis = new Array();
                var data = new Array();
                j = 0;
                
                
                $(":checkbox").each(function()
                {
                    if ($(this).is(":checked"))
                        {
                            xaxis[j++] = $(this).prop("id");
                            
                        }
                    this.setAttribute("checked","");
                    this.removeAttribute("checked");
                    this.checked = false;
                }
                );
                
                $('.para').hide();
                $("#par").hide();
                $("#plot").show();
                var interval = document.getElementById("interval").value;
                if (j == 0)
                    {
                        alert("Choose a paramter to view the graph");
                        $(".para").slideToggle("slow");
                        $("#par").slideToggle("slow");
                        return;                        
                    }
                    
                
                a = 0;
               $(table).each(function()
                {
                    n = size[a]-1;
                    e = this[n].date + " " + this[n].time + " 2013";
                    var end = new Date(e).getTime();
                    end = end/60000;
                    start = end-(interval);
                    
                    data[a] = new Array();
                    for (k = 0 ; k < j ; k++)
                        {
                            data[a][k] = 0;
                        }
                    $(this).each(function()
                    {
                        n = this.date + " " + this.time + " 2013";
                        var now = new Date(n).getTime();
                        now = now/60000;
                        if (now >= start)
                            {
                            for(f = 0; f < j ; f++)
                               {
                                   if (xaxis[f] === "replies")
                                       {
                                           
                                            if(this.inReplyTo === "no")
                                            {
                                                
                                                
                                                 temp = 0;
                                            }
                                            else temp = 1;  
                                                                                      
                                            data[a][f] += parseInt(temp);
                                                                                        
                                       }
                                
                                    else if (xaxis[f] === "verified")
                                        {
                                            if(this.verified === "1")
                                            {
                                               temp2 = 1;
                                            }
                                            else temp2 = 0;
                                            
                                            data[a][f] += parseInt(temp2);
                                            
                                            
                                        }
                                     else if (xaxis[f] === "tweetRate")
                                         {
                                             data[a][f] = parseInt(data[a][f])+1;
                                             tweet = parseInt(f);
                                           
                                         }
                                     else 
                                          {
                                              
                                              data[a][f] += parseInt(this[xaxis[f]]);
                                              
                                          }
                                
                                
                               }
                                                                    
                            }
                            
                    }
                                   
                    );
                    
                    for(q = 0 ; q < j ; q++)
                     {
                         if (xaxis[q] !== "tweetRate" && xaxis[q] !== "verified" && xaxis[q] !== "replies")
                             {
                                
                                if (parseInt(data[a][tweet]) !== 0 )
                                {
                                    data[a][q] = data[a][q]/data[a][tweet];
                                    
                                }
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
                          renderTo: 'plot',
                          type: 'column'
                                                   
                       },
                title: {
                        text: 'Parametric Analysis of Twitter trends',
                        
                       },
                subtitle: {
                            text: "Comparision among various trends for time interval :"+interval+" minutes",
                          
                          },
                xAxis: {
                categories: xaxis
                       },
            yAxis: {
                min: 0,
            title: {
                text: ''
                   }
                    },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                        }
                         }
               , 
                series: series
                });
                
            }
            
            function line()
            {
              alert(url);
               
               var line = url.split("/");
               line = line[5].substring(12);
               window.location.href = "line_plot.php"+line;
    
    
           }
            
            
           
        </script>
        
        <script>
            
            var url;
             $(document).ready(function()
             {
                $(".param").click(function()
                {
                    id = $(this).prop("id");
                    $(":checkbox").each(function()
                    {
                        if ($(this).prop("id") === id)
                            {
                                this.setAttribute("checked","checked");
                                this.checked = true;
                                
                            }
                    }
                    );
                }
                );
                
                
                $("#toggle").click(function()
                {
                    $(".para").slideToggle("slow");
                    $("#par").slideToggle("slow");
                    document.getElementById("interval").value = "";
                }
                );
                
                $("#parShow").click(function()
                {
                    $(".para").slideToggle("slow");
                    $("#par").slideToggle("slow");
                    document.getElementById("interval").value = "";
                }
                
                );
            }
            );
            </script>
    </head>
    <body>
        <script language="javascript" type="text/javascript" src="head.txt"></script>
        <div id ='body'>
        
        <div id ="parameters" class="block">
                <span class="top" id="availData">Available Datasets</span><hr class ='op'>
                <div id="data"></div>
                <span class="top" id ="toggle">Parameters</span><hr class ='op'>
                <div class ="para" style='display:none'><input id="retweets" type="checkbox"/>
                <span id="retweets" class="param">Retweets</span><hr class="op"/><input id="favorites" type="checkbox"/>
                <span id="favorites" class="param">Favorited</span><hr class="op"/><input id="mentions" type="checkbox"/>                
                <span id="mentions" class="param">Mentions</span><hr class="op"/><input id="tweetRate" type="checkbox"/>
                <span id="tweetRate" class="param">Number of Tweets</span><hr class="op"/><input id="replies" type="checkbox"/>
                <span id="replies" class="param">Replies</span><hr class='op'/><input id="F" type="checkbox"/>
                <span id="F" class="param">"F" ( (Followers)^2/Following )</span><hr class='op'/><input id="verified" type="checkbox"/>
                <span id="verified" class="param">Verified Users' engagement</span><hr class='op'/></div>
                <span class="top" id="parShow">Set graph parameters</span><hr class ='op'>
                <div id="par" style='display:none'><input class ="inp" type ="text" id="interval"  value="Set the time interval (in minutes)" onblur="if (this.value == '') {this.value = 'Set the time interval (in minutes)';}"
                 onfocus="if (this.value == 'Set the time interval (in minutes)') {this.value = '';}"/><br><br><button type="button" onclick="barPlot();">Go!</button><hr class="op"/></div>
                  <span class="top" id="line" onclick="line();">View Line Plot</span><hr class ='op'>
                <span class="top" id="previous" onclick="window.location.href='tables.php';">Choose different dataset</span><hr class ='op'>
            </div>
        
        <div id ="graphs" class="block">
                <center><div id="show" class ="top" style="display:none">BACK<br><br></div>
                    <div id="plot" style="display:none;"></div></center>
            </div>
        </div>
            
         
        <?php
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
    
        ?>
    </body>
</html>
