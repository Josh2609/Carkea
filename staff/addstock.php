<?php
// Start the session
session_start(); 
if (isset($_SESSION['loggedIn']) || isset($_SESSION['staff']) || isset($_SESSION['accessLevel'])) 
{
    if($_SESSION['loggedIn'] !== "true" || $_SESSION['staff'] !== "true" || $_SESSION['accessLevel'] != "1" || $_SESSION['accessLevel'] != "2")
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
        <title>Add Stock</title>
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
                        <li><a class="active" href="addstock.php">Add Stock</a></li>
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
             <br><br>
            <div id="editprof">
             <form action="include/addStockDB.php" method="POST" enctype="multipart/form-data" >
                <table>
                    <?php if ($_SESSION['accessLevel'] == "1")
                    {?>
                    <tr>
                        <td>Select a Branch:</td>
                        <td><select id="branchSelect1" name="branchSelect" class="inputText">
                        
                            <?php
                            include "../php_files/db_connect.php";
                            $stmt = $dbConnection->prepare('SELECT Branch_ID, Branch_Name FROM branchView WHERE Branch_ID=:branchID');
                            $stmt->bindParam(':branchID',$_SESSION["empBranch"]);
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $branchID = $row['Branch_ID'];
                                $branchName = $row['Branch_Name'];  
                            } ?>
                            <option value="<?=$branchID?>"><?=$branchName?></option>
                        </select></td>
                    </tr>
                        <?php
                    } else if ($_SESSION['accessLevel'] == "10")
                    { ?>
                    <tr>
                        <td>Select a Branch<td>
                        <td><select id="branchSelect10" name="branchSelect" class="inputText">
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
                            </select><td>
                                
                    </tr>
                    <?php } ?>
                        
                    <tr>
                        <td>Vehicle Identification Number (VIN)</td>
                        <td><input type="text" name="vin" required class="inputText" placeholder="01234567891234567"></td>
                    </tr>
                    <tr>
                        <td>Registration</td>
                        <td><input type="text" name="reg" required class="inputText" placeholder="AA11 AAA"></td>
                    </tr>
                    <tr>
                        <td>Make</td>
                        <td><input type="text" name="make" required class="inputText" placeholder="Ford"></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><input type="text" name="model" required class="inputText" placeholder="Mondeo"></td>
                    </tr>
                    <tr>
                        <td>Colour</td>
                        <td><input type="text" name="colour" required class="inputText" placeholder="Blue"></td>
                    </tr>
                    <tr>
                        <td>Mileage</td>
                        <td><input type="text" name="mileage" required class="inputText" placeholder="00001"></td>
                    </tr>
                    <tr>
                        <td>Fuel Type</td>
                        <td><input type="text" name="fuelType" required class="inputText" placeholder="Petrol"></td>
                    </tr>
                    <tr>
                        <td>Car Type</td>
                        <td><input type="text" name="carType" required class="inputText" placeholder="Saloon"></td>
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <td><input type="text" name="transmission" required class="inputText" placeholder="Manual"></td>
                    </tr>
                    <tr>
                        <td>Manufacture Date</td>
                        <td><input type="text" name="manufactureDate" required class="inputText" placeholder="YYYY-MM-DD"></td>
                    </tr>
                    <tr>
                        <td>Number of Doors</td>
                        <td><input type="text" name="numDoors" required class="inputText" placeholder="5"></td>
                    </tr>
                    <tr>
                        <td>Engine Size</td>
                        <td><input type="text" name="engSize" required class="inputText" placeholder="2.0L"></td>
                    </tr>
                    <tr>
                        <td>Asking Price</td>
                        <td><input type="text" name="askPrice" required class="inputText" placeholder="£20000"></td>
                    </tr>
                    <tr>
                        <td>Condition</td>
                        <td><input type="text" name="condition" required class="inputText" placeholder="New"></td>
                    </tr>                    
                    <tr>
                        <td><label>Select an Image</label></td>
                        <td><input type="file" name="image" accept="image/*"/></td>
                    </tr>
                </table>
                 <br>
                <input type="submit" value="Add Stock" class = "profButton"> 
            </form> 
            
            <?php 
            if(!empty($_GET['message']))
            {
                $message = $_GET['message'];
                if($message == "success")
                {
                    echo "<p>Stock successfully added to the database</p>";
                } else if ($message == "Duplicate") 
                {
                    echo "<p>This Vehicle Identification Number already exists in the database</p>";
                } else {
                    echo "<p>There was an error when adding the stock to the database, please try again</p>";
                }
            }
            ?>
            </div>
        </div> <!-- mainbody close -->
    </body>
</html>
