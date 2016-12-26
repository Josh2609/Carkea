<!DOCTYPE html>
<html>
<head>
    <link href="newStyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
session_start();
$stockID = $_GET['stockID'];
$custID = $_GET['custID'];

    include "../../php_files/dbconnect/pdoconnect.php";
    
    $stmt = $dbConnection->prepare("INSERT INTO customerWishlistView (Wishlist_ID, Car_Stock_ID, Customer_ID)"
            . "VALUES (NULL, :carStockID, :custID)");    
    
    $stmt->bindParam(':carStockID', $stockID);
    $stmt->bindParam(':custID', $custID);
    $stmt->execute();
    
    echo '<div class="wishlistResult">';
