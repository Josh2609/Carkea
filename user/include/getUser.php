<!DOCTYPE html>
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
</head>
<body>

<?php
$q = intval($_GET['q']);

//include "../..php_files/db_connect.php";

$con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
          mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE
            
//    $con = new PDO('mysql:dbname=joshuacorpsdb;host=silva.computing.dundee.ac.uk;charset=utf8', 'joshuacorps', 'AC32006');
//            
//    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    
//    $stmt = $dbConnection->prepare('SELECT * FROM customer WHERE Customer_ID=:id');
//    
//    $stmt->bindParam(':id', $q);
//    $stmt->execute();
    //mysqli_select_db($con->connection,"ajax_demo");
$sql="SELECT * FROM Customer WHERE Customer_ID = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Telephone</th>
<th>Email</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['First_Name'] . "</td>";
    echo "<td>" . $row['Last_Name'] . "</td>";
    echo "<td>" . $row['Telephone'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>