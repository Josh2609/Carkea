<?php
    session_start();
    $branchID = $_POST["branchSelect"];
    $vin = $_POST["vin"];
    $reg = $_POST["reg"];
    $make = $_POST["make"];
    $model = $_POST["model"];
    $colour = $_POST["colour"];
    $mileage = $_POST["mileage"];
    $fuelType = $_POST["fuelType"];
    $carType = $_POST["carType"];
    $transmission = $_POST["transmission"];
    $manufactureDate = $_POST["manufactureDate"];
    $numDoors = $_POST["numDoors"];
    $engSize = $_POST["engSize"];
    $askPrice = $_POST["askPrice"];
    $condition = $_POST["condition"];
    $sold = '0';
    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $dbConnection->prepare('INSERT INTO car (Vehicle_Identification_Number, Registration, Make, Model, Colour, Mileage, Fuel_Type, Car_Type, Transmission, Manufacture_Date, Number_of_Doors, Engine_Size, Sold) VALUES (:vin, :reg, :make, :model, :colour, :mileage, :fuelType, :carType, :transmission, :manufactureDate, :numDoors, :engSize, :sold)');
    
    $stmt->bindParam(':vin', $vin);
    $stmt->bindParam(':reg', $reg);
    $stmt->bindParam(':make', $make);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':colour', $colour);
    $stmt->bindParam(':mileage', $mileage);
    $stmt->bindParam(':fuelType', $fuelType);
    $stmt->bindParam(':carType', $carType);
    $stmt->bindParam(':transmission', $transmission);
    $stmt->bindParam(':manufactureDate', $manufactureDate);
    $stmt->bindParam(':numDoors', $numDoors);
    $stmt->bindParam(':engSize', $engSize); 
    $stmt->bindParam(':sold', $sold); 
    
    try{
        $stmt->execute();
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
        header("Location: ../addstock.php?message=duplicate");
        } else {
            header("Location: ../addstock.php?message=error");
            exit();
        }
   }   
   
    $stmt = $dbConnection->prepare('INSERT INTO CarStock (Car_Stock_ID, Asking_Price, Date_Acquired, Car_Condition, Branch_ID, Vehicle_Identification_Number)'
             . ' VALUES (NULL, :askPrice, CURDATE(), :condition, :branchID, :vin)');

    $stmt->bindParam(':askPrice', $askPrice);
    $stmt->bindParam(':condition', $condition);
    $stmt->bindParam(':branchID', $branchID);
    $stmt->bindParam(':vin', $vin);
    
    if ($stmt->execute())
    {
        $stmt2 = $dbConnection->prepare('UPDATE Branch SET Stock_Amount = Stock_Amount + 1 WHERE Branch_ID = :branchID');
        $stmt2->bindParam(':branchID', $branchID);
        $stmt2->execute();
        
        header("Location: ../addstock.php?message=success");
    } else {
        $stmt = $dbConnection->prepare('DELETE FROM car WHERE Vehicle_Identification_Number=:vin');
        $stmt->bindParam(':vin', $vin);
    
        $stmt->execute();
        
        header("Location: ../addstock.php?message=error");
        exit();
    }
    

    

