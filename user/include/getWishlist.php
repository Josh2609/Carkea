<?php
$customerID = $_SESSION['customerID'];
if (isset($_SESSION['loggedIn'])) 
{
    if($_SESSION['loggedIn'] !== "true" || $_SESSION['customerID'] != $id)
    {
        header("Location: ../index.php");
    } 
} else {
    header("Location: ../index.php");
}

$noItems;
 $stockOnWishlist = array();
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    $stmt = $dbConnection->prepare('SELECT Car_Stock_ID FROM CustomerWishlist WHERE Customer_ID = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    if (!$stmt->rowCount() > 0) {
        echo "<p>You currently have no items in your wishlist.</p>";
    } else {
        foreach ($stmt as $row)
        {
           $stockID = $row['Car_Stock_ID'];
           array_push($stockOnWishlist,$stockID);
        }
        $carStockID = implode(',', $stockOnWishlist);
        $stmt = $dbConnection->prepare('SELECT * FROM searchView WHERE Car_Stock_ID IN ('.$carStockID.')');
        $stmt->execute();
        
        foreach ($stmt as $row)
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
                    echo '<h3 style="color:#2d5986" ><a <a href="../stock.php?id='.$vin.'">'.$row['Make'].' '.$row['Model'].'<a/></h3>';
                    echo '<h2>£'.$row['Asking_Price'].'</h2>';
                    echo '<table style="width:60%">';
                        echo '<tr>';
                            echo '<td>Mileage: '. $row['Mileage'].'</td>';
                            echo '<td>Condition: '. $row['Car_Condition'].'</td>';
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
    }