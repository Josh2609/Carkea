<?php
// Start the session
session_start();
$_SESSION["incorrectLogin"] = "false";
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
        <link rel="stylesheet" type="text/css" href="newStyle.css" />
        <title>Branch List</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="index.php">Carkea</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Search</a></li>
		<li><a href="#">Contact Us</a></li>
                <li><a class = "active" href="branchlist.php">Branch List</a></li>
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
                                <a href="user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">View Purchases</a>
                            <?php } else {?>
                                <a href="staff/editProfile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="staff/searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="#">Link 3</a>
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
        <br>
        <div class="mainbody">
            <div class="branch">
        <?php
            // change to Team7 and CarkeaDB for release
            $db = mysql_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
            mysql_select_db("16ac3d07"); // SELECT DATABASE
            
            if(!$db)
                echo mysql_error() ;

            
            $queryBranchView = "SELECT * FROM branchView ORDER BY Branch_Name ASC;";
            $branchQueryResult = mysql_query($queryBranchView,$db);
            
            // Displays branch list, needs cleaning up with css/html
            echo "<table>
                <tr><th>Branch Name</th><th>No. of Cars in Stock</th><th>Telephone</th><th>Street Number</th><th>Street</th><th>City</th><th>County</th><th>Postcode</th>";
            while ($row = mysql_fetch_array($branchQueryResult))
            {
                echo "<tr>"
                     .'<td>'.$row['Branch_Name'].'</td>
                     <td>'.$row['Stock_Amount'].'</td>
                     <td>'.$row['Telephone'].'</td>
                     <td>'.$row['Street_Number'].'</td>
                     <td>'.$row['Street'].'</td>
                     <td>'.$row['City'].'</td>
                     <td>'.$row['County'].'</td>
                     <td>'.$row['Postcode'];
                echo "</tr>";
            }
            echo "</table>";

            mysql_close($db); // CLOSE CONNECTION
            ?>
            </div>         
        </div> <!-- close mainbody -->
    </body>
</html>