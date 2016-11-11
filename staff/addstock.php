<?php
// Start the session
session_start(); 
if (isset($_SESSION['loggedIn']) || isset($_SESSION['staff']) || isset($_SESSION['accessLevel'])) 
{
    if($_SESSION['loggedIn'] !== "true" || $_SESSION['staff'] !== "true" || $_SESSION['accessLevel'] != "1")
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
        <title>Add Stock</title>
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
                    if($_SESSION["accessLevel"] == "1")
                    {?>
                        <li><a class = "active" href="/addstock.php">Add Stock</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
        
        <div class="mainbody">
             <form method="POST"  action="include/addStockDB.php" enctype="multipart/form-data">
                <ul style='list-style:none;'>
                    <?php if ($_SESSION['accessLevel'] == "1")
                    {?>
                    <li><select id="branchSelect1" name="branchSelect">
                        
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
                    </select></li>
                        <?php
                    } else if ($_SESSION['accessLevel'] == "10")
                    { ?>
                    <li><select id="branchSelect10" name="branchSelect">
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
                    <?php } ?>
                        
                    <li>Vehicle Identification Number (VIN)<input type="text" name="vin" required></li>
                    <li>Registration<input type="text" name="reg" required></li>
                    <li>Make<input type="text" name="make" required></li>
                    <li>Model<input type="text" name="model" required></li>
                    <li>Colour<input type="text" name="colour" required></li>
                    <li>Mileage<input type="text" name="mileage" required></li>
                    <li>Fuel Type<input type="text" name="fuelType" required></li>
                    <li>Car Type<input type="text" name="carType" required></li>
                    <li>Transmission<input type="text" name="transmission" required></li>
                    <li>Manufacture Date<input type="text" name="manufactureDate" required></li>
                    <li>Number of Doors<input type="text" name="numDoors" required></li>
                    <li>Engine Size<input type="text" name="engSize" required></li>
                    
                    <li>Asking Price<input type="text" name="askPrice" required></li>
                    <li>Condition<input type="text" name="condition" required></li>
                    
                    <li>File to upload: <input type="file" name="carImage" accept="image/jpeg,image/pjpeg,image/bmp,image/gif,image/jpeg,image/png"><br/></li>
                </ul>
                <input type="submit" value="Add Stock"> 
            </form> 
            
            <form action="include/addCarImage.php" method="POST" enctype="multipart/form-data">
                <label>File: </label><input type="file" name="image" />
                <input type="submit" />
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
        </div> <!-- mainbody close -->
    </body>
</html>
