<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="header.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script>
        function alerta()
        {
            alert();
        }
            
            
        function get()
        {
            ka = "alerta"+"()";
            alert(ka);
            ka;
            /*argentina_uls-30/4/113-12:37:37
            var place = new Array();
            var trend = new Array();
            var timestamp = new Array();
            str = "";
            for (i = 0; i < str.length ; i++)
                {
                    if (!(trend) )
                        {
                            
                        }
                }
                str = "argentina_uls-30/4/113-12:37:37";
                var str =str.split("-");
                var div = str[0].split("_");
                place = div[0];
                trend = div[1];
                date = str[1];
                time = str[2];
                alert(place);
                alert(trend);
                alert(date);
                alert(time);*/
                
        }
        
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
            else 
        if ($(this).prop("id") === 'mentions_check')
            {
                $("#mentions_data").show();
                mentions();                
            }
        else 
        if ($(this).prop("id") === 'tweetRate_check')
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
        
            /*
            
        function getHour(time)
            {
               var get = [time[0],time[1]];
                str = get.join("");
                return str;
            }
            function getDate(date)
            {
                t = date.length;
                var get = [date[t-2],date[t-1]];
                da = get.join("");
                return da;
            }
            function getMonth(date)
            {
                t = date.length;
                for(i = 0; i < t ; i++)
                    {
                        if (date[i] === " ")
                            {
                                break;
                            }
                    }
                
                var get = new Array;
                a = 0;
                while(1)
                    {
                        if (date[++i] !== " ")
                        {
                            get[a++] = date[i];
                        }
                        else break;
                    }
                
                month = get.join("");
                return month;
            }
           function get()
           {
               a = (34 - (34%2.5))/2.5;
               alert(a);
              var twitterDate = new Date("Fri May 31 10:50 2013").getTime(),
               now = new Date("Sat May 31 10:55 2014").getTime();

            if (twitterDate > now) {
            alert('Future' + (twitterDate-now) );
            alert(now);
            } else {
            alert('Past' + (twitterDate-now));
            alert(now);
            var da = new Date();
            alert(da.getMonth());
            }
            
            
                 
                  // alert(getMonth("Fri May 26"));
                   //alert(getDate("Fri May 26"));
               
           
           
           /*
            * 
            function timeDiff(date1,time1,date2,time2)
            {
                if (date1 === date2)
                    {   
                       days = 0;
                    }
                else days = getDays(date1,date2);
                
            }
            
            function getHour(time)
            {
                var get = [time[0],time[1]];
                hour = get.join("");
                return hour;
            }
            
            function getMin(time)
            {
                var get = [time[3],time[4]];
                min = get.join("");
                return min;
            }
            function getDate(date)
            {
                t = date.length;
                var get = [date[t-2],date[t-1]];
                da = get.join("");
                return da;
            }
            function getMonth(date)
            {
                t = date.length;
                for(i = 0; i < t ; i++)
                    {
                        if (date[i] === " ")
                            {
                                break;
                            }
                    }
          
            */
           
        </script>
        
        
        <title></title>
    </head>
    <body>
        <p id="a">asdas</p>
        <input id ="b" type="text" value="email@abc.com" onblur="if (this.value == '') {this.value = 'email@abc.com';}"
 onfocus="if (this.value == 'email@abc.com') {this.value = '';}"/>
        <button onclick="get();">click</button>
       
        
        <script>
        
      
                
        </script>
    </body>
</html>
