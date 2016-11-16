<?php
// Start the session
session_start();
$id = $_GET['id'];
if (isset($_SESSION['loggedIn']) && isset($_SESSION['employeeID'])) 
{
    if ($id != $_SESSION['employeeID'])
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
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="index.php">Carkea</a></li>
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
                        <span><a class = "active" href="#"><?=$loggedInUser?></a></span>
                        <div class="dropdown-content">
                            <?php if ($_SESSION['staff'] === "false")
                            {?>
                                <a href="../user/editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="../user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a>
                                <a href="../user/wishlist.php?id=<?=$_SESSION['customerID']?>">Wishlist</a>
                                <a href="../user/purchasedcars.php?id=<?=$_SESSION['customerID']?>">View Purchases</a>
                            <?php } else {?>
                                <a href="../staff/editProfile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="../staff/searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="../staff/searchsoldcars.php">Search Sold Cars</a>
								<?php if (isset($_SESSION["accessLevel"])) 
									{
										if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
										{?>
											<a href="../staff/addstock.php">Add Stock</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "3")
										{?>
											<a href="../staff/addemployee.php">Add Employee</a>
											<a href = "../staff/searchemployees.php">Search Employees</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "4")
										{?>
											<a href="../staff/addfinancecompany.php">Add Finance</a>
											<a href="../staff/searchfinance.php">Search Finance</a>
										<?php }  
										}?>
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
                <?php } ?>
			</ul>
        </div> <!-- nav close -->
        <div class="mainbodyProf">
            <br>
            Enter a new password if you would like to update your password
            <br><br>
            <div id="editprof">
            <form method="POST"  action="include/changePass.php">
                <table>
                    <tr>
                        <td>Current Password:</td>
                        <td><input type="password" name="currPassword" class="inputText"></td>
                    </tr> 
                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name="newPassword" class="inputText"></td>
                    </tr>
                    <tr>
                        <td>Repeat New Password:</td>
                        <td><input type="password" name="repeatNewPass" class="inputText"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" value="Change Password" class = "profButton"> 
            </form> 
            </div>
            
            <?php 
            if(!empty($_GET['message2']))
            {
                $message = $_GET['message2'];
                if($message == "success")
                {
                    echo "<p>Password successfully updated</p>";
                } else if ($message == "passwordnotmatch")
                {
                    echo "<p>The password you entered did not match your stored password.</p>";
                } else if ($message == "newpassnotmatch")
                {
                    echo "<p>The new passwords you entered did not match.</p>";
                } else {
                    echo "<p>There was an error when updating your details, please try again.</p>";
                }
            }
            ?>   
        </div> <!-- close mainbody -->
    </body>
</html>
