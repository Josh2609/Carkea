<!DOCTYPE html>
<html>
<head>
    <link href="../newStyle.css" rel="stylesheet" type="text/css"/>
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
$mileLow = $_GET['milelow'];
$mileHigh = $_GET['milehigh'];
$priceLow = $_GET['pricelow'];
$priceHigh = $_GET['pricehigh'];
$registration = $_GET['registration'];

$registration = str_replace(' ', '', $registration);


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
    if ($mileLow=="")
            $mileLow="0";
    if ($mileHigh=="")
            $mileHigh="100000000";
    if ($priceLow=="")
            $priceLow="0";
    if ($priceHigh=="")
            $priceHigh="100000000";
    if ($mileHigh<$mileLow) // stops the user being stupid
    {
            $temp=$mileHigh;
            $mileHigh=$mileLow;
            $mileLow=$temp;
    }
    if ($priceHigh<$priceLow) // stops the user being stupid
    {
            $temp=$priceHigh;
            $priceHigh=$priceLow;
            $priceLow=$temp;
    }

include "../../php_files/dbconnect/mysqliconnect.php";
          
          
$sql="SELECT * FROM soldSearchView WHERE Make LIKE '".$make."' AND Model LIKE '".$model."' AND Colour LIKE '".$colour."' "
        . "AND Fuel_Type LIKE '".$fuelType."' AND Car_Type LIKE '".$carType."' AND Transmission LIKE '".$transType."'"
        . "AND Number_of_Doors LIKE '".$numDoors."'"
        . "AND Mileage BETWEEN '".$mileLow."' AND '".$mileHigh."'"
        . "AND Sold_Price BETWEEN '".$priceLow."' AND '".$priceHigh."'";
$result = mysqli_query($con,$sql);

if ($result)
{
    include "../../php_files/dbconnect/pdoconnect.php";


while($row = mysqli_fetch_array($result)) 
{    
    $vin = $row['Vehicle_Identification_Number'];
    //**EDIT** Probably a much better way to do this
    $stmt = $dbConnection->prepare("SELECT Image_Blob FROM carImageView WHERE Vehicle_Identification_Number =?");    
    
    echo '<div class="searchResults">';
    if ($stmt->execute(array($vin))) 
    {
        if ($column=$stmt->fetch())
        {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($column['Image_Blob']) . '""height="90" width="90">';
        } else {
            echo '<img src="placeholder.png "height="90" width="90">';
        }
    }
                echo '<div class="searchInfo">';
                    echo '<h3 style="color:#2d5986" >'.$row['Make'].' '.$row['Model'].'<a/></h3>';
                    echo '<h2>£'.$row['Sold_Price'].'</h2>';
                    echo '<table style="width:60%">';
                        echo '<tr>';
                            echo '<td>Mileage: '. $row['Mileage'].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Colour: '. $row['Colour'].'</td>';
                            echo '<td>Fuel: '. $row['Fuel_Type'].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Doors: '. $row['Number_of_Doors'].'</td>';
                            echo '<td>Transmisiion: '. $row['Transmission'].'</td>';
                        echo '</tr>';
                        echo '<tr>'; 
                            echo '<td>Engine:  '. $row['Engine_Size'].'L</td>';
                            echo '<td>Car Type: '. $row['Car_Type'].'</td>';
                        echo '</tr>';
                    echo '</table>';
                echo '</div>';
            echo '</div>';
            echo '<br>';
}
echo "</table>";
} else {
    echo '<p align="center">No Results Found</p>';
}
mysqli_close($con);

?>
</body>
</html>