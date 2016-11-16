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
        <!--<link rel="stylesheet" type="text/css" href="Style.css" />-->
        <link href="newStyle.css" rel="stylesheet" type="text/css"/>
        <title>Carkea</title>
    </head>
    <body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="index.php">Carkea</a></li>
                <li><a class = "active" href="index.php">Home</a></li>
                <li><a href="search.php">Search</a></li>
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
                                <a href="staff/searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="staff/searchsoldcars.php">Search Sold Cars</a>
								<?php if (isset($_SESSION["accessLevel"])) 
									{
										if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
										{?>
											<a href="staff/addstock.php">Add Stock</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "3")
										{?>
											<a href="staff/addemployee.php">Add Employee</a>
											<a href = "staff/searchemployees.php">Search Employees</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "4")
										{?>
											<a href="staff/addfinancecompany.php">Add Finance</a>
											<a href="staff/searchfinance.php">Search Finance</a>
										<?php }  
										}?>
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
                <?php } ?>
			</ul>
        </div> <!-- nav close -->
        
        
        <div class="centreing">
            <br><br><br><br><br>
        <div class="imglist">
        <table>
            <tr><td><div class="IndexIMG">
                        <a href ="search.php" class = "homepageimgs"><img src="Carkea/image1.jpg" style="width: 100%;height:100%;"></a>
                        <h2><span>Buy a new Car</span></h2>
                    </div></td></tr>
            <tr><td><div class="IndexIMG">
			<?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "true" ) { ?>
								<?php if ($_SESSION['staff'] === "false") { ?>
									<a href ="user/editprofile.php?id=<?=$_SESSION['customerID']?>" class = "homepageimgs"><img src="Carkea/image2.jpg" style="width: 100%;height:100%;"></a>
									<h2><span>Edit Profile</span></h2>
								<?php } else {?>
									<a href ="staff/editprofile.php?id=<?=$_SESSION['employeeID']?>" class = "homepageimgs"><img src="Carkea/image2.jpg" style="width: 100%;height:100%;"></a>
									<h2><span>Edit Profile</span></h2>
								<?php } ?>
								<?php } else { ?>
                                <a href ="login.php" class = "homepageimgs"><img src="Carkea/image2.jpg" style="width: 100%;height:100%;"></a>
                                <h2><span>Customer Login</span></h2>
                            <?php } ?>
                    </div></td></tr>
            <tr><td><div class="IndexIMG">
                        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "true" ) { ?>
                                <a href ="branchlist.php" class = "homepageimgs"><img src="Carkea/image3.jpg" style="width: 100%;height:100%;"></a>
                                <h2><span>Branch List</span></h2>
                            <?php } else { ?>
                                <a href ="register.php" class = "homepageimgs"><img src="Carkea/image3.jpg" style="width: 100%;height:100%;"></a>
                                <h2><span>Sign Up</span></h2>
                            <?php } ?>
                    </div></td></tr>
            <tr><td><div class="IndexIMG">
                        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == "true" ) { ?>
                                <a href ="php_files/Logout.php"" class = "homepageimgs"><img src="Carkea/image4.jpg" style="width: 100%;height:100%;"></a>
                                <h2><span>Logout</span></h2>
                            <?php } else { ?>
                                <a href ="login.php?staff=true" class = "homepageimgs"><img src="Carkea/image4.jpg" style="width: 100%;height:100%;"></a>
                                <h2><span>Employee Login</span></h2>
                        <?php } ?>
                        </div></td></tr>
        </table>
        </div>
        </div>
        
        
        <br><br><br><br><br><br><br><br>
    </body>
</html>
