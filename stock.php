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
        
        <script src="js/showCarDetails.js"></script>
        <script>
            function showFinanceForm()
            {
                document.getElementById("financeDiv").style.display = "block";
                document.getElementById("btnFinance").style.visibility = "hidden";
            }       
            function getFinanceCompanyID(option) {
                fCompanyID = option.value;  
            }
        </script>
        
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
                        <span><a href="#"><?=$loggedInUser?></a></span>
                        <div class="dropdown-content">
                            <?php if ($_SESSION['staff'] === "false")
                            {?>
                                <a href="user/editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a>
                                <a href="user/wishlist.php?id=<?=$_SESSION['customerID']?>">Wishlist</a>
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
        <br><br><br>
        <div class="mainbody1">
           <div class = "StockInfo">
            
            <?php

            $con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
                      mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE

            $sql="SELECT * FROM searchView WHERE Vehicle_Identification_Number LIKE '".$vin."'";

            $result = mysqli_query($con,$sql);

            $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

            $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            while($row = mysqli_fetch_array($result)) {
                $vin = $row['Vehicle_Identification_Number'];
                //**EDIT** Probably a much better way to do this
                $stmt = $dbConnection->prepare("SELECT Image_Blob FROM CarImage WHERE Vehicle_Identification_Number =?");    
    
                if ($stmt->execute(array($vin))) 
                {
                    if ($column=$stmt->fetch())
                    {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($column['Image_Blob']) . '""height="70" width="70">';
                    } else {
                        echo '<img src="placeholder.png "height="90" width="90">';
                    }
                }
                
                echo '<div class="info">';
                
                echo '<h1>'.$row["Make"].' '.$row["Model"].'</h1>
                    <h3>'.$row["Engine_Size"].' Litre/'.$row["Fuel_Type"].'/'.$row["Number_of_Doors"].'-Door</h3>
                    <br><br>
                    <h1>£'.$row["Asking_Price"].'</h1>
                    <br><br>
                    <h5>Branches where ***DO DIS***this car is Available</h5>
                    </div> ';
                
                $branchID = $row["Branch_ID"];
                $carStockID = $row["Car_Stock_ID"];
                
                if (isset($_SESSION["accessLevel"])) 
                {
                    if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
                    {?>
                        <div class="wishList">
                            <button id="markSold">Mark as Sold</button>
                        </div>
               
                        <div id="soldModal" class="modal">
                        <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">×</span>
                                <form method="POST"  action="php_files/markSold.php">
                                    <ul style='list-style:none;'>
                                        <li>Price sold for<input type="text" name="soldPrice"></li>
                                        <li><br></li>
                                        <li>ID of Customer<input type="text" name="soldCustID"></li>
                                        <li><br></li>
                                    </ul>
                                    <input type="hidden" name="vin" value="<?php echo $vin ?>">
                                    <input type="hidden" name="branchID" value="<?php echo $branchID ?>">
                                    <input type="hidden" name="carStockID" value="<?php echo $carStockID ?>">
                                    
                                    <div style="display:none" id="financeDiv">
                                        <ul style='list-style:none;'>
                                            <li>Payment Method<input type="text" name="paymentMethod"></li>
                                            <li>Finance Amount<input type="text" name="financeAmount"></li>
                                            <li>Monthly Payments<input type="text" name="monthlyPayments"></li>
                              
                                            <li><select id="fCompanySelect" name="fCompanySelect" onchange="getFinanceCompanyID(this)" style="width: 155px;height:30px;color:#2d5986">
                                            <option value="">Finance Company</option>
                                            <?php
                                            $stmt2 = $dbConnection->prepare("SELECT Finance_Company_ID, Company_Name FROM FinanceCompany");  
                                            $stmt2->execute();
                                            foreach ($stmt2 as $data)
                                            { ?>
                                                <option value="<?=$data['Company_ID'];?>"><?=$data['Finance_Company_Name'];?></option>
                                            <?php } ?>
                                            </select></li>
                                        </ul>
                                    </div>
                                        <button type="button" id="btnFinance" onclick="showFinanceForm()">Add Finance?</button> 
                                    <input type="submit" value="Submit"> 
                                </form>
                            </div>
                        </div>
                    <script src="js/markSoldModal.js"></script>

                    <?php } else {?>
                        
                    <?php }  
                } else {?>
                <div class="wishList">
                    <button id="wishList">Add To Wishlist</button>
                </div>
                <?php }?>
           </div>
            </div> <!-- close mainbody -->
            <div class="mainbody2">
            <h5 style = "background-color:#2d5986;padding-top:10px;padding-bottom:10px;width:100%;color:white;">Vehicle Specifications</h5>
            <div class="VSpec">
            <?php 
                echo '<table>
                    <tr>
                        <th>ExampleInfo1Title</th>
                        <td>ExampleInfo1</td>
                    </tr>
                    <tr>
                        <th>ExampleInfo2Title</th>
                        <td>ExampleInfo2</td>
                    </tr>
                    <tr>
                        <th>ExampleInfo3Title</th>
                        <td>ExampleInfo3</td>
                    </tr>
                    <tr>
                        <th>ExampleInfo4Title</th>
                        <td>ExampleInfo4</td>
                    </tr>
                    <tr>
                        <th>ExampleInfo5Title</th>
                        <td>ExampleInfo5</td>
                    </tr>
                    <tr>
                        <th>ExampleInfo6Title</th>
                        <td>ExampleInfo6</td>
                    </tr>
                </table>';
                echo '<td><button type="button" onclick="('.$row["Vehicle_Identification_Number"].')">Add to wishlist</button></td>';
                echo "</tr>";
            }
            echo "</table>";
            
            mysqli_close($con);
            
            ?>
            
            </div>
        </div>
            
       
    </body>
</html>
