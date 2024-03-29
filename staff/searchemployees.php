<?php
// Start the session
session_start(); 
$_SESSION["incorrectLogin"] = "false";
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
        <title>Customer Search</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="../index.php">Carkea</a></li>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../search.php">Search</a></li>
		<li><a href="../contactus.php">Contact Us</a></li>
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
                                <a href="user/editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a>
                                <a href="user/wishlist.php?id=<?=$_SESSION['customerID']?>">Wishlist</a>
                                <a href="user/purchasedcars.php?id=<?=$_SESSION['customerID']?>">View Purchases</a>
                            <?php } else {?>
                                <a href="editprofile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
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
                        <li><a href="searchfinance.php">Search Finance</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
         <div class="mainbodyProf">
            <br>
            <div id="editprof">
            <form method="POST"  action="include/getSearchEmployeeResult.php">
                <table>
                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="username" class="inputText" placeholder="Username(any)"></td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="firstName" class="inputText" placeholder="First Name(any)"></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="lastName" class="inputText" placeholder="Last Name(any)"></td>
                    </tr>
                    <tr>
                        <td>EmployeeID:</td>
                        <td><input type="text" name="employeeID" class="inputText" placeholder="EmployeeID(any)"><td>
                    </tr>
                    <tr>
                        <td>Role:</td>
                        <td><input type="text" name="role" class="inputText" placeholder="Role(any)"></td>
                    </tr>   
                    <tr>
                        <td>Branch:</td>
                        <td><input type="text" name="branch" class="inputText" placeholder="Branch(any)"></td>
                    </tr>   
                </table>
                <br>
                <input type="submit" value="Search" class = "profButton">
                <!--<button class = "profButton" type="button" onclick="showSearchCustomerResults(username,firstName,lastName,email,telephone)">Search</button>-->
            </form>  
            </div>
        </div>
    </body>
</html>
