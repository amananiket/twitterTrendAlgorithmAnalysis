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
                
                var url = "save_retweets.php"+next_results+"&table="+encodeURIComponent(table_name);
                //alert("Redirecting to "+url);
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
        set_time_limit(0);
        
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
            $table_name = "`".$place."_".$q."-".$timestamp."`"; 
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
        echo 'Requests left :'.$l['resources']['search']['/search/tweets']['remaining']."<br>";
        $limit = $l['resources']['search']['/search/tweets']['remaining'];
        
        if ((isset($limit)) && ($limit < 10))
        {
          exit("Rate limit exceeded. Refresh the page manually after some time.");
        }
        
        
        
        $res = $connection->request('GET',$connection->url('/1.1/search/tweets.json'),$data_array);
        $search = $connection->response['response'];
        $status = $connection->response['code'];
        
        if ($status <> 200)
        {
            echo "Error in connection :".$status.'<br>';
        }
        
        else echo "<br>status :".$status."<br>";
        
        
        $data = json_decode( $search , true);
        //print_r($data,false);
        
              
        $con= mysqli_connect("208.91.198.197", "amananiket","superman", "twitter_data");
         
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
             $sql="CREATE TABLE ".$table_name."(ID DOUBLE,PRIMARY KEY(ID),retweets INT(10),retweeted VARCHAR(10),favorites INT(10),mentions VARCHAR(50),in_reply_to VARCHAR(10),F INT(20),verified_user VARCHAR(10),date VARCHAR(30),time VARCHAR(30))";
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
                if (isset($count["retweeted_status"]))
                {
                    $retweeted = "yes";
                }
                else $retweeted = "no";
                
                 if (isset($count["in_reply_to_user_id_str"]))
                {
                    $in_reply_to = $count["in_reply_to_user_id_str"];
                }
                else $in_reply_to = "no";
                
                $followers = $count["user"]["followers_count"];
                $following = $count["user"]["friends_count"];
                if ($following)
                {
                    $F = ($followers * $followers)/$following;
                }
                else $F = "NOT APPLICABLE";
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
                  
                
                $men = 0;
                
                foreach ($count["entities"]["user_mentions"] as $mentions)
                {
                    $men = $men+1;
                }
                
                if (isset($men))
                {
                    
                }
                else $men = "NIL";
                $verified_user = $count["user"]["verified"];
                $ment = mysql_real_escape_string($men);
                $id= mysql_real_escape_string($count["id"]);
                $retweets=mysql_real_escape_string($count["retweet_count"]);
                $favorites=mysql_real_escape_string($count["favorite_count"]);
                                
                $date= mysql_real_escape_string($d);
                $time=mysql_real_escape_string($t);
                //$save[++$c]=array( $id,$retweeted,$retweets,$time);
                
                $query = 'INSERT INTO '.$table_name.'(`ID`, `retweets`,`retweeted`,`favorites`,`mentions`,`in_reply_to`,`F`,`verified_user`,`date`,`time`)
                  VALUES ("'.$id.'","'.$retweets.'","'.$retweeted.'","'.$favorites.'","'.$ment.'","'.$in_reply_to.'","'.$F.'","'.$verified_user.'","'.$date.'","'.$time.'")';
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
         echo "<br><br>Redirecting to save_retweets.php".$next_results;
         echo '<script>
                       var table_name = "'.$table_name.'";
                       var next_results = "'.$next_results.'";
                       var query = "'.$q.'";
                       redirect();
              </script>';
         }
         
         if (!(isset($data)))
         {
             echo 'Connection lost<script>window.location.reload();</script>';
         }
         
         
         if (!(isset($next_results)) && (isset($data)))
         {
             echo '<script>alert("DONE for query `'.$q.'`");
                           window.close();
                    </script>';
         }
         
          
      
            
       
?>
        
    </body>
</html>
