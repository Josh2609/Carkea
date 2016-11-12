<?php
// Start the session
session_start(); 
if (isset($_SESSION['loggedIn']) || isset($_SESSION['staff']) || isset($_SESSION['accessLevel'])) 
{
    if($_SESSION['loggedIn'] !== "true" || $_SESSION['staff'] !== "true" || $_SESSION['accessLevel'] != "3")
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
        <title>Add Employee</title>
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
                    if($_SESSION["accessLevel"] == "3")
                    {?>
                        <li><a class = "active" href="addemployee.php">Add Employee</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
        <div class="mainbody">
            
            <form method="POST"  action="include/addEmployeeDB.php">
                <ul style='list-style:none;'>
                    <li><select id="roleSelect" name="roleSelect">
                        <?php
                            include "../php_files/db_connect.php";
                            $stmt = $dbConnection->prepare('SELECT Role_ID, Role_Name FROM roleView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $roleID = $row['Role_ID'];
                                $roleName = $row['Role_Name'];   ?>
                                <option value="<?=$roleID?>"><?=$roleName?></option>
                        <?php } ?>
                    </select></li>
                    
                    <li><select id="branchSelect" name="branchSelect">
                        <?php
                            include "../php_files/db_connect.php";
                            $stmt = $dbConnection->prepare('SELECT Branch_ID, Branch_Name FROM branchView');
                            $stmt->execute();
                            
                        foreach ($stmt as $row)
                        { 
                            $branchID = $row['Branch_ID'];
                            $branchName = $row['Branch_Name'];?>
                            <option value="<?=$branchID?>"><?=$branchName?></option>
                        <?php } ?>
                    </select></li>
                    
                    <li>First Name<input type="text" name="firstName" required></li>
                    <li>Last Name<input type="text" name="lastName" required></li>
                    <li>Salary<input type="text" name="salary" required></li>
                    <li>Line Manager (if any)<input type="text" name="manager"></li>
                    
                    <li>Account Username<input type="text" name="username" required></li>
                    <li>Temporary Account Password<input type="password" name="password" required></li>
                    <li>Repeat Account Password<input type="password" name="repeatPassword" required></li>

                </ul>
                <br/> 
                <input type="submit" value="Add Employee"> 
            </form>  
            
            <?php 
            if(!empty($_GET['message']))
            {
                $message = $_GET['message'];
                if($message == "success")
                {
                    echo "<p>Employee successfully added to the database.</p>";
                } else if ($message == "passwordmatch") 
                {
                    echo "<p>The passwords you entered did not match. Please try again.</p>";
                } else if ($message == "duplicate"){
                    echo "<p>The username you entered is already taken. Please try again.</p>";
                } else { 
                    echo "<p>There was an error when adding the employee to the database, please try again.</p>";
                }
            }
            ?>
            
        </div> <!-- close mainbody -->
    </body>
</html>
