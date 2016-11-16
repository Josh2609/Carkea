<?php
    session_start();
    $id = intval($_SESSION['customerID']);
    
    $streetNumber = $_POST["streetNumber"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $county = $_POST["county"];
    $postcode = $_POST["postcode"];
    
    $postcode = str_replace(' ', '', $postcode);

    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
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
