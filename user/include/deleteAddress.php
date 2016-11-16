<?php
    session_start();
    $id = $_GET['id'];
    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $dbConnection->prepare('DELETE FROM customerAddressView WHERE Address_ID=:id');
    
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    

