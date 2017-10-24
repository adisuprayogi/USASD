<?php

// Supress errors
error_reporting(0);

/* If your server is not in your time zone, adjust it here.  Mine is 1 hour East of me.
To use this variable, you will need to remove the "//".*/ 
date_default_timezone_set("Asia/Jakarta");
$myServerOffset = (+5.5) * 3600;

// Get server date
$mydate = date("U");
// Get Timezone offset
$myoffs = date("Z") - $myServerOffset;

// Adjust offsets for local machine
print "var tzoffset = $myoffs + (new Date().getTimezoneOffset()*60);";

// Set JavaScript variable to your server time as seen from client machine's location.
print "var servertimeOBJ=new Date(($mydate+tzoffset)*1000);";
?>
