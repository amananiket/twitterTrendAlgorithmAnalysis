<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <script src="jquery-1.9.1.js"></script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script>
            var next_results;
            function redirect()
            {
                
                var url = "save_favorited.php"+next_results+"&table="+encodeURIComponent(table_name);
                alert(url);
               /*
                if(url === "save.php" && query !== "" )
                    {
                      // $("#a").append("Data Saved Successfully.");
                       return;
                    }
                else if (url === "save.php" && query === "")
                        {
                            $("#a").append("Connection lost");
                            return;
                        }
                else
                    {
                        $("#a").append("Current page saved. Redirecting to "+ url);
                    }*/
                window.location.replace(url);   
            }
        </script>
    </head>
    <body>
        <div id="a"></div>
        
       <?php
        
        
        require 'app_tokens.php';
        require 'tmhOAuth.php';
               
        $q = $_GET['q'];
        
          
        $connection = new tmhOAuth(array(
                      'consumer_key'=>$consumer_key,
                      'consumer_secret'=>$consumer_secret,
                      'user_token'=>$user_token,
                      'user_secret'=>$user_secret
                      ));
        
        $rate = new tmhOAuth(array(
                      'consumer_key'=>$consumer_key,
                      'consumer_secret'=>$consumer_secret,
                      'user_token'=>$user_token,
                      'user_secret'=>$user_secret
                      ));
        
       
        if (isset($_GET['counter']))
        {
            $place = $_GET['place'];
            $timestamp = $_GET['timestamp'];
            $table_name = "`favorited_".$place."_".$q."-".$timestamp."`"; 
            $data_array = array('q'=> $q,'count'=> 100,'include_entities'=>true,'result_type'=>'mixed','callback'=>'?');
        }
        else
        {
            $table_name = $_GET['table'];
            $data_array = array('q'=> $q,'count'=> 100,'include_entities'=>true,'result_type'=>'mixed','max_id'=>$_GET['max_id'],'callback'=>'?');
        }
        
        
        $limit = $rate->request('GET', $rate->url('/1.1/application/rate_limit_status.json'));
        $lim = $rate->response['response'];
        $l = json_decode($lim,true);
        echo $l['resources']['search']['/search/tweets']['remaining']."<br>";
        
        
        
        $res = $connection->request('GET',$connection->url('/1.1/search/tweets.json'),$data_array);
        $search = $connection->response['response'];
        $status = $connection->response['code'];
        
        if ($status <> 200)
        {
            echo "Error in connection :".$status.'<br>';
        }
        
        else echo "<br>status :".$status."<br>";
        
        
        $data = json_decode( $search , true);
        print_r($data,false);
        
              
        $con= mysqli_connect("127.0.0.1", "root", "", "favorited");
         // Check connection
         if (mysqli_connect_errno($con))
         {
              echo "Failed to connect to MySQL: " . mysqli_connect_error().'<br>';
         }
         
         /*$save = array(
                1 => array ('Tweet ID', 'Retweet Count','Retweeted','Timestamp'),
                );
          */
         
        
         
                
         if(isset($_GET['counter']))
         {
             //$table_name = "retweets_data_".$timestamp;
             $sql="CREATE TABLE ".$table_name."(ID DOUBLE,PRIMARY KEY(ID),favorites INT(10),date VARCHAR(30),time VARCHAR(30))";
             if (mysqli_query($con,$sql))
             {
                 echo "Table ".$table_name." created successfully"."<br>";
             }
            else
            {
                echo "Error creating table: " . mysqli_error($con);
            }
         }
         
         $array = $data['statuses'];
        
         if(isset($array))
         {
         foreach ($array as $count)
            {
                
            $d = "";
            $t = "";
            $a = $count["created_at"];
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
             
                echo $count["favourites_count"];
                $id= mysql_real_escape_string($count["id"]);
                $favorites=mysql_real_escape_string($count["favorite_count"]);
                $date= mysql_real_escape_string($d);
                $time=mysql_real_escape_string($t);
                //$save[++$c]=array( $id,$retweeted,$retweets,$time);
                
                $query = 'INSERT INTO '.$table_name.'(`ID`, `favorites`,`date`,`time`)
                  VALUES ("'.$id.'","'.$favorites.'","'.$date.'","'.$time.'")';
                if (mysqli_query($con,$query))
                {
                }
                else
                {
                    echo "Error saving records: " . mysqli_error($con).'<br>';
                }
            }
            
         }
         
         $next_results = $data['search_metadata']['next_results'];
         
         
         
         if ((isset($next_results)) && (isset($data)))
         {
         echo "<br><br>Redirecting to save_favorited.php".$next_results;
         echo '<script>
                       var table_name = "'.$table_name.'";
                       var next_results = "'.$next_results.'";
                       var query = "'.$q.'";
                       alert(next_results);
                       redirect();
              </script>';
         }
         
         if (!(isset($data)))
         {
             echo 'Connection lost';
         }
         
         
         if (!(isset($next_results)) && (isset($data)))
         {
             echo "DONE";
         }
         
          
      
            
       
?>
        
    </body>
</html>
