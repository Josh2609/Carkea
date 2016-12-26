<?php
$id = intval($_SESSION['customerID']);

include "../php_files/dbconnect/mysqliconnect.php";

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