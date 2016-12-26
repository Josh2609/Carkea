<?php
    session_start();
    $id = intval($_SESSION['customerID']);
    
    $streetNumber = $_POST["streetNumber"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $county = $_POST["county"];
    $postcode = $_POST["postcode"];
    
    $postcode = str_replace(' ', '', $postcode);

    include "../../php_files/dbconnect/pdoconnect.php";
            
    $stmt = $dbConnection->prepare('INSERT INTO customerAddressView (Customer_ID, Address_ID, Street_Number, Street,'
            . ' City, County, Postcode) VALUES (:id, NULL, :streetNumber, :street, :city, :county, :postcode)');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':streetNumber', $streetNumber);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':county', $county);
    $stmt->bindParam(':postcode', $postcode);
    
    if ($stmt->execute())
    {
        header("Location: ../updateaddress.php?id=$id");
    }
