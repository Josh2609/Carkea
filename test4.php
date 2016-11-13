<?php
// Start the session
//session_start(); // get on the sesh
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
        <link rel="stylesheet" type="text/css" href="newStyle.css" />
        <script src="dropdown.js"></script>
        <script src="js/showSearchResults.js"></script>
        <title>Search</title>
        <script>
            var make = '%';
            var model = '%';
            var colour = '%';
            function getMake(option) {
                make = option.value;  
            }
            function getModel(option) {
                model = option.value;  
            }
            function getColour(option) {
                colour = option.value;  
            }
        </script>
            
    </head>
    <body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="index.php">Carkea</a></li>
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
                
                        <li><div class="dropdown">
                            <span><a href = "">Dropdown</a></span>
                            <div class="dropdown-content">
                                <?php if ($_SESSION['staff'] === "false")
                                {?>
                                    <a href="user/editProfile.php">Edit Details</a>
                                    <a href="#">View Purchases</a> <!-- Add if for user type **EDIT** -->
                                    <a href="#">Link 3</a>
                                <?php } else {?>
                                    <a href="staff/editProfile.php">Edit Details</a>
                                    <a href="#">View Purchases</a> <!-- Add if for user type **EDIT** -->
                                    <a href="#">Link 3</a>
                            <?php } ?>
                            </div>
                        </li>
                        <li><a href="php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <?php } 
                } else { ?>
                <li><a href="login.php">Login</a></li>
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
        
        <div class="searchBody">
            <div class="thingyholder">
            <br>
            <a href="#hide1" class="hide" id="hide1">Click this to collapse the Search Options</a>
            <a href="#show1" class="show" id="show1">Click this to view the Search Options</a>
                        <br><br>
            <div class="list">         
            <form method="POST"  action="php_files/getSearchResults.php">
                <table style="width:100%">
                <tr>
                    <td><input type="text" name="postcode" placeholder="Postcode" style="width: 150px;height:25px;"></td>
                    <!--FILLER SELECT-->
                    <td><select style="width: 155px;height:30px;color:#2d5986;"><option value="#">Distance (Any)</option></select></td>
                    <!--End of FILLER SELECT-->
                            
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
                        </select><!-- MAKE OPTION --></td>
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
                                </select></div> <!-- MODEL OPTION --></td>
                    
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
                            </select> <!-- Colour OPTION --></td>
                        <!--FILLER SELECT-->
                    <td><select id="" name="" style="width: 155px;height:30px;color:#2d5986"><option value="#">Fuel Type (Any)</option></select></td>
                    <!--End of FILLER SELECT-->
                </tr>
                
                <tr>
                    <!--FILLER SELECT-->
                    <td><select id="" name="" style="width: 155px;height:30px;color:#2d5986"><option value="#">Transmission (Any)</option></select></td>
                    <!--End of FILLER SELECT-->
                    <!--FILLER SELECT-->
                    <td><select id="" name="" style="width: 155px;height:30px;color:#2d5986"><option value="#">Number of Seats (Any)</option></select></td>
                    <!--End of FILLER SELECT-->
                    <!--FILLER SELECT-->
                    <td><select id="" name="" style="width: 155px;height:30px;color:#2d5986"><option value="#">Doors (Any)</option></select></td>
                    <!--End of FILLER SELECT-->
                </tr>
                </table>
                <br/><h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Condition</h5>
                <input type="radio" name="#" value="#"> New
                <input type="radio" name="#" value="#"> Used
                <br>
                <br><h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Car Type</h5>
                <input type="checkbox" name="#" value="#">Hatchback
                <input type="checkbox" name="#" value="#">Saloon
                <input type="checkbox" name="#" value="#">Coupe
                <input type="checkbox" name="#" value="#">SUV
                <br>
                <input type="checkbox" name="#" value="#">Estate
                <input type="checkbox" name="#" value="#">Offroad
                <input type="checkbox" name="#" value="#">MPV
                <input type="checkbox" name="#" value="#">Convertible
                <br>
                <br><h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Price</h5>               
                <input type="text" style="width: 155px;height:30px;color:#2d5986" name="#" placeholder=Minimum>&nbsp;&nbsp;&nbsp;&nbsp;to&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" style="width:155px;height:30px;color:#2d5986" name="#" placeholder="Maximum"><br><br>
            </form>  
            
            <button type="button" onclick="showSearchResults(make, model, colour)">Improved Search?</button> <br>
            </div></div>
            <br><br>
        </div>
            <!--<div id="txtHint"><b>Car info will be listed here.</b></div>-->  
            
            <div class="searchResults">
                <img src="Carkea/image1.jpg">
                <div class="searchInfo">
                    <h3 style="color:#2d5986">Car Make and Model</h3>
                    <h2>£30,000</h2>
                    <table style="width:60%">
                        <tr>
                            <td>
                                Example Info1
                            </td>
                            <td>
                                Example Info2
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Example Info3
                            </td>
                            <td>
                                Example Info4
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Example Info5
                            </td>
                            <td>
                                Example Info6
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
        </div> <!-- close mainbody -->
    </body>
</html>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
