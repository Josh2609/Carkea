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
        <script src="js/showModelDrop.js"></script>
        <title>Search</title>
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
                    <li><select id="makeSelect" name="makeSelect" onchange="showModels(this.value)">
                        <option value="anyMake">Make (Any)</option>
                        <?php
                            include "php_files/db_connect.php";
                            // TURN INTO VIEW **EDIT**
                            $stmt = $dbConnection->prepare('SELECT * FROM makeView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $make = $row['Make'];   ?>
                                <option value="<?=$make?>"><?=$make?></option>
                        <?php } ?>
                    </select></li> <!-- MAKE OPTION -->
                    
                    <li><div id="modelDropdown">
                        <select id="modelSelect" name="modelSelect">
                            <option value="anyModel">Model (Any)</option>
                        <?php
                            // TURN INTO VIEW **EDIT**
                            $stmt = $dbConnection->prepare('SELECT * FROM modelView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $model = $row['Model'];   ?>
                                <option value="<?=$model?>"><?=$model?></option>
                        <?php } ?>
                        </select></div></li> <!-- MODEL OPTION -->
                    
                    <li><select id="colourSelect" name="colourSelect">
                            <option value="anyColour">Colour (Any)</option>
                        <?php
                            // TURN INTO VIEW **EDIT**
                            $stmt = $dbConnection->prepare('SELECT * FROM colourView');
                            $stmt->execute();
                            
                            foreach ($stmt as $row)
                            { 
                                $colour = $row['Colour'];   ?>
                                <option value="<?=$colour?>"><?=$colour?></option>
                        <?php } ?>
                    </select></li> <!-- Colour OPTION -->
                </ul>
                <br/> 
                <input type="submit" value="Search"> 
            </form>  
            
            
        </div> <!-- close mainbody -->
    </body>
</html>
