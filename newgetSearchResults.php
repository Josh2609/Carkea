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
$fuelType = $_GET['fuel'];
$carType = $_GET['cartype'];
$transType = $_GET['transtype'];
$numDoors = $_GET['numdoors'];
$condition = $_GET['condition'];
$mileLow = $_GET['milelow'];
$mileHigh = $_GET['milehigh'];

    if ($make=="anyMake")
            $make="%";
    if ($model=="anyModel")
            $model="%";
    if ($colour=="anyColour")
            $colour="%";
    if ($fuelType=="anyFuel")
            $fuelType="%";
    if ($carType=="anyCarType")
            $carType="%";
    if ($transType=="anyTransmission")
            $transType="%";
    if ($numDoors=="anyNumDoors")
            $numDoors="%";
    if ($condition=="anyCondition")
            $condition="%";
    if ($mileLow=="")
            $mileLow="0";
    if ($mileHigh=="")
            $mileHigh="100000000";
    if ($mileHigh<$mileLow) // stops the user being stupid
    {
            $temp=$mileHigh;
            $mileHigh=$mileLow;
            $mileLow=$temp;
    }

$con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
          mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE
            
$sql="SELECT * FROM searchView WHERE Make LIKE '".$make."' AND Model LIKE '".$model."' AND Colour LIKE '".$colour."' "
        . "AND Fuel_Type LIKE '".$fuelType."' AND Car_Type LIKE '".$carType."' AND Transmission LIKE '".$transType."'"
        . "AND Number_of_Doors LIKE '".$numDoors."' AND Car_Condition LIKE '".$condition."' "
        . "AND Mileage BETWEEN '".$mileLow."' AND '".$mileHigh."' AND Sold='".'0'."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Make</th>
<th>Model</th>
<th>Colour</th>
<th>Registration</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    $vin = $row['Vehicle_Identification_Number'];
    echo '<tr>';
    echo '<td><a href="stock.php?id='.$vin.'">' . $row["Make"] . '</a></td>';
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