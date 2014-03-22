<!DOCTYPE html>
<html>
    <head>
        <style>
            #detail
            {
                margin-left:100px;
                height:0px;
                padding-bottom: 0px;
            }
            #A
            {
                font-size: 20px;
            }
            #form
            {
                text-align : center;
                margin-bottom:20px;
            }
            #main
            {
                font-size: 50px;
                text-align: center;
            }
            #tweet
            {
                border-radius: 0.35em;
                background-color:#b0c4de;
                text-align: center;
                font-size: 20px;
                font-family: Georgia;
                padding:10px;
                border:1px solid gray;
                margin-top:35px;
                margin-bottom:35px;
                margin-right:100px;
                margin-left:100px;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Twitter Search</title>
        <script src="jquery-1.9.1.js"></script>
        
        <script >
            $(document).keypress(function(e)
            {
                if(e.which ===13)
                    {
                        send_request();
                    }
            });
            function search()
            {
                
                var query = document.getElementById("A").value;
                return query;
            }
          </script>

        
        <script>
            function send_request()
            {
                document.getElementById("res").innerHTML="";
                var url="http://search.twitter.com/search.json?q=";
                var query = encodeURIComponent(search());
                url+=query;  
                $(document).ready(function()
                    {
                    $.getJSON(url+"&rpp=100&include_entities=true&result_type=mixed&callback=?",function(data)
                        {
                            window.location.replace("test1.php?data="+encodeURIComponent(data));
                            /*
                            $(data.results).each(function(index)
                            {
                             $('#res').append('<p id="detail">@'+ this.from_user+' at '+this.created_at + '</p><p id="tweet">'+ this.text+'</p>');
                            }
                            );*/
                        });
                            
                    });               
              }
        </script>
        
    </head>
    
    <body>
        
         <p id="main">Twitter Search</p>
         <div id="form">
            <input type="text" id="A" /><br>
            <button type="button" onclick="send_request();">Go!</button><br>
         </div>
         <div id="res" ></div>
         
       <?php
        // put your code here
        ?>
    </body>
</html>
