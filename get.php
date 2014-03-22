<?php
if ($_POST["pass"] == "app708")
{
   echo 'Hello '.$_POST["user"].', You are logged in.';
}
else    echo 'Incorrect Password !';
?>
