<?php
// Start the session
session_start();
if (isset( $_GET['staff'] ))
{
    if ($_GET['staff'] == 'true')
    {
        $staffLogin=true;
    } else 
    {
        $staffLogin=false;
    }
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
        <link rel="stylesheet" type="text/css" href="newStyle.css" />
        <title>Login</title>
    </head>
    <body>
        
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="index.php">Carkea</a></li>
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
                        <li><div class="dropdown">
                        <span><a href="#"><?=$loggedInUser?></a></span>
                        <div class="dropdown-content">
                            <?php if ($_SESSION['staff'] === "false")
                            {?>
                                <a href="user/editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">View Purchases</a>
                            <?php } else {?>
                                <a href="staff/editProfile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="staff/searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">Link 3</a>
                            <?php } ?>
                        </div></div>
                        </li>
                        <li><a href="php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a class = "active" href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <?php } 
                } else { ?>
                <li><a class = "active" href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <?php }

                if (isset($_SESSION["accessLevel"])) 
                {
                    if($_SESSION["accessLevel"] == "1")
                    {?>
                        <li><a href="staff/addstock.php">Add Stock</a></li>
                    <?php }  
                    else if($_SESSION["accessLevel"] == "3")
                    {?>
                        <li><a href="staff/addemployee.php">Add Employee</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
        
        <div class="mainbody">
            <div class="regpage">
            <h2>Enter your Username and password</h2>
            <h3>Login</h3>
           
            <?php
            
            if (isset($_SESSION["incorrectLogin"]))
            {
                if ($_SESSION["incorrectLogin"] == "true")
                {
                    echo "<p>Username or Password incorrect, Please try again</p>";
                }
            }
            
            ?>
            
            <form method="POST"  action="php_files/LogUserIn.php">
                <ul style='list-style:none;'>
                    <li>User Name &nbsp;&nbsp;<input type="text" name="username"></li>
                    <li><br></li>
                    <li>Password  &nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password"></li>
                    <li><br></li>
                    <?php 
                    if (isset($staffLogin) &&  $staffLogin == 'true')
                    { ?>
                        <li><input type="checkbox" name="staff" value="staff" checked>Staff?</li>
                    <?php 
                                
                    } else { ?>
                        <li><input type="checkbox" name="staff" value="staff">Staff?</li>
                    <?php } ?>
                </ul>
                <br/> 
                <input type="submit" value="Login"> 
            </form>       
            </div> <!-- close regpage -->
        </div> <!-- close mainbody -->
    </body>
</html>
