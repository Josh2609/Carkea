<?php
// Start the session
session_start(); // get on the sesh
$customerID = $_SESSION['customerID'];
if (isset($_SESSION['loggedIn'])) 
{
    if($_SESSION['loggedIn'] !== "true" )
    {
        header("Location: index.php");
    } 
} else {
    header("Location: ../index.php");
}

$noItems;

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
            
        //**EDIT**
        }
    }