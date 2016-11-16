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
                        <span><a href="#"><?=$loggedInUser?></a></span>
                        <div class="dropdown-content">
                            <?php if ($_SESSION['staff'] === "false")
                            {?>
                                <a href="user/editprofile.php?id=<?=$_SESSION['customerID']?>">Update Details</a>
                                <a href="user/updateaddress.php?id=<?=$_SESSION['customerID']?>">Update Addresses</a>
                                <a href="user/wishlist.php?id=<?=$_SESSION['customerID']?>">Wishlist</a>
                                <a href="user/purchasedcars.php?id=<?=$_SESSION['customerID']?>">View Purchases</a>
                            <?php } else {?>
                                <a href="../editprofile.php?id=<?=$_SESSION['employeeID']?>">Update Details</a>
                                <a href="../searchcustomers.php">Search Customers</a> <!-- Add if for user type **EDIT** -->
                                <a href="../searchsoldcars.php">Search Sold Cars</a>
                            <?php } ?>
                        </div></div>
                        </li>
                        <li><a href="../../php_files/Logout.php">Logout</a></li>
                    <?php } else { ?>
                    <li><a href="../../login.php">Login</a></li>
                    <li><a href="../../register.php">Register</a></li>
                    <?php } 
                } else { ?>
                <li><a href="../login.php">Login</a></li>
                <li><a href="../register.php">Register</a></li>
                <?php }

                if (isset($_SESSION["accessLevel"])) 
                {
                    if($_SESSION["accessLevel"] == "1" || $_SESSION["accessLevel"] == "2")
                    {?>
                        <li><a href="../addstock.php">Add Stock</a></li>
                    <?php }  
                    else if($_SESSION["accessLevel"] == "3")
                    {?>
                        <li><a href="../addemployee.php">Add Employee</a></li>
                    <?php }  
                    else if($_SESSION["accessLevel"] == "4")
                    {?>
                        <li><a href="../addfinancecompany.php">Add Finance</a></li>
                        <li><a href="../searchfinance.php">Search Finance</a></li>
                    <?php }  
                }?>
            </ul>
        </div> <!-- nav close -->
    <div class="mainbody">
            <div class="branch">

<?php
    session_start();
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    if ($username=="")
        $username="%";
    if ($firstName=="")
        $firstName="%";
    if ($lastName=="")
        $lastName="%";
    if ($email=="")
        $email="%";
    if ($telephone=="")
        $telephone="%";

    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $query = 'SELECT * FROM customerView WHERE First_Name LIKE ?'
            . ' AND Last_Name LIKE ? AND Telephone LIKE ? AND email LIKE ? '
            . 'AND Login_Username LIKE ?';
    
    $params = array("%$firstName%", "%$lastName%", "%$telephone%", "%$email%", "%$username%");

    $stmt = $dbConnection->prepare($query);
    $stmt->execute($params);
    
    
echo "<table>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Telephone</th>
<th>Username</th>
</tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row["First_Name"] . '</a></td>';
    echo "<td>" . $row['Last_Name'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Telephone'] . "</td>";
    echo "<td>" . $row['Login_Username'] . "</td>";
    echo "</tr>";
}
echo "</table>";

?>
                            </div>
</div> <!-- close mainbody -->
</body>
</html>