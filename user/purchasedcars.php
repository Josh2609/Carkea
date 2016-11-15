<?php
// Start the session
session_start(); 
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
        <!--<link rel="stylesheet" type="text/css" href="Style.css" />-->
        <link href="../newStyle.css" rel="stylesheet" type="text/css"/>
        <title>Purchased Cars</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="../index.php">Carkea</a></li>
                <li><a class = "active" href="../index.php">Home</a></li>
                <li><a href="../search.php">Search</a></li>
		<li><a href="#">Contact Us</a></li>
                <li><a href="../branchlist.php">Branch List</a></li>
                <?php 
                if (isset($_SESSION['username'])) {
                    $loggedInUser = $_SESSION["username"];
                }
                //session_destroy(); 
                if (isset($_SESSION['loggedIn'])) {
                    if($_SESSION['loggedIn'] == "true" )
                    {   ?>
                        <li><div class="dropdown">
                        <span><a href="#"><?=$loggedInUser?></a></span>
                        <div class="dropdown-content">
                            <?php if ($_SESSION['staff'] === "false")
                            {?>
                                <a href="editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a>
                                <a href="wishlist.php?id=<?=$_SESSION['customerID']?>">Wishlist</a>
                                <a href="purchasedcars.php?id=<?=$_SESSION['customerID']?>">View Purchases</a>
                            <?php } ?>
                        </div></div>
                        </li>
                        <li><a href="../php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="../login.php">Login</a></li>
                    <li><a href="../register.php">Register</a></li>
                    <?php } 
                } else { ?>
                <li><a href="../login.php">Login</a></li>
                <li><a href="../register.php">Register</a></li>
                <?php }?>
            </ul>
        </div> <!-- nav close -->
        <br><br><br><br>
            <?php include "include/getPurchasedCars.php";?>

    </body>
</html>
