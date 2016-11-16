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
        <link rel="stylesheet" type="text/css" href="../newStyle.css" />
        <title>Add Employee</title>
    </head>
    <body>
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
            <br><br>
            <div id="editprof">
            <form method="POST"  action="include/addEmployeeDB.php">
                <table>
                    <tr>
                        <td>Select a Role</td>
                    <td><select id="roleSelect" name="roleSelect" class="inputText">
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
                    </select></td>
                    </tr>
                    <tr>
                    <td>Select a Branch</td>
                    <td><select id="branchSelect" name="branchSelect" class="inputText">
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
                    </select></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="firstName" required class="inputText"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="lastName" required class="inputText"></td>
                    </tr>
                    <tr>
                        <td>Salary</td>
                        <td><input type="text" name="salary" required class="inputText"></td>
                    </tr>
                    <tr>
                        <td>Line Manager ID(if any)</td>
                        <td><input type="text" name="manager" class="inputText"></td>
                    </tr>
                    <tr>
                        <td>Account Username</td>
                        <td><input type="text" name="username" required class="inputText"></td>
                    </tr>
                    <tr>
                        <td>Temporary Account Password</td>
                        <td><input type="password" name="password" required class="inputText" minlength=4 maxlength=72></td>
                    </tr>
                    <tr>
                        <td>Repeat Account Password</td>
                        <td><input type="password" name="repeatPassword" required class="inputText" minlength=4 maxlength=72></td>
                    </tr>
                </table>
                 <br>
                <input type="submit" value="Add Employee" class = "profButton"> 
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
                } else if ($message ==  "detailsmissing") {
                     echo "<p>There was information missing from the form.</p>";
                } else {
                    echo "<p>There was an error when adding the employee to the database, please try again.</p>";
                }
            }
            ?>
            </div>
        </div> <!-- close mainbody -->
    </body>
</html>
