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
        <link rel="stylesheet" type="text/css" href="newStyle.css" />
        <title>Register</title>
       
    </head>
    <body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="index.php">Carkea</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Search</a></li>
		<li><a href="contactus.php">Contact Us</a></li>
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
                                <a href="user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a>
                                <a href="user/wishlist.php?id=<?=$_SESSION['customerID']?>">Wishlist</a>
                                <a href="user/purchasedcars.php?id=<?=$_SESSION['customerID']?>">View Purchases</a>
                            <?php } else {?>
                                <a href="staff/editProfile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="staff/searchcustomers.php">Search Customers</a> 
                                <a href="staff/searchsoldcars.php">Search Sold Cars</a>
                            <?php } ?>
                        </div></div>
                        </li>
                        <li><a href="php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a class = "active" href="register.php">Register</a></li>
                    <?php } 
                } else { ?>
                <li><a href="login.php">Login</a></li>
                <li><a class = "active" href="register.php">Register</a></li>
                <?php }

                if (isset($_SESSION["accessLevel"])) 
                {
                    if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
                    {?>
                        <li><a href="staff/addstock.php">Add Stock</a></li>
                    <?php }  
                    else if($_SESSION["accessLevel"] == "3")
                    {?>
                        <li><a href="staff/addemployee.php">Add Employee</a></li>
                    <?php }  
                    else if($_SESSION["accessLevel"] == "4")
                    {?>
                        <li><a href="staff/addfinancecompany.php">Add Finance</a></li>
                        <li><a href="staff/searchfinance.php">Search Finance</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
        <div class="mainbodyLog">                       
            <div class="regpage">
                <h2>Register</h2>
                <h3>Please enter your details below</h3>
                <br>
                <form method="POST"  action="php_files/registerUserDB.php">
                    <table>
                        <tr><input type="text" name="username" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Username" align="center"><br></tr>
                        <br>
                        <tr><input type ="text" name ="firstname" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="First Name" align="center"><br></tr>
                        <br>
                        <tr><input type="text" name ="surname" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Surname" align="center"><br></tr>
                        <br>
                        <tr><input type ="text" name="telephone" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Telephone" align="center"><br></tr>
                        <br>
                        <tr><input type ="text" name="email" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Email" align="center"><br></tr>
                        <br>
                        <tr><input type="password" name="password" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Password" align="center"><br></tr>
                        <br>
                        <tr><input type="password" name="repeatPass" name="password" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Confirm Password" align="center"><br></tr>
                        
                    </table>
                    <br/> 
                    <input type="submit" value="Register" class="loginButton"> 
                </form> 
                <br>
                Already have an Account? <a href="login.php">Click Here to Login</a
                <br><br>
                <?php 
            if(!empty($_GET['message']))
            {
                $message = $_GET['message'];
                if($message == "success")
                {
                    echo "<p style='color:red'>You have successfully registered.</p>";
                } else if ($message == "passwordmatch") 
                {
                    echo "<p style='color:red'>The passwords you entered did not match. Please try again.</p>";
                } else if ($message == "duplicate"){
                    echo "<p style='color:red'>The username you entered is already taken. Please try again.</p>";
                } else { 
                    echo "<p style='color:red'>There was an error when registering, please try again later.</p>";
                }
            }
            ?>
            </div> <!-- close regpage -->
        </div> <!-- close mainbody -->
    </body>
</html>
