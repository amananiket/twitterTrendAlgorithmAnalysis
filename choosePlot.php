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
        <script>
            var table = new Array();
            
            function chooseOption()
            {
                $(table).each(function()
                {
                    $("#data").append("<span>"+this+"</span><br>");
                }
                );
            }
        </script>
            
    </head>
    <body>
        <div id='main'><br><br>
            <div id = 'data'></div>
            <div id ='option'>
                <input type='checkbox'/><span>Parameter-wise Line plot</span><br><br>
                <input type='checkbox'/><span>Bar diagram for a specific interval</span><br>
                                              
            </div>    
        
        
        
        </div>
        <?php
        
         $a = 0;
         while(1)
         {
             if (isset($_GET['table'.$a]))
             {
                 echo '<script>table['.$a.'] = "'.$_GET['table'.$a].'";alert(table['.$a.']);</script>';
             }
             
             else 
             {
                 echo '<script>chooseOption();</script>';
                 break;
             }
         }
        ?>
    </body>
</html>
