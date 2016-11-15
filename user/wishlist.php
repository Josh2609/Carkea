<?php
// Start the session
session_start(); 
$id = $_GET['id'];
if (isset($_SESSION['loggedIn']) && isset($_SESSION['customerID'])) 
{
    if ($id != $_SESSION['customerID'])
    {
        header("Location: ../index.php");
    }
    if($_SESSION['loggedIn'] !== "true" )
    {
        header("Location: ../index.php");
    } 
} else {
    header("Location: ../index.php");
}
$customerID = $_SESSION['customerID'];
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
        <link rel="stylesheet" type="text/css" href="../newStyle.css" />
        <script src="js/showUser.js"></script>
        <title>Edit Profile</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="../index.php">Carkea</a></li>
                <li><a href="../index.php">Home</a></li>
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
                            <a href="editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                            <a href="updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a> <!-- Add if for user type **EDIT** -->
                            <a href="#">View Purchases</a>
                        </div></div>
                        </li>
                        <li><a href="../php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="../login.php">Login</a></li>
                    <?php } 
                } else { ?>
                <li><a href="../login.php">Login</a></li>
                <?php } ?>
                </ul>
        </div> <!-- nav close -->
        <br><br><br><br>
        <h2 align="center">Wishlist</h2>
        <?php
            include "include/getWishlist.php";

        ?>
    </body>
</html>
