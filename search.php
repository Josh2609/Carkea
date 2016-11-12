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
        <link rel="stylesheet" type="text/css" href="Style.css" />
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
            //var mileLow = '0';
            //var mileHigh = '10000000';
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
        </script>
            
    </head>
    <body>
        <div class="nav">
            <ul>
                <li style="float:left; color:#999999"><a href="index.php">Carkea</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a class = "active" href="search.php">Search</a></li>
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
                        <li><a href="profile.php"><?=$loggedInUser?></a></li>
                        <li><a href="php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <?php } 
                } else { ?>
                <li><a href="login.php">Login</a></li>
                <?php } ?>
                <li class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">Dropdown</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                    </div>
                </li>
                </ul>
        </div> <!-- nav close -->
        <div class="mainbody">
            <form method="POST"  action="php_files/getSearchResults.php">
                <ul style='list-style:none;'>
                    <li><input type="text" name="postcode" placeholder="Postcode"></li>
                    <li><select id="makeSelect" name="makeSelect" onchange="getMake(this)">
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
                    </select></li> <!-- MAKE OPTION -->
                    
                    <li><div id="modelDropdown">
                            <select id="modelSelect" name="modelSelect" onchange="getModel(this)">
                            <option value="anyModel">Model (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT * FROM modelView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $model = $row['Model'];   ?>
                                <option value="<?=$model?>"><?=$model?></option>
                        <?php } ?>
                        </select></div></li> <!-- MODEL OPTION -->
                    
                        <li><select id="colourSelect" name="colourSelect" onchange="getColour(this)">
                            <option value="anyColour">Colour (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT * FROM colourView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $colour = $row['Colour'];   ?>
                                <option value="<?=$colour?>"><?=$colour?></option>
                        <?php } ?>
                    </select></li> <!-- Colour OPTION -->
                    <li>Mileage: From<input type="text" name="mileageLow" onchange="getMileLow(this)">To<input type="text" name="mileageHigh" onchange="getMileHigh(this)"></li>
                    
                        <li><div id="fuelDropdown">
                            <select id="fuelSelect" name="fuelSelect" onchange="getFuel(this)">
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
                        </li> <!-- FUEL OPTION -->
                        
                        <li><div id="carTypeDropdown">
                            <select id="carTypeSelect" name="carTypeSelect" onchange="getCarType(this)">
                            <option value="anyCarType">Car Type (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Car_Type FROM Car'); // **EDIT**
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $carType = $row['Car_Type'];   ?>
                                <option value="<?=$carType?>"><?=$carType?></option>
                        <?php } ?>
                            </select></div>
                        </li> <!-- carType OPTION -->
                        
                        <li><div id="transmissionDropdown">
                            <select id="transmissionSelect" name="transmissionSelect" onchange="getTransType(this)">
                            <option value="anyTransmission">Transmission (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Transmission FROM Car'); // **EDIT**
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $transmission = $row['Transmission'];   ?>
                                <option value="<?=$transmission?>"><?=$transmission?></option>
                        <?php } ?>
                            </select></div>
                        </li> <!-- transmission OPTION -->
                        
                        <li><div id="numDoorsDropdown">
                            <select id="numDoorSelect" name="numDoorSelect" onchange="getNumDoors(this)">
                            <option value="anyNumDoors">Number of Doors (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Number_of_Doors FROM Car'); // **EDIT**
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $numDoors = $row['Number_of_Doors'];   ?>
                                <option value="<?=$numDoors?>"><?=$numDoors?></option>
                        <?php } ?>
                            </select></div>
                        </li> <!-- numDoors OPTION -->
                        
                        <li><div id="conditionDropdown">
                            <select id="conditionSelect" name="conditionSelect" onchange="getCondition(this)">
                            <option value="anyCondition">Condition (Any)</option>
                        <?php
                            $stmt = $dbConnection->prepare('SELECT DISTINCT Car_Condition FROM CarStock'); // **EDIT**
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $condition = $row['Car_Condition'];   ?>
                                <option value="<?=$condition?>"><?=$condition?></option>
                        <?php } ?>
                            </select></div>
                        </li> <!-- numDoors OPTION -->
                </ul>
                <br/> 
                <input type="submit" value="Search">  
            </form>  
            
            <button type="button" onclick="showSearchResults(make, model, colour, fuel, carType, transType, numDoors, condition, mileLow, mileHigh)">Improved Search?</button> 
            <div id="txtHint"><b>Car info will be listed here.</b></div>
            
        </div> <!-- close mainbody -->
    </body>
</html>
