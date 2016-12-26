<?php
// Start the session
session_start(); 
$_SESSION["incorrectLogin"] = "false";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../newStyle.css"/>
    <title>Customer Results</title>
</head>
<body>
        <div class="nav">
            <ul>
                <li class="logo"><a class = "logo" href="../../index.php">Carkea</a></li>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../../search.php">Search</a></li>
		<li><a href="../../contactus.php">Contact Us</a></li>
                <li><a href="../../branchlist.php">Branch List</a></li>
                <?php 
                if (isset($_SESSION['username'])) {
                    $loggedInUser = $_SESSION["username"];
                }
                //session_destroy(); 
                if (isset($_SESSION['loggedIn'])) {
                    if($_SESSION['loggedIn'] == "true" )
                    {   ?>
                        <li><div class="dropdown">
                        <span><a class = "active" href="#"><?=$loggedInUser?></a></span>
                        <div class="dropdown-content">
                            <?php if ($_SESSION['staff'] === "false")
                            {?>
                                <a href="../../user/editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="../../user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a>
                                <a href="../../user/wishlist.php?id=<?=$_SESSION['customerID']?>">Wishlist</a>
                                <a href="../../user/purchasedcars.php?id=<?=$_SESSION['customerID']?>">View Purchases</a>
                            <?php } else {?>
                                <a href="../../staff/editProfile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="../../staff/searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="../../staff/searchsoldcars.php">Search Sold Cars</a>
								<?php if (isset($_SESSION["accessLevel"])) 
									{
										if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
										{?>
											<a href="../staff/addstock.php">Add Stock</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "3")
										{?>
											<a href="../staff/addemployee.php">Add Employee</a>
											<a href = "../staff/searchemployees.php">Search Employees</a>
										<?php }  
										else if($_SESSION["accessLevel"] == "4")
										{?>
											<a href="../../staff/addfinancecompany.php">Add Finance</a>
											<a href="../../staff/searchfinance.php">Search Finance</a>
										<?php }  
										}?>
                            <?php } ?>
                        </div></div>
                        </li>
                        <li><a href="../../php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="../../login.php">Login</a></li>
                    <li><a href="../../register.php">Register</a></li>
                    <?php } 
                } else { ?>
                <li><a href="../../login.php">Login</a></li>
                <li><a href="../../register.php">Register</a></li>
                <?php } ?>
			</ul>
        </div> <!-- nav close -->
    <div class="mainbody">
            <div class="branch">

<?php
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $employeeID = $_POST['employeeID'];
    $role = $_POST['role'];
    $branch =$_POST['branch'];

    if ($username=="")
        $username="%";
    if ($firstName=="")
        $firstName="%";
    if ($lastName=="")
        $lastName="%";
    if ($employeeID=="")
        $employeeID="%";
    if ($role=="")
        $role="%";
    if ($branch="")
        $branch="%";

    include "../../php_files/dbconnect/pdoconnect.php";
    
    $query = 'SELECT * FROM employeeView WHERE First_Name LIKE ?'
            . ' AND Last_Name LIKE ? AND Role_ID LIKE ? '
            . 'AND Login_Username LIKE ? AND Branch_ID LIKE ?';
    
    $params = array("%$firstName%", "%$lastName%", "%$role%", "%$username%", "%$branch%");

    $stmt = $dbConnection->prepare($query);
    $stmt->execute($params);
    
    
echo "<table>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Branch ID</th>
<th>Salary</th>
<th>Login Username</th>
</tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row["First_Name"] . '</a></td>';
    echo "<td>" . $row['Last_Name'] . "</td>";
    echo "<td>" . $row['Branch_ID'] . "</td>";
    echo "<td>" . $row['Salary'] . "</td>";
    echo "<td>" . $row['Login_Username'] . "</td>";
    echo "</tr>";
}
echo "</table>";

?>
                            </div>
</div> <!-- close mainbody -->
</body>
</html>