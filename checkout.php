<?php
session_start();
include ("db.php");

$pagename = "Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$userId = $_SESSION['userId'];
date_default_timezone_set('Asia/Colombo');
$currentdatetime = date("Y-m-d H:i:s");

$query = "insert into Orders (userId, orderDateTime) values ('$userId', '$currentdatetime');";
$exeSQL = mysqli_query($conn, $query) or die ($conn);

if (mysqli_errno($conn) == 0) {
    $maxQuery = "select MAX(orderNo) as orderNo from Orders where userId=$userId";
    $exeMaxQuery = mysqli_query($conn, $maxQuery) or die (mysqli_error($conn));
    $arrayp = mysqli_fetch_array($exeMaxQuery);
    $orderNo = $arrayp['orderNo'];
    echo "Your order has been placed successfully!";
    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Quantity</th>";
    echo "<th>Price</th>";
    echo "<th>Sub Total</th>";
    echo "</tr>";
    $total = 0;
    foreach ($_SESSION['basket'] as $index => $value) {
		//create a $SQL variable and populate it with a SQL statement that retrieves product details 
		$SQL = "select prodId, prodName, prodPrice from Product where prodId = " . $index;
		//run SQL query for connected DB or exit and display error message 
		$exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
		$arrayp = mysqli_fetch_array($exeSQL);
		echo "<tr>";
		echo "<td>" . $arrayp['prodName'] . "</td>";
		echo "<td>$" . $arrayp['prodPrice'] . "</td>";
		echo "<td>" . $value . "</td>";
		$subtotal = $arrayp['prodPrice'] * $value;
		echo "<td>$" . $subtotal . "</td>";
		echo "</tr>";
        $total += $subtotal;
        $prodId = $arrayp['prodId'];
        $orderLineQuery = "insert into Order_Line (orderNo, prodId, quantityOrdered, subTotal) values ('$orderNo', '$prodId', '$value', '$subtotal')";
        $exeOrderLineQuery = mysqli_query($conn, $orderLineQuery) or die(mysqli_error($conn));

	}
	echo "<tr>";
	echo "<td colspan = '3' style = 'text-align:right'><b>Total</b></td>";
	echo "<td><b>$" . $total . "</b></td>";
    echo "</tr>";
    echo "</table>";

    $updateQuery = "update Orders set orderTotal=$total where orderNo=$orderNo";
    $exeUpdateQuery = mysqli_query($conn, $updateQuery) or die (mysqli_error($conn));

    echo "<br>To log out and leave system: <a href=logout.php>Log Out</a>";

} else {
    echo "An error ocurred while placing your your order..!";
}

include("footfile.html"); //include footer layout
echo "</body>";
