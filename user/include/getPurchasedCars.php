<?php
//**EDIT**
$id = $_SESSION['customerID'];

    $con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
          mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE
    
    $sql="SELECT * FROM soldCarView WHERE Customer_ID='".$id."'";   
    $result = mysqli_query($con,$sql);
    

    if ($result)
    {
        $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

        $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        while($row = mysqli_fetch_array($result)) 
        {    
            echo '<div class="searchResults">';
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
