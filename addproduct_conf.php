<?php

session_start();
include("db.php");

$prodName = $_POST['prodName'];
$sPicName = $_POST['sPicName'];
$lPicName = $_POST['lPicName'];
$sDesc = $_POST['sDesc'];
$lDesc = $_POST['lDesc'];
$price = $_POST['price'];
$stock = $_POST['stock'];

$pagename = "Add product confirmation"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page


if (!empty($prodName) && !empty($sPicName) && !empty($lPicName) && !empty($sDesc) && !empty($lDesc) && !empty($price) && !empty($stock)) {
    $sql = "insert into Product (prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity) values ('$prodName', '$sPicName', '$lPicName', '$sDesc', '$lDesc', '$price', '$stock')";
    $exeSQL = mysqli_query($conn, $sql);
    if (mysqli_errno($conn) == 0) {
        echo "The product has been added <br><br>";
        echo "Name of the large picture: " . $lPicName . "<br><br>";
        echo "Name of the small picture: " . $sPicName . "<br><br>";
        echo "Short Desciption: " . $sDesc . "<br><br>";
        echo "Long Desciption: " . $lDesc . "<br><br>";
        echo "Price: " . $price . "<br><br>";
        echo "Stock: " . $stock;
    } else {
        if (mysqli_errno($conn) == 1062) {
            echo "<b><p>Adding product failed!</p></b>";
            echo "<p>Product already in use</p>";
        } elseif (mysqli_errno($conn) == 1064) {
            echo "<b><p>Adding product failed!</p></b>";
            echo "<p>Invalid characters entered in the form</p>";
        }
    }
} else {
    echo "<b><p>Adding product failed!</p></b>";
    echo "<p>Hey, you have forgot to enter something</p>";
}

include("footfile.html"); //include footer layout
echo "</body>";
