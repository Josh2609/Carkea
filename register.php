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
        <link rel="stylesheet" type="text/css" href="Style.css" />
        <script src="dropdown.js"></script>
        <title>Register</title>
       
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
                                <a href="user/editProfile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">View Purchases</a>
                            <?php } else {?>
                                <a href="staff/editProfile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="staff/searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">Link 3</a>
                            <?php } ?>
                        </div>
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

            <h2>Register</h2>
            <h3>Please enter your details below</h3>
            
            
            <form method="POST"  action="php_files/registerUserDB.php">
                <ul style='list-style:none;'>
                        <li>First Name<input type ="text" name ="firstname"></li>
                        <li><br></li>
                        <li>Surname<input type="text" name ="surname"></li>
                        <li><br></li>
                        <li>Telephone<input type ="text" name="telephone"></li>
                        <li><br></li>
                        <li>Email<input type ="text" name="email"></li>
                        <li><br></li>
                        <li>Username<input type="text" name="username"></li>
                        <li><br></li>
                        <li>Password<input type="password" name="password"></li>
                        <li><br></li>
                        <li>Repeat Password<input type="password" name="repeatPass"></li>
                        <li><br></li>
                    </ul>
                <br/> 
                <input type="submit" value="Register"> 
            </form>
            
            <?php 
            if(!empty($_GET['message']))
            {
                $message = $_GET['message'];
                if($message == "success")
                {
                    echo "<p>You have successfully registered.</p>";
                } else if ($message == "passwordmatch") 
                {
                    echo "<p>The passwords you entered did not match. Please try again.</p>";
                } else if ($message == "duplicate"){
                    echo "<p>The username you entered is already taken. Please try again.</p>";
                } else { 
                    echo "<p>There was an error when registering, please try again later.</p>";
                }
            }
            ?>
        </div> <!-- close mainbody -->
    </body>
</html>