<?php

    session_start();
    $custID = $_POST['custID'];
    $carReg = $_POST['carReg'];
    
    if ($custID=="")
        $custID="%";
    if ($carReg=="")
        $carReg="%";
    
    include "../../php_files/dbconnect/pdoconnect.php";
    
    $query = 'SELECT * FROM financeView WHERE Customer_ID LIKE ?'
            . ' AND carReg LIKE ?';
    
    $params = array("%$custID%", "%$carReg%");

    $stmt = $dbConnection->prepare($query);
    $stmt->execute($params);
