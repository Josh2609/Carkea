<?php

    session_start();
    $custID = $_POST['custID'];
    $carReg = $_POST['carReg'];
    
    if ($custID=="")
        $custID="%";
    if ($carReg=="")
        $carReg="%";
    
    $dbConnection = new PDO('mysql:dbname=16ac3d07;host=silva.computing.dundee.ac.uk;charset=utf8', '16ac3u07', 'bac132');

    $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $query = 'SELECT * FROM financeView WHERE Customer_ID LIKE ?'
            . ' AND carReg LIKE ?';
    
    $params = array("%$custID%", "%$carReg%");

    $stmt = $dbConnection->prepare($query);
    $stmt->execute($params);
