<?php
    session_start();
    $id = $_GET['id'];
    
    include "../../php_files/dbconnect/pdoconnect.php";
    
    $stmt = $dbConnection->prepare('DELETE FROM customerAddressView WHERE Address_ID=:id');
    
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    

