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
        
        <style>
            #head
            {
                font-family: Georgia;
                font-size: 30px;
                text-align: center;
                font-weight: bold;
            }
            #favorited
            {
                border-style: solid;
                border-width: thin;
                margin-left: 300px;
                margin-right: 300px;
                font-family: Georgia;
                font-size: 25px;
                text-align: center;
            }
            #retweet
            {
                border-style: solid;
                border-width: thin;
                margin-left: 300px;
                margin-right: 300px;
                font-family: Georgia;
                font-size: 25px;
                text-align: center;
            }
            .param
            {
             
                font-family: Georgia;
                font-size: 20px;
                text-align: center;
                top: 20px;
            }
            #trends
            {
                margin-top: 100px;
                margin-left:  500px;
                margin-right:  500px;
            }
            .trend
            {
                font-family: Georgia;
                font-size: 20px;
                text-align: center;
            }
            
            </style>
        <script src="jquery-1.9.1.js"></script>
        
        <script>
            
            function saveAll()
            {
                $(trend).each(function()
                {
                    redirect(this);
                }
                );
            }
                
            function redirect(query)
            {
                var now = new Date();
                var outStr = now.getDate()+'/'+(1+parseInt(now.getMonth()))+'/'+(1900+parseInt(now.getYear()))+'-'+now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
                query = "save_retweets.php?q="+encodeURIComponent(query)+"&max_id=0&counter=yo&timestamp="+outStr+"&place="+encodeURIComponent(place);
                var win=window.open(query, '_blank');
                
            }
        </script>
        <script>
                function printTrends()
                {
                    
                for(q = 0; q < length; q++)
                    {
                        par = "'"+trend[q]+"'";
                        $("#trends").append('<p class = "trend">'+trend[q]+'<br><button type="button" onclick = "redirect('+par+');">Save Data</button></p>');
                    }
                    
                 $("#trends").append("<br><br><center><button type='button' onclick='saveAll();'>Save All</button></center>")
                }
          
        </script>
    </head>
    <body>
        
         <script language="javascript" type="text/javascript" src="head.txt"></script>

        <div class ="param" style="display:none">
            <p id ="head">Parameters</p>
            <p id="retweet" onclick="retweet();">Number of Retweets</p>
            <p id="favorited" onclick="favorited();">Favorited</p>
            
       </div>
        
        <div id="trends"></div>
        <?php
        $length = $_GET['length'];
        $place = $_GET['place'];
        
        echo '<script>
                      var trend = new Array();
                      var length='.$length.';
                      var place ="'.$place.'";
             </script>';
        
        for ($a = 0; $a < $length; $a++)
        {
            $trend[$a]=$_GET['trend'.$a];
            echo '<script>
                        trend['.$a.']="'.$trend[$a].'";
                        
                 </script>';
        }
        echo'<script>printTrends();</script>';
            
        ?>
    </body>
</html>
