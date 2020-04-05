<?php
session_start();
include("db.php");
$pagename = "Procees Orders"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
include("detectlogin.php");

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

if (isset($_POST['updatedStatus'])){
	$ordSts = $_POST['updatedStatus'];
	$idToBeUpdated = $_POST['idOfUpdatedDetails'];
	$SQL = "update Orders set orderStatus='$ordSts' where orderNo=$idToBeUpdated ";
	$exeSQL = mysqli_query($conn,$SQL);
}

$SQL = "SELECT *
FROM Orders 
JOIN Users ON Orders.userId = Users.userId
JOIN Order_Line ON Order_Line.orderNo = Orders.orderNo
JOIN Product ON Product.prodId = Order_Line.prodId";
$exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
echo "<table>";
while ($result = mysqli_fetch_array($exeSQL)) {
	if ((!empty($_SESSION['details']['orderNo']) and $_SESSION['details']['orderNo']==$result['orderNo'] ) and (!empty($_SESSION['details']['userId'])and $_SESSION['details']['userId'] == $result['userId'])){
		echo "<tr>";
		echo "<td colspan='6'></td>";
		echo "<td>".$result['prodName']."</td>";
		echo "<td>".$result['quantityOrdered']."</td>";
		echo "</tr>";
	}else{
		unset($_SESSION['details']);
		echo "<tr>";
		echo "<th>Order</th>";
		echo "<th>Order Date Time</th>";
		echo "<th>User ID</th>";
		echo "<th>Name</th>";
		echo "<th>Surname</th>";
		echo "<th>Status</th>";
		echo "<th>Product</th>";
		echo "<th>Quantity</th>";
		echo "</tr>";
		
		$_SESSION['details']['orderNo'] = $result['orderNo'];
		$_SESSION['details']['userId'] = $result['userId'];

		echo "<tr>";
		echo "<td>".$result['orderNo']."</td>";
		echo "<td>".$result['orderDateTime']."</td>";
		echo "<td>".$result['userId']."</td>";
		echo "<td>".$result['userFName']."</td>";
		echo "<td>".$result['userSName']."</td>";
		
		// echo "<td>".$result['orderStatus']."</td>";
		$orderNo=$result['orderNo'];
		if($result['orderStatus'] == 'Placed'){
			echo "<td><form action='processorders.php' method='post'>";
			echo "<select name='updatedStatus'>";
			echo "<option value='placed'>Placed</option>";
			echo "<option value='Ready to collect'>Ready to collect</option>";
			echo "</select>&nbsp;&nbsp;<input type=submit value='Update'>";
			echo "<input type=hidden name='idOfUpdatedDetails' value='$orderNo'>";
			echo "</form></td>";
		}elseif($result['orderStatus'] == 'Ready to collect'){
			echo "<td><form action='processorders.php' method='post'>";
			echo "<select name='updatedStatus'>";
			echo "<option value='Ready to collect'>Ready to collect</option>";
			echo "<option value='Collected'>Collected</option>";
			echo "</select>&nbsp;&nbsp;<input type=submit value='Update'>";
			echo "<input type=hidden name='idOfUpdatedDetails' value='$orderNo'>";
			echo "</form></td>";
		}else{
			echo "<td>".$result['orderStatus']."</td>";
		}	
		
		echo "<td>".$result['prodName']."</td>";
		echo "<td>".$result['quantityOrdered']."</td>";
		echo "</tr>";

	}
}

include("footfile.html"); //include head layout
echo "</body>";
