<?php
$id = $_SESSION['customerID'];

    include "../php_files/dbconnect/mysqliconnect.php";
    
    $sql="SELECT * FROM customerPurchasedCars WHERE Customer_ID='".$id."'";   
    $result = mysqli_query($con,$sql);
    

    if ($result)
    {
        include "../php_files/dbconnect/pdoconnect.php";
        
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
                    echo '<h3 style="color:#2d5986" >'.$row['Make'].' '.$row['Model'].'</h3>';
                    echo '<h2>£'.$row['Sold_Price'].'</h2>';
                    echo '<table style="width:60%">';
                        echo '<tr>';
                            echo '<td>Mileage: '. $row['Mileage'].'</td>';
                            echo '<td>Date bought: '. $row['Sold_Date'].'</td>';
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
                echo '<p align="center">No Purchased Cars</p>';
            }
            mysqli_close($con);
