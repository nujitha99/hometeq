<?php

session_start();
include("db.php");

$type = 'u';
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$address = $_POST['address'];
$pCode = $_POST['pCode'];
$telNo = $_POST['telNo'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$conPsw = $_POST['conPsw'];

$pagename = "Signing in"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page


if (!empty($type) && !empty($fName) && !empty($lName) && !empty($address) && !empty($pCode) && !empty($telNo) && !empty($email) && !empty($psw) && !empty($conPsw)) {
    if ($psw !== $conPsw) {
        echo "<b><p>Sign-up failed!</p></b>";
        echo "<p>The two passwords do no match.</p>";
        echo "<p>Make sure you enter them coorectly</p>";
        echo "<p>Go back to <a href=signup.php> signup </a> page</p>";
    } else {
        if ((preg_match("/@/", $email)) && (preg_match("/.com/", $email))) {
            $sql = "select userEmail from Users;";
            $exeSQL = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            while ($arrayp = mysqli_fetch_array($exeSQL)) {
                if ($email == $arrayp['userEmail']) {
                    echo "<h5>Sign up failed</h5>";
                    echo "<p>Email has been used before";
                    echo "Retry sign up <a href='signup.php'>Sign up</a><br><br></p>";
                    break;
                }
                $sql = "INSERT INTO Users (userType, userFname, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword) values ('$type', '$fName', '$lName', '$address', '$pCode', '$telNo', '$email', '$psw')";
                if ($exeSQL = mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                    break;
                } else {
                    if (mysqli_errno($conn) == 1062) {
                        echo "<b><p>Sign-up failed!</p></b>";
                        echo "<p>Email already in use</p>";
                        break;
                    } elseif (mysqli_errno($conn) == 1064) {
                        echo "<b><p>Sign-up failed!</p></b>";
                        echo "<p>Invalid characters entered in the form</p>";
                        break;
                    }
                }
            }
        } else {
            echo "<b><p>Sign-up failed!</p></b>";
            echo "<p>Invalid email</p>";
        }
    }
} else {
    echo "<b><p>Sign-up failed!</p></b>";
    echo "<p>Hey, you have forgot to enter something</p>";
}

include("footfile.html"); //include footer layout
echo "</body>";
