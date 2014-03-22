<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <script src="jquery-1.9.1.js"></script>
        <style>
            #a
            {
                border-style: solid;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script>
            var a = "aman";
            a = a[a.length-1];
            alert(a);
            
            
            function done()
            {
                alert("ho");
            }
           /* var a = new Array();
            date = "";
            time = "";
           a = "Thu May 16 05:06:26 +0000 2013";
           k = 0;
           for (i = 0; i <(a.length-14) ; i++)
               {
                   if (a[i] === ' ' )
                       {
                           k++;
                       }
                    if (k === 3)
                        {
                            time+=a[i];
                        }
                        else date+=a[i];
                        
               }
             alert(date);
             alert(time);
             
             */
            
        </script>
    </head>
    <body>
        <div id="a" onclick ="done();">click me</div>
        
        <?php
            $d = "";
            $t = "";
            $a = "Thu May 16 05:06:26 +0000 2013";
            $k = 0;
            $len = strlen($a);
            for ($i = 0; $i <($len-14) ; $i++)
               {
                   if ($a[$i] === ' ' )
                       {
                           $k++;
                       }
                    if ($k === 3)
                        {
                            $t .= $a[$i];
                            
                        }
                        else $d .= $a[$i];
               }
               echo $t.'<br>';
               echo $d;
        ?>
    </body>
</html>
