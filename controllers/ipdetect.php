<?php

function mac(){
ob_start(); // Turn on output buffering
system('ipconfig /all'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean the output buffer
 
$find_word = "Physical";
$pmac = strpos($mycom, $find_word); // Find the position of Physical text in array
$mac=substr($mycom,($pmac+36),17); // Get Physical Address
return $mac;
}


function ip(){
$localIP = getHostByName(getHostName());
 echo "</br>";
 
 return $localIP;
}

 
?>
