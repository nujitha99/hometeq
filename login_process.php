<?php

session_start();
include("db.php");

$pagename = "Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

$email = $_POST['email'];
$psw = $_POST['psw'];

if(!empty($email) && !empty($psw)){
    $sql="select * from Users";
    $exeSQL=mysqli_query($conn, $sql) or die (mysqli_error($conn)); 
    while($arrayp=mysqli_fetch_array($exeSQL)){
        if($email==$arrayp['userEmail']){
            if($psw!==$arrayp['userPassword']){
                echo "<p>Password not recognised, login again</p>";
                break;
            } else {
                echo "<p>Login Success!</p><br>";
                $_SESSION['userId']=$arrayp['userId'];
                $_SESSION['userType']=$arrayp['userType'];
                $_SESSION['userFName']=$arrayp['userFName'];
                $_SESSION['userSName']=$arrayp['userSName'];
                echo "Hello, ".$_SESSION['userFName']." ".$_SESSION['userSName']."<br><br>";
                if($_SESSION['userType']=='C'){
                    echo "You have successfully logged in as a hometeq Customer.<br>";
                } else {
                    echo "You have successfully logged in as a hometeq Admin.<br>";
                }
                
                echo "Continue shopping for <a href=index.php>Home Tech</a><br>";
                echo "view your <a href=basket.php>Smart Basket</a>";
                                
             break;
            }
        }
    }
    if($email!==$arrayp['userEmail']){
        
    }
} else {
    echo "Entered email: ".$email."<br>";
    echo "Entered password: ".$psw;
}

include("footfile.html"); //include footer layout
echo "</body>";
