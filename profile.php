<?php
// Start the session
session_start(); // get on the sesh
if (isset($_SESSION['loggedIn'])) 
{
    if($_SESSION['loggedIn'] !== "true" )
    {
        header("Location: index.php");
    } 
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Style.css" />
        <script src="dropdown.js"></script>
        <title></title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li style="float:left; color:#999999"><a href="index.php">Carkea</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Search</a></li>
		<li><a href="#">Contact Us</a></li>
                <li><a href="branchlist.php">Branch List</a></li>
                <?php 
                if (isset($_SESSION['username'])) {
                    $loggedInUser = $_SESSION["username"];
                }
                //session_destroy(); 
                if (isset($_SESSION['loggedIn'])) {
                    if($_SESSION['loggedIn'] == "true" )
                    {   ?>
                        <li class="dropdown">
                        <button onclick="myFunction()" class="dropbtn"><?=$loggedInUser?></button>
                        <div id="myDropdown" class="dropdown-content">
                            <?php if ($_SESSION['staff'] === "false")
                            {?>
                                <a href="user/editProfile.php">Edit Details</a>
                                <a href="#">View Purchases</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">Link 3</a>
                            <?php } else {?>
                                <a href="staff/editProfile.php">Edit Details</a>
                                <a href="#">View Purchases</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">Link 3</a>
                            <?php } ?>
                        </div>
                        </li>
                        <li><a href="php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <?php } 
                } else { ?>
                <li><a href="login.php">Login</a></li>
                <?php } ?>
                </ul>
        </div> <!-- nav close -->
    </body>
</html>
