<?php

    include "dbconnect/pdoconnect.php";
    include "dbconnect/mysqliconnect.php";
          
    session_start();
    
    $resultsPerPage;
    
    $make = $_POST["makeSelect"];
    $model = $_POST["modelSelect"];
    $colour = $_POST["colourSelect"];
    
    if ($make=="anyMake")
            $make="%";
    if ($model=="anyModel")
            $model="%";
    if ($colour=="anyColour")
            $colour="%";
    
    $stmt = $dbConnection->prepare('SELECT * FROM carSearchView WHERE Make LIKE :make AND Model LIKE :model AND Colour LIKE :colour');
    
    $stmt->bindParam(':make', $make);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':colour', $colour);
    $stmt->execute();
    
    foreach ($stmt as $row)
    {
        echo "<p>{$row['Make']}</p>";
        echo "<p>{$row['Model']}</p>";
        echo "<p>{$row['Colour']}</p>";
        echo "<p>{$row['Registration']}</p>";
    }
    
    echo "<p>$make, $model, $colour</p>";
