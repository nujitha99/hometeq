<?php

session_start();
include("db.php");
$pagename = "Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";

include("headfile.html"); //include header layout file

echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page


if (isset($_POST['h_prodid'])) {

    $newprodid = $_POST['h_prodid'];
    $reququantity = $_POST['p_quantity'];

    //create a new cell in the basket session array. Index this cell with the new product id. //Inside the cell store the required product quantity
    $_SESSION['basket'][$newprodid] = $reququantity;
    //echo "<p>The doc id ".$newdocid." has been ".$_SESSION['basket'][$newdocid];
    echo "<p>1 item added";

    echo "<p>Id of the selected product : " . $newprodid . "</p>";
    echo "<p>Quantity of the selected product : " . $reququantity . "</p>";

    echo "<table border=1>";
    echo "<tr>
		<th>Product Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Subtotal</th>
		<th></th>
		</tr>";
    $total = 0;
    foreach ($_SESSION['basket'] as $index => $value) {
        $sql = "select prodName,prodPrice from Product where prodId=" . $index;
        $exeSQL = mysqli_query($conn, $sql) or die (mysqli_error($conn));
        $arrayp = mysqli_fetch_array($exeSQL);
        $price = $arrayp['prodPrice'];
        $subtotal = $value * $price;
        $total = $total + $subtotal;

        echo "<tr><td>" . $arrayp['prodName'] . "</td>";
        echo "<td>" . $arrayp['prodPrice'] . "</td>";
        echo "<td>" . $value . "</td>";
        echo "<td>" . $subtotal . "</td>";
        echo "<td><form method=POST action=basket.php>";
        echo "<input type=hidden name=prodid_del value=" . $index . ">";
        echo "<input type=submit value='Remove'></td></form>";
        echo "</tr>";
    }

    echo "<tr ><td colspan=3>Total</td><td>" . $total . "</td></tr></table><br>";
    echo "<a href='clearbasket.php'>Clear basket</a><br><br>";

    echo "New Users sign up : <a href='signup.php'>Sign up</a> <br>";

    echo "Users log in : <a href='login.php'>log in </a> <br><br>";

} else {
    echo "Current basket unchanged";
}


include("footfile.html"); //include footer layout

echo "</body>";

?>
