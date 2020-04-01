<?php
session_start();
include("db.php");
$pagename = "Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
include("detectlogin.php");

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

if (isset($_POST['hiddenId'])) {
	$delprodid = $_POST['hiddenId'];
	unset($_SESSION['basket'][$delprodid]);
	echo "1 item removed<br>";
}

if (isset($_POST['h_prodid'])) {
	$newprodid = $_POST['h_prodid'];
	$reququantity = $_POST['p_quantity'];


	$_SESSION['basket'][$newprodid] = $reququantity;
	echo "<p>1 item added to the basket";
} else {
	echo "Current basket unchanged ";
}

echo "<table>";
echo "<th>Product Name</th>";
echo "<th>Price</th>";
echo "<th>Quantity</th>";
echo "<th>Subtotal</th>";
if (isset($_SESSION['basket'])) {
	$total = 0;
	echo "<form action=basket.php method=post>";
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
		echo "<td><input type='submit' value= 'Remove'></td>";
		echo "<input type=hidden name=hiddenId value=" . $index . ">";
		echo "</tr>";
		$total += $subtotal;
	}
	echo "<tr>";
	echo "<td colspan = '3' style = 'text-align:right'><b>Total</b></td>";
	echo "<td><b>$" . $total . "</b></td>";
	echo "</tr>";
	echo "</form>";
} else {
	echo "<br>Empty Basket";
	echo "<tr><td colspan = '3' style = 'text-align:right'><b>Total</b></td>";
	echo "<td><b>$0.00</b></td></tr>";
}
echo "</table>";

echo "<a href='clearbasket.php'>CLEAR BASKET</a>";
if (isset($_SESSION['userId'])) {
	echo "<br><br><a href='checkout.php'>Checkout</a>";
} else {
	echo "<br><br>New homteq customers : <a href='signup.php'>Sign Up</a>";
	echo "<br>Returning homteq customers : <a href='login.php'>Log in</a>";
}
include("footfile.html"); //include head layout
echo "</body>";
