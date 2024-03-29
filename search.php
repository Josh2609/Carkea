<?php
// Start the session
session_start(); // get on the sesh
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <meta charset="UTF-8">
        <!--<link rel="stylesheet" type="text/css" href="Style.css" />-->
        <link href="newStyle.css" rel="stylesheet" type="text/css"/>
        <script src="dropdown.js"></script>
        <script src="js/showSearchResults.js"></script>
        <title>Search</title>
        <script>
            var make = '%';
            var model = '%';
            var colour = '%';
            var fuel = '%';
            var carType = '%';
            var transType = '%';
            var numDoors = '%';
            var condition = '%';
            var mileLow = '0';
            var mileHigh = '100000000';
            var postcode = '';
            var distance = '500';
            var priceLow = '0';
            var priceHigh = '100000000';
            
            function getMake(option) {
                make = option.value;  
            }
            function getModel(option) {
                model = option.value;  
            }
            function getColour(option) {
                colour = option.value;  
            }
            function getFuel(option) {
                fuel = option.value;  
            }
            function getCarType(option) {
                carType = option.value;  
            }
            function getTransType(option) {
                transType = option.value;  
            }
            function getNumDoors(option) {
                numDoors = option.value;  
            }
            function getCondition(option) {
                condition = option.value;  
            }
            function getMileLow(option) {
                mileLow = option.value;  
            }
            function getMileHigh(option) {
                mileHigh = option.value;  
            }
            function getPostcode(option) {
                postcode = option.value;  
            }
            function getDistance(option) {
                distance = option.value;  
            }
            function getPriceLow(option) {
                priceLow = option.value;  
            }
            function getPriceHigh(option) {
                priceHigh = option.value;  
            }
        </script>
            
    </head>
    <body>
            <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="index.php">Carkea</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a class = "active" >Search</a></li>
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
                    <li><a href="register.php">Register</a></li>
                    <?php } 
                } else { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
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
        <div>
            <div class="searchBody">
            <div class="thingyholder">
            <br>
            <a href="#hide1" class="hide" id="hide1">Click to hide the Search Options</a>
            <a href="#show1" class="show" id="show1">Click to view the Search Options</a>
                        <br><br>
            
            <div class="list">  
            <form method="POST"  action="php_files/getSearchResults.php">
                <table style="width:100%">
                <tr>
                    <td><input type="text" name="postcode" placeholder="Postcode" onchange="getPostcode(this)" style="width: 150px;height:25px;"></td>
                    <td><input type="text" name="distance" placeholder="Distance" onchange="getDistance(this)" style="width: 150px;height:25px;"></td>
                    <td><select id="makeSelect" name="makeSelect" onchange="getMake(this)" style="width: 155px;height:30px;color:#2d5986">
                        <option value="anyMake">Make (Any)</option>
                        <?php
                            include "php_files/db_connect.php";
                            $stmt = $dbConnection->prepare('SELECT * FROM makeView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $make = $row['Make'];   ?>
                                <option value="<?=$make?>"><?=$make?></option>
                        <?php } ?>
                    </select></td><!-- MAKE OPTION -->
                     </tr>
                    <tr>
                        <div id="modelDropdown">
                            <td><select id="modelSelect" name="modelSelect" onchange="getModel(this)" style="width: 155px;height:30px;color:#2d5986">
                            <option value="anyModel">Model (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT * FROM modelView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $model = $row['Model'];   ?>
                                <option value="<?=$model?>"><?=$model?></option>
                        <?php } ?>
                            </select></div></td> <!-- MODEL OPTION -->
                    
                        <td><select id="colourSelect" name="colourSelect" onchange="getColour(this)" style="width: 155px;height:30px;color:#2d5986">
                            <option value="anyColour">Colour (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT * FROM colourView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $colour = $row['Colour'];   ?>
                                <option value="<?=$colour?>"><?=$colour?></option>
                        <?php } ?>
                            </select></td> <!-- Colour OPTION -->
                    
                        <td><div id="fuelDropdown">
                            <select id="fuelSelect" name="fuelSelect" onchange="getFuel(this)" style="width: 155px;height:30px;color:#2d5986">
                            <option value="anyFuel">Fuel Type (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT * FROM fuelView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $fuelType = $row['Fuel_Type'];   ?>
                                <option value="<?=$fuelType?>"><?=$fuelType?></option>
                        <?php } ?>
                            </select></div>
                        </td> <!-- FUEL OPTION -->
                </tr>
                <tr>
                        <td><div id="carTypeDropdown">
                            <select id="carTypeSelect" name="carTypeSelect" onchange="getCarType(this)" style="width: 155px;height:30px;color:#2d5986">
                            <option value="anyCarType">Car Type (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Car_Type FROM CarSearchView'); // 
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $carType = $row['Car_Type'];   ?>
                                <option value="<?=$carType?>"><?=$carType?></option>
                        <?php } ?>
                            </select></div>
                        </td> <!-- carType OPTION -->
                        
                        <td><div id="transmissionDropdown">
                            <select id="transmissionSelect" name="transmissionSelect" onchange="getTransType(this)" style="width: 155px;height:30px;color:#2d5986">
                            <option value="anyTransmission">Transmission (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Transmission FROM CarSearchView'); 
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $transmission = $row['Transmission'];   ?>
                                <option value="<?=$transmission?>"><?=$transmission?></option>
                        <?php } ?>
                            </select></div>
                        </td> <!-- transmission OPTION -->
                        
                        <td><div id="numDoorsDropdown">
                            <select id="numDoorSelect" name="numDoorSelect" onchange="getNumDoors(this)" style="width: 155px;height:30px;color:#2d5986">
                            <option value="anyNumDoors">Number of Doors (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Number_of_Doors FROM CarSearchView'); // **EDIT**
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $numDoors = $row['Number_of_Doors'];   ?>
                                <option value="<?=$numDoors?>"><?=$numDoors?></option>
                        <?php } ?>
                            </select></div>
                        </td> <!-- numDoors OPTION -->
                </tr>
                </table>
                <br/><h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Condition</h5>
                        <div id="conditionDropdown">
                            <select id="conditionSelect" name="conditionSelect" onchange="getCondition(this)" style="width: 155px;height:30px;color:#2d5986">
                            <option value="anyCondition">Condition (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Car_Condition FROM CarSearchView'); // **EDIT**
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $condition = $row['Car_Condition'];   ?>
                                <option value="<?=$condition?>"><?=$condition?></option>
                        <?php } ?>
                            </select></div> <!-- numDoors OPTION -->
      
                <br><h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Mileage</h5>               
                <input type="text" style="width: 155px;height:30px;color:#2d5986" name="mileageLow" onchange="getMileLow(this)" placeholder=Minimum>&nbsp;&nbsp;&nbsp;&nbsp;to&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width:155px;height:30px;color:#2d5986" name="mileageHigh" onchange="getMileHigh(this)" placeholder="Maximum"><br>
                            
                <br><h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Price</h5>               
                <input type="text" style="width: 155px;height:30px;color:#2d5986" name="priceLow" placeholder=Minimum onchange="getPriceLow(this)">&nbsp;&nbsp;&nbsp;&nbsp;to&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width:155px;height:30px;color:#2d5986" name="priceHigh" placeholder="Maximum" onchange="getPriceHigh(this)"><br><br>
            </form>  
            
            <button type="button" onclick="showSearchResults(make, model, colour, fuel, carType, transType, numDoors, condition, mileLow, mileHigh, postcode, distance, priceLow, priceHigh)">Search</button> 
            </div></div>
                <br><br>
            </div>
        
            
            <div id="searchResults"><b></b></div>
            
        </div> <!-- close mainbody -->
    </body>
</html>
