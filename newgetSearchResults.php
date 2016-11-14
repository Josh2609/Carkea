<!DOCTYPE html>
<html>
<head>
    <script src="js/getBranchInDistance.js"></script>
    <link href="newStyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
session_start();
include "php_files/distanceCalc.php";

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
$postcode = $_GET['postcode'];
$distance = $_GET['distance'];
if ($postcode=="")
    $postcode="UK";
if ($distance=="")
    $distance="700";

$postcode = str_replace(' ', '', $postcode);
   
$key = 'AIzaSyDv0SJXrfeWAu-LeH9z_1XXriQC-Lrdilk'; // Josh's key for googles API

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=". $postcode .",+&key=".$key;
    $jsonData = file_get_contents($url);
    $data = json_decode($jsonData);
    $xlatAddress = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $xlongAddress = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

    $con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
          mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE
            
    $sql="SELECT Branch_Lat, Branch_Long, Branch_ID FROM BranchLocation";
    $result = mysqli_query($con,$sql);
    
    $inRangeBranch = array();
    // **EDIT** Kinda works, not really though
    while($row = mysqli_fetch_array($result)) 
    {    
        $branchLat = $row['Branch_Lat'];
        $branchLong = $row['Branch_Long'];
        if(distance($xlatAddress, $xlongAddress, $branchLat, $branchLong, "M") < $distance)
        {   
            $branchID = $row['Branch_ID'];
            array_push($inRangeBranch,$branchID);
        }
    }
    mysqli_close($con);

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
          
        $in = implode(',', $inRangeBranch);
          
$sql="SELECT * FROM searchView WHERE Make LIKE '".$make."' AND Model LIKE '".$model."' AND Colour LIKE '".$colour."' "
        . "AND Fuel_Type LIKE '".$fuelType."' AND Car_Type LIKE '".$carType."' AND Transmission LIKE '".$transType."'"
        . "AND Number_of_Doors LIKE '".$numDoors."' AND Car_Condition LIKE '".$condition."' "
        . "AND Mileage BETWEEN '".$mileLow."' AND '".$mileHigh."' AND Branch_ID IN (".$in.")"
        . "AND Sold='".'0'."'";
$result = mysqli_query($con,$sql);

    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


while($row = mysqli_fetch_array($result)) 
{    
    $vin = $row['Vehicle_Identification_Number'];
    //**EDIT** Probably a much better way to do this
    $stmt = $dbConnection->prepare("SELECT Image_Blob FROM CarImage WHERE Vehicle_Identification_Number =?");    
    
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
                    echo '<h3 style="color:#2d5986" ><a <a href="stock.php?id='.$vin.'">'.$row['Make'].' '.$row['Model'].'<a/></h3>';
                    echo '<h2>£'.$row['Asking_Price'].'</h2>';
                    echo '<table style="width:60%">';
                        echo '<tr>';
                            echo '<td>Mileage: '. $row['Mileage'].'</td>';
                            echo '<td>Example Info2</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Example Info3</td>';
                            echo '<td>Example Info4</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Example Info5</td>';
                            echo '<td>Example Info6</td>';
                        echo '</tr>';
                    echo '</table>';
                echo '</div>';
            echo '</div>';
            echo '<br>';
}
echo "</table>";
mysqli_close($con);

?>
</body>
</html>