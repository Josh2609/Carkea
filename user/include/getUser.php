<?php
$id = intval($_SESSION['customerID']);

$con = mysqli_connect("silva.computing.dundee.ac.uk", "16ac3u07","bac132"); // CONNECT TO DATABASE
          mysqli_select_db($con,"16ac3d07"); // SELECT DATABASE

$sql="SELECT * FROM customerView WHERE Customer_ID = '".$id."'";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
    
    $username = $row['Login_Username'];
    $firstName = $row['First_Name'];
    $lastName = $row['Last_Name'];
    $telephone = $row['Telephone'];
    $email = $row['Email'];
    
}
echo "</table>";
mysqli_close($con);
?>