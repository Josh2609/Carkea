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
                                <a href="staff/searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="staff/searchsoldcars.php">Search Sold Cars</a>
								<?php if (isset($_SESSION["accessLevel"])) 
									{
										if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
										{?>
											<a href="staff/addstock.php">Add Stock</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "3")
										{?>
											<a href="staff/addemployee.php">Add Employee</a>
											<a href = "staff/searchemployees.php">Search Employees</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "4")
										{?>
											<a href="staff/addfinancecompany.php">Add Finance</a>
											<a href="staff/searchfinance.php">Search Finance</a>
										<?php }  
										}?>
                            <?php } ?>
                        </div></div>
                        </li>
                        <li><a href="php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a  class = "active" href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <?php } 
                } else { ?>
                <li><a class = "active" href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <?php } ?>
			</ul>
        </div> <!-- nav close -->
        
        <div class="mainbodyLog">                       
            <div class="logpage">
                <h2>Login</h2>
                <form method="POST"  action="php_files/LogUserIn.php">
                    <table>
                        <tr><input type="text" name="username" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Username" align="center" required minlength=4 maxlength=72 ><br></tr>
                        <br>
                        <tr><input type="password" name="password" style="width:280px;border:none;border-bottom:1px solid #999999;font-size: 18px;color:#2d5986" placeholder="Password" align="center" required minlength=4 maxlength=72 ><br></tr>
                        <br>
						<?php 
							if (isset($staffLogin) &&  $staffLogin == 'true')
							{ ?>
                         <tr><input type="checkbox" name="staff" value="staff" checked>Staff?</tr>
                    <?php 
                                
                    } else { ?>
                        <tr><input type="checkbox" name="staff" value="staff">Staff?</tr>
                    <?php } ?>
                        
                    </table>
                    <br/> 
                    <input type="submit" value="Login" class="loginButton"> 
                </form> 
                <br>
                Don't have an Account? <a href="register.php">Click Here to Register</a>
                <br>
                <?php
            
            if (isset($_SESSION["incorrectLogin"]))
            {
                if ($_SESSION["incorrectLogin"] == "true")
                {
                    echo "<p style='color:red'>Username or Password incorrect, Please try again</p>";
                }
            }
            ?>
            </div> <!-- close regpage -->
        </div> <!-- close mainbody -->
    </body>
</html>
