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
         
         <script>
            
             
             function check()
             {
                 if($(":checkbox#check").is(':checked'))
                     {
                         selectAll();
                     }
                 else if (!$(":checkbox#check").is(':checked'))
                     {
                        removeAll();
                     }
                     ;
             }
               
             
              function urlencode (str) {
                 str = (str + '').toString();

                 return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
                 replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
              }

             var trends = new Array();
             var trendsDec = new Array();
             
             function printTrends()
             {
                 
                 $("#hea").append(" :"+trends.length+" ENTRIES");
                 $(trendsDec).each(function(i)
                 {
                    
                    var str =this.split("-");
                    k = str.length;
                    if (k != 3)
                        {
                            for (x=1; x<(k-2);x++)
                            {
                                str[0]+="-"+str[x];
                            }
                            str[1]=str[k-2];
                            str[2]=str[k-1];                            
                        }
                    
                    var div = str[0].split("_");
                    l = div.length;
                    if (l != 2)
                        {
                            for (b=2; b<(l);b++)
                            {
                                div[1]+="_"+div[b];
                            }
                            
                        }
                    pl = div[0];
                    tr = div[1];
                    da = str[1];
                    ti = str[2];
                 
                    row = document.createElement('tr');
                    row.id = trends[i];
                    row.className = 'white';
                                                                             
                    
                    place = document.createElement('td');
                    trend = document.createElement('td');
                    date = document.createElement('td');
                    time = document.createElement('td');
                    input = document.createElement('input');
                    input.type='checkbox';
                    input.name =trends[i];
                    
                    
                    place.appendChild(input);
                    place.appendChild(document.createTextNode(pl));
                    
                    trend.appendChild(document.createTextNode(tr));
                    date.appendChild(document.createTextNode(da));
                    time.appendChild(document.createTextNode(ti));
                    
                    row.appendChild(place);
                    row.appendChild(trend);
                    row.appendChild(date);
                    row.appendChild(time);
                    
                    document.getElementById("trends").appendChild(row);
                    rule = document.createElement('hr');
                    rule.id = trends[i];
                    document.getElementById("trends").appendChild(rule);
                                  
                    //$("#trends").append("<div id ='"+trends[i]+"' class='table'><hr><input type='checkbox' class='check' name='"+trends[i]+"'/>"+this+"</div>");
                     
                 }  
                 );
                 
             
             }
         </script>
         <script>
    
          
          var url="?";
          
          
          function selectAll()
          {
              q = encodeURIComponent($("#A").val());
              $(":checkbox").each(function()
                {
                    
                    if (this.name.match(q))
                        {
                           this.setAttribute("checked", "checked");
                           this.checked = true;
                          name = this.name;
                          $("tr").each(function()
                          {
                            if (this.id === name)
                                {
                                    this.className = 'khaki';
                                }
                          }
                          );
                        }
                }
                    
                );
          }
           function removeAll()
          {
              $(":checkbox").each(function()
                {
                    this.setAttribute("checked", ""); 
                    this.removeAttribute("checked"); 
                    this.checked = false;
                    
                     $("tr").each(function()
                          {
                                    this.className = 'white';
                          }
                          );
                }
                    
                );
          }
          function choose()
          {
              $("#body").hide();
              $("#opt").show();
           }
          
          function redirect(page)
          {
              
              
              document.getElementById("A").value = "";
              a = 0;
              $(":checkbox").each(function()
              {
                  if($(this).prop("id") === 'check')
                      {
                          return;
                      }
                   else if($(this).is(':checked'))
                      {
                          if (a === 0)
                          {
                              url += "table"+(a++)+"="+encodeURIComponent(this.name);
                             
                          }
                          else
                          {
                              url+="&table"+(a++)+"="+encodeURIComponent(this.name);
                              
                          }
                          
                      }
                  
              }
              );
              k = page + url;
             window.location.href = k;
          }
         </script>
         
         <style>
             
             .white
             {
                 background-color: white;
             }
             .khaki
             {
                 background-color: khaki;
             }
             #trends
             {
                 width: 1200px;
                 margin-left: 50px;
                 font-family: Georgia;
                 margin-right: 50px;
                 overflow: scroll;
                 overflow-x:hidden;
                 overflow-style: marquee-line;
                 height: 350px
                 
             }
             #no
             {
                 font-family: Georgia;
                 font-size: 20px;
             }
             td
             {
                width:300px;
             }
             tr:hover
             {
                 background-color: khaki;
                 cursor: pointer;
             }
             
             tr
             {
                 height:30px;
             }
             #A
             {
                border-radius: 0.35em;
                width: 400px;
                height: 30px;
                font-size: 15px;
            
            
             }
             #enter
             {
                 margin-left: 40px;
             }
             .button
             {
                 font-size:12px;
                 font-family: Georgia;
             }
             #but
             {
                 text-align: center;
                                                
             }
             .table
             {
                 font-family: Georgia;
                 margin-left: 40px;
             }
             #hea
             {
                 font-family: Georgia;
                 text-align: center;
                 font-size: 22px;
             }
             #sub
             {
                 font-family: Georgia;
                 text-align: center;
                 font-size: 15px;
             }
             #h
             {
                 font-family: Georgia;
                 margin-left: 50px;
                 margin-right: 50px;                
                                  
             }
             #lo
             {
                 margin-left: 0px;
                 margin-right: 190px;
             }
             #tr
             {
                 margin-right: 245px;
             }
             #da
             {
                 margin-right: 257px;
             }
             #he
             {
                 margin-left: 50px;
                 margin-right: 50px;
             }
             
             #opt
             {
                 margin-top: 15%;
                 text-align: center;
                 font-family: Georgia;
                 font-size: 18px;
                 
             }
             .opti:hover
             {
                 cursor: pointer;
                 color: cadetblue;
             }
             
             
         </style>
        <script>
        $(document).ready(function()
        {
            document.getElementById("check").setAttribute("checked","");
            document.getElementById("check").removeAttribute("checked");
            document.getElementById("check").checked = false;
            
            $("#lin").click(function()
            {
                redirect("line_plot.php");
            }
            );
            
            $("#ba").click(function()
            {
                redirect("bar_plot.php");
            }
            );
        }
        );    
                
        </script>
    </head>
    <body>
        <script language="javascript" type="text/javascript" src="head.txt"></script>
        <div id='opt' style='display:none'>
                <input id ='line' name ='line' type='checkbox'/><span class ='opti' id='lin'>Parameter-wise Line plot</span><br><br>
                <input id ='bar' name ='bar' type='checkbox'/><span class ='opti' id='ba'>Bar diagram for a specific interval</span><br>
        </div>
        <div id ='body'>
        <div id="first">
            <div id ="hea">TRENDS DATABASE</div>
            <div id ="sub">Search string convention : Place_Trend-Date-Time<br>eg: argentina_clemente-30/5/2013-12:37:37</div>
            <div id="enter"><br><input type="text" id="A"/><br><br>
                                           
            </div>
            <div id="h"><input type="checkbox" id ="check" name='check' onclick="check();"/><span id ="lo">&nbsp;LOCATION</span><span id="tr">TREND</span><span id="da">DATE</span><span id="ti">TIME</span></div><hr id="he"/></div>
        <div id ='box' style='display:none'></div>
            <div id="trends"></div><div id="no" style="display:none"><center><br><br><br><br>No matching results<br><br></center></div>
            <div id="but"><button type="button" class="button" onclick="choose();">Analyze</button></div>
        </div>
        
        
        <?php
         $con= mysqli_connect("208.91.198.197", "amananiket","superman", "twitter_data");
         // Check connection
         if (mysqli_connect_errno($con))
         {
              echo "Failed to connect to MySQL: " . mysqli_connect_error().'<br>';
         }
         $query = "SHOW TABLES FROM twitter_data";
         $result = mysqli_query($con,$query);
         $a = 0;
         while(1)
         {
         $row = mysqli_fetch_array($result,MYSQLI_NUM);
             if (isset($row[0]))
             {
                 echo'<script>trends['.$a.']="'.urlencode($row[0]).'";
                              
                              trendsDec['.$a.']="'.$row[0].'";
                                  
                      </script>';
                 $a++;
             }
             else 
             {
               echo '<script>
                    printTrends();
                    </script>';
                    break;
             }
         }
         
         
         ?>
        <script>
            
                 $(":checkbox").change(function()
                 {
                     if (this.name === "line")
                         {
                            document.getElementById("line").setAttribute("checked", ""); 
                            document.getElementById("line").removeAttribute("checked"); 
                            document.getElementById("line").checked = false;
                          
                             redirect("line_plot.php");
                             return;
                         }
                     if (this.name === "bar")
                         {
                             document.getElementById("bar").setAttribute("checked", ""); 
                            document.getElementById("bar").removeAttribute("checked"); 
                            document.getElementById("bar").checked = false;
                             redirect("bar_plot.php");
                             return;
                         }
                     
                    id= this.name;
                    temp = 0;
                    mul = 0;
                    
                    $(":checkbox").each(function()
                    {
                        if ($(this).is(':checked'))
                            {
                                
                                if (this.id !== 'check')
                                {
                                    mul = 1;
                                }
                            }
                    }
                    
                    
                    );
                    
                    if (id === 'check' && mul == 0)
                        {
                            return;
                        }
                    
                        
                    if ($('#check').is(':checked') && mul == 0)
                        {
                            document.getElementById("check").setAttribute("checked", ""); 
                            document.getElementById("check").removeAttribute("checked"); 
                            document.getElementById("check").checked = false;
                        }
                    
                    if ($(this).is(':checked'))
                        {
                            temp=1;
                            document.getElementById("check").setAttribute("checked", "checked");
                            document.getElementById("check").checked = true;
                            
                        }
                        else $(this).removeAttr('checked');
                     
                    
                    $("tr").each(function()
                    {
                        if (id === this.id)
                            {
                               if (temp === 1)
                                   {
                                       
                                       this.className = 'khaki';
                                   }
                                                           
                            }
                     }
                     );
                        
                    }
                 );
                
                $("tr").click(function()
                {
                    t = 0;
                    r = 0;
                    name = this.id;
                    
                    color = $(this).prop("class");
                                        
                    
                    $(":checkbox").each(function()
                    {
                        if (name === this.name)
                            {
                               
                                 if ($(this).is(':checked') && color === 'khaki')
                                    {
                                        r = 1;
                                        return;
                                    }
                                
                               else if (!$(this).is(':checked') && color === 'white')
                                    {
                                        
                                        this.setAttribute("checked", "checked");
                                        this.checked = true;
                                        document.getElementById("check").setAttribute("checked", "checked");
                                        document.getElementById("check").checked = true;
                            
                                       
                                        t = 1;
                                        
                                    }
                                else if(!$(this).is(':checked') && color === 'khaki')
                                    {
                                        
                                    }
                                 
                            }
                    }
                    );
                        
                    if (r== 1)
                        {
                            return;
                        }
                    else if (t == 1)
                        {
                            
                            this.className = 'khaki';
                            
                        }
                   else if (t == 0)
                       {
                           this.className = 'white';
                       }   
                }
                );
            
           
                
                $("#A").keyup(function(i)
                {
                  $("#no").hide();
                  $("#but").show();
                  $("#trends").show();
                  
                  $("#h").show();
                  s = $(this).val();
                  show = 0;
                
                  
                    $("hr").each(function(i)
                    {
                        this.style.display = 'none';
                    } 
                    );
                    $("hr").each(function(i)
                    {
                        if(this.id.match(encodeURIComponent(s)))
                            {
                                show = 1;
                                this.style.display = '';
                            }
                                            
                    }
                    
                    
                    );
                    $("#he").show();
                    
                     $("tr").each(function(i)
                    {
                        this.style.display = 'none';
                    } 
                    );
                    $("tr").each(function(i)
                    {
                        if(this.id.match(encodeURIComponent(s)))
                            {
                                this.style.display = '';
                            }
                                            
                    }
                    
                    );
                   if (show == 0)
                   {
                      $("#but").hide();
                      $("#trends").hide();
                      $("#no").show();
                      $("#h").hide();
                      $("#he").hide();
                   }
                   
                });
                
                
            
        </script>
            
    </body>
</html>
