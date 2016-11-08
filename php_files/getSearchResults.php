<?php

    include "db_connect.php";
    
    session_start();
    
    $make = $_POST["makeSelect"];
    $model = $_POST["modelSelect"];
    $colour = $_POST["colourSelect"];
    
    if ($make=="anyMake")
            $make="*";
    if ($model=="anyModel")
            $model="*";
    if ($colour=="anyColour")
            $colour="*";
    
    $stmt = $dbConnection->prepare('SELECT * FROM Car WHERE Make=:make AND Model=:model AND Colour=:colour');
    
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
