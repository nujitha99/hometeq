<?php
$pagename = "Sign Up"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

//display random text
echo "<form action=signup_process.php method=POST>";
echo "<table>";
echo "<tr><td> *First Name</td><td> <input type=text name=fName></td></tr>";
echo "<tr><td> *Last Name</td><td> <input type=text name=lName></td></tr>";
echo "<tr><td> *Address</td><td> <input type=text name=address></td></tr>";
echo "<tr><td> *post code</td><td> <input type=text name=pCode></td></tr>";
echo "<tr><td> *Tel No</td><td> <input type=text name=telNo></td></tr>";
echo "<tr><td> *Email</td><td> <input type=text name=email></td></tr>";
echo "<tr><td> *Password</td><td> <input type=text name=psw></td></tr>";
echo "<tr><td> *Confirm password</td><td> <input type=text name=conPsw></td></tr>";
echo "<br>";
echo "</table>";
echo "<input type='submit' value='Sign Up'>";
echo "<input type='reset' value='Clear from'>";
echo "</form>";

include("footfile.html"); //include footer layout
echo "</body>";
?>
