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
        <link rel="stylesheet" type="text/css" href="../Style.css" />
        <script src="../dropdown.js"></script>
        <script src="js/showUser.js"></script>
        <title>Edit Profile</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li style="float:left; color:#999999"><a href="index.php">Carkea</a></li>
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
                        <li class="dropdown">
                        <button onclick="myFunction()" class="dropbtn"><?=$loggedInUser?></button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="editProfile.php">Edit Details</a>
                            <a href="#">View Purchases</a> <!-- Add if for user type **EDIT** -->
                            <a href="#">Link 3</a>
                        </div>
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
        <div class="mainbody">
            <form method="POST"  action="include/changePass.php">
                <ul style='list-style:none;'>
                    <li>Enter a new password if you would like to update your password</li>
                    <li><br></li>
                    <li>Current Password  &nbsp;<input type="password" name="currPassword"></li> 
                    <li>New Password  &nbsp;<input type="password" name="newPassword"></li>
                    <li>Repeate New Password  &nbsp;<input type="password" name="repeatNewPass"></li>
                </ul>
                <input type="submit" value="Change Password"> 
            </form> 
            
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