<?php
// Start the session
session_start(); 
if (isset($_SESSION['loggedIn']) || isset($_SESSION['staff']) || isset($_SESSION['accessLevel'])) 
{
    if($_SESSION['loggedIn'] !== "true" || $_SESSION['staff'] !== "true" || $_SESSION['accessLevel'] != "4")
    {
        header("Location: ../index.php");
    } 
} else {
    header("Location: ../index.php");
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
        <link rel="stylesheet" type="text/css" href="../newStyle.css" />
        <title>Add Finance Company</title>
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
                            <?php if ($_SESSION['staff'] === "true")
                                {?>
                                <a href="editProfile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="searchsoldcars.php">Search Sold Cars</a>
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
                <?php }

                if (isset($_SESSION["accessLevel"])) 
                {
                    if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
                    {?>
                        <li><a href="addstock.php">Add Stock</a></li>
                    <?php }  
                    else if($_SESSION["accessLevel"] == "3")
                    {?>
                        <li><a href="addemployee.php">Add Employee</a></li>
                    <?php }  
                    else if($_SESSION["accessLevel"] == "4")
                    {?>
                        <li><a href="addfinancecompany.php">Add Finance</a></li>
                        <li><a class="active"  href="searchfinance.php">Search Finance</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
         <div class="mainbody">
            <form method="POST"  action="include/getFinance.php">
                <ul style='list-style:none;'>
                    <li>Customer ID<input type="text" name="custID"></li>
                    <li><br></li>
                    <li>Car Registration<input type="text" name="carReg"></li>
                    <li><br></li>
                </ul>
                <input type="submit" value="Search"> 
            </form>       
        </div> <!-- close mainbody -->
    </body>
</html>
