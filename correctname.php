<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $con= mysqli_connect("127.0.0.1", "root","", "twitter_data");
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
                              trendsDec['.$a++.']="'.$row[0].'";
                      </script>';
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
    </body>
</html>
