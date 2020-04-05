<?php

session_start();

$pagename = "Login"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

echo "<table>";
echo "<form method=post action=login_process.php>";
echo "<tr>";
echo "<tr><td>Email</td><td><input type=text name=email></td></tr>";
echo "<tr><td>Password</td><td><input type=password name=psw></td></tr>";
echo "<tr><td><input type=submit value=login></td><td><input type=reset value='Clear Form'></td></tr>";
echo "</form>";
echo "</table>";

include("footfile.html"); //include footer layout
echo "</body>";
?>
