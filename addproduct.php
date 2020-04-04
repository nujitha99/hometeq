<?php
$pagename = "Add a new product"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

//display random text
echo "<form action=addproduct_conf.php method=POST>";
echo "<table>";
echo "<tr><td> *Product Name</td><td> <input type=text name=prodName></td></tr>";
echo "<tr><td> *Samll Picture Name</td><td> <input type=text name=sPicName></td></tr>";
echo "<tr><td> *Large Picture Name</td><td> <input type=text name=lPicName></td></tr>";
echo "<tr><td> *Short Descrption</td><td> <input type=text name=sDesc></td></tr>";
echo "<tr><td> *Long Descrption</td><td> <input type=text name=lDesc></td></tr>";
echo "<tr><td> *Price</td><td> <input type=text name=price size=5></td></tr>";
echo "<tr><td> *Initial Stock Quantity</td><td> <input type=text name=stock size=5></td></tr>";
echo "<br>";
echo "</table>";
echo "<input type='submit' value='Add product'>";
echo "<input type='reset' value='Clear from'>";
echo "</form>";

include("footfile.html"); //include footer layout
echo "</body>";
?>
