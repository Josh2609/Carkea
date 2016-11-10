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
session_start();
$make = $_GET['make'];
$model = $_GET['model'];
$colour = $_GET['colour'];

    if ($make=="anyMake")
            $make="%";
    if ($model=="anyModel")
            $model="%";
    if ($colour=="anyColour")
            $colour="%";


$con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
          mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE
            
$sql="SELECT * FROM Car WHERE Make LIKE '".$make."' AND Model LIKE '".$model."' AND Colour LIKE '".$colour."' AND Sold='".'0'."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Make</th>
<th>Model</th>
<th>Colour</th>
<th>Registration</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Make'] . "</td>";
    echo "<td>" . $row['Model'] . "</td>";
    echo "<td>" . $row['Colour'] . "</td>";
    echo "<td>" . $row['Registration'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);

?>
</body>
</html>