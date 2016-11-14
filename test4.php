<?php
// Start the session
session_start(); 
$_SESSION["incorrectLogin"] = "false";
$vin = $_GET['id'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <style>
table {
    width: 100%;
    border-collapse: collapse;
}
table, td, th {
    border: 1px solid black;
    padding: 5px;
}
th {text-align: left;}
</style>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="newStyle.css" />
        <script src="dropdown.js"></script>
        <script src="js/showCarDetails.js"></script>
        <title>Carkea</title>
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
        <div class="mainbody1">
           
            <?php
            /*$con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
                      mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE
            $sql="SELECT * FROM searchView WHERE Vehicle_Identification_Number LIKE '".$vin."'";
            $result = mysqli_query($con,$sql);
            echo "<table>
            <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Colour</th>
            <th>Asking Price</th>
            <th>Mileage</th>
            <th>Car Type</th>
            <th>Fuel Type</th>
            <th>Registration</th>
            </tr>";
            while($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . $row["Make"] . '</td>';
                echo "<td>" . $row['Model'] . "</td>";
                echo "<td>" . $row['Colour'] . "</td>";
                echo "<td>" . $row['Asking_Price'] . "</td>";
                echo "<td>" . $row['Mileage'] . "</td>";
                echo "<td>" . $row['Car_Type'] . "</td>";
                echo "<td>" . $row['Fuel_Type'] . "</td>";
                echo "<td>" . $row['Registration'] . "</td>";
                echo '<td><button type="button" onclick="('.$row["Vehicle_Identification_Number"].')">Add to wishlist</button></td>';
                echo "</tr>";
            }
            echo "</table>";
            
            mysqli_close($con);*/
            
            ?>
            
            
            <div class = "StockInfo">
                <img src="http://blog.caranddriver.com/wp-content/uploads/2015/11/BMW-2-series.jpg">
                <div class="info">
                    <!--<h1>Car Make and Car Model</h1>
                    <h3>Engine Size, Fuel Type, and Number of Doors</h3>
                    <br><br>
                    <h1>£PRICE</h1>
                    <br><br>
                    <a href="#"><h5>Branches where this car is Available</h5></a>-->
                    <h1>BMW M5</h1>
                    <h3>2.0 Litre/Petrol/5-Door</h3>
                    <br><br>
                    <h1>£35,000</h1>
                    <br><br>
                    <a href="#"><h5>Branches where this car is Available</h5></a>
                    
                </div>
                <div class="wishList">
                    <button id="wishList">Add To Wishlist</button>
                </div>
            </div>       
        </div> <!-- close mainbody -->
        <div class="mainbody2">
            <h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Vehicle Specifications</h5>
            <div class="VSpec">
                <table>
                    <tr>
                        <th>
                            ExampleInfo1Title                           
                        </th>
                        <td>
                            ExampleInfo1
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ExampleInfo2Title                           
                        </th>
                        <td>
                            ExampleInfo2
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ExampleInfo3Title                           
                        </th>
                        <td>
                            ExampleInfo3
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ExampleInfo4Title                           
                        </th>
                        <td>
                            ExampleInfo4
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ExampleInfo5Title                           
                        </th>
                        <td>
                            ExampleInfo5
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ExampleInfo6Title                           
                        </th>
                        <td>
                            ExampleInfo6
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>