<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename = "Make your home smart"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>" . $pagename . "</title>";
echo "<body>";
include("headfile.html");
include ("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";

if (isset($_POST['hiddenId'])){
	$pridtobeupdated =  $_POST['hiddenId'];
	$newprice = $_POST['newPrice'];
	$newqutoadd = $_POST['newQuantity'];
	
	$SQL = "select * from Product where prodId=$pridtobeupdated";
	$exeSQL = mysqli_query($conn,$SQL)  or die (mysqli_error($conn));
	$arrayqu = mysqli_fetch_array($exeSQL);
	
    if (!empty($_POST['newPrice']) and !empty($_POST['newQuantity'])) {
        $sqlUpdate = "update Product set prodPrice=$newprice, prodQuantity=$newstock where prodId='$pridtobeupdated'";
        $exesqlUpdatePrice = mysqli_query($conn, $sqlUpdate) or die (mysqli_error($conn));
    }
    if (!empty($_POST['newPrice']) and empty($_POST['newQuantity'])) {
        $sqlUpdatePrice = "update Product set prodPrice=$newprice where prodId='$pridtobeupdated'";
        $exesqlUpdatePrice = mysqli_query($conn, $sqlUpdatePrice) or die (mysqli_error($conn));
    }
    if (empty($_POST['newPrice']) and !empty($_POST['newQuantity'])) {
        $newstock = $arrayqu['prodQuantity'] + $newqutoadd;
        $sqlUpdateQunt = "update Product set prodQuantity=$newstock where prodId=$pridtobeupdated";
        $exeSQL = mysqli_query($conn,$sqlUpdateQunt) or die (mysqli_error($conn));
    }
}

$SQL = "select prodId, prodName, prodDescripShort, prodPicNameSmall, prodPrice, prodQuantity from Product";
$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));
echo "<table style='border: 0px'>";
while ($arrayp = mysqli_fetch_array($exeSQL)) {
    echo "<tr>";
    echo "<td style='border: 0px' rowspan=4>";
    echo "<form action=editproduct.php method=post>";
    echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
    echo "<img src=images/" . $arrayp['prodPicNameSmall'] . " height=200 width=200>";
    echo "</a>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    echo "<p><h5>" . $arrayp['prodName'] . "</h5>"; //display product name as contained in the array
    echo "<p>".$arrayp['prodDescripShort']."</p>";
    echo "<tr>";
    echo "<td style='border: 0px'>Current Price: <b>$".$arrayp['prodPrice']."</b></td>";
    echo "<td style='border: 0px'>New Price: <input type=text size=5 name=newPrice></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td style='border: 0px'>Current Stock: <b>".$arrayp['prodQuantity']."</b></td>";
    echo "<td style='border: 0px'>Add number of items: ";
    echo "<select name=newQuantity>";
    $counter = 0;
    while ($counter<=50){
        echo "<option value='$counter'>$counter</option>";
        $counter+=1;
    }
    echo "</select>";
    echo "</tr>";
    echo "<tr>";
    $prodId = $arrayp['prodId'];
    echo "<td style='border: 0px'><input type='submit' value='Update'></td>";
    echo "<input type=hidden name=hiddenId value=" . $prodId . ">";
    echo "</form>";
    echo "<tr>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

include("footfile.html");
echo "</body>";
?>
