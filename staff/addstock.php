<?php
// Start the session
session_start(); 
if (isset($_SESSION['loggedIn']) && isset($_SESSION['staff'])) 
{
    if($_SESSION['loggedIn'] !== "true" && $_SESSION['staff'] !== "true")
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
        <link rel="stylesheet" type="text/css" href="../Style.css" />
        <title>Add Stock</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li style="float:left; color:#999999"><a href="../index.php">Carkea</a></li>
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
                        <li><a href="../profile.php"><?=$loggedInUser?></a></li>
                        <li><a href="../php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="../login.php">Login</a></li>
                    <?php } 
                } else { ?>
                <li><a href="../login.php">Login</a></li>
                <?php }

                if (isset($_SESSION["accessLevel"])) 
                {
                    if($_SESSION["accessLevel"] == "1")
                    {?>
                        <li><a class = "active" href="/addstock.php">Add Stock</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
        <?php
        // put your code here
        ?>
    </body>
</html>
