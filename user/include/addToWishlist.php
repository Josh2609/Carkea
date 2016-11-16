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

    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $dbConnection->prepare("INSERT INTO customerWishlistView (Wishlist_ID, Car_Stock_ID, Customer_ID)"
            . "VALUES (NULL, :carStockID, :custID)");    
    
    $stmt->bindParam(':carStockID', $stockID);
    $stmt->bindParam(':custID', $custID);
    $stmt->execute();
    
    echo '<div class="wishlistResult">';
